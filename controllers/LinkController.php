<?php

namespace Controllers;

use Core\Auth\Auth;
use Core\Database\DB;
use Core\Http\Request;
use Core\Routing\Controller;
use Core\Valid\Validator;
use Models\Link;

class LinkController extends Controller
{
    private $id;

    function __construct(Auth $auth)
    {
        $this->id = $auth->user()->id;
    }

    public function show(Request $request)
    {
        $valid = $this->validate($request, [
            'nama' => ['slug', 'trim', 'str', 'max:25'],
            'init' => ['trim', 'max:3', 'int'],
            'end' => ['required', 'trim', 'max:3', 'int']
        ]);

        if ($valid->fails()) {
            return json([
                'error' => $valid->failed()
            ], 400);
        }

        return json(
            DB::table('links')
                ->leftJoin('stats', 'links.id', 'stats.link_id')
                ->where('links.user_id', $this->id)
                ->where('links.name', '%' . $valid->nama . '%', 'LIKE')
                ->groupBy('links.id')
                ->orderBy('links.id', 'DESC')
                ->limit($valid->end)
                ->offset($valid->init ?? 0)
                ->select([
                    'links.name',
                    'links.link',
                    'links.created_at',
                    'links.link_password',
                    'links.waktu_buka',
                    'links.waktu_tutup',
                    'links.record_statistics',
                    'count(stats.id) as hint',
                ])
                ->get()
        );
    }

    public function detail(Request $request)
    {
        $valid = Validator::make($request->only(['name']), [
            'name' => ['required', 'slug', 'trim', 'str', 'min:3', 'max:25']
        ]);

        if ($valid->fails()) {
            return json([
                'error' => $valid->failed()
            ], 400);
        }

        $base = fn () => Link::join('stats', 'links.id', 'stats.link_id')
            ->where('links.user_id', $this->id)
            ->where('links.name', $valid->name);

        $lastweek = $base()
            ->where('stats.created_at', date('Y-m-d', strtotime('-1 week', strtotime('now'))) . ' 00:00:00.000000', '>=')
            ->groupBy('tgl')
            ->select('concat(extract(YEAR from stats.created_at), \'-\', extract(MONTH from stats.created_at), \'-\', extract(DAY from stats.created_at)) AS tgl', 'count(stats.id) as hint')
            ->get()
            ->toArray();

        usort($lastweek, fn ($a, $b) => strtotime($a['tgl']) - strtotime($b['tgl']));

        $get = fn (string $select) => $base()
            ->groupBy('stats.' . $select)
            ->orderBy('hint', 'DESC')
            ->select('stats.' . $select, 'count(stats.id) as hint')
            ->limit(5)
            ->get();

        $unique = $base()
            ->groupBy('stats.user_agent', 'stats.ip_address')
            ->select('COUNT(stats.link_id)')
            ->get()
            ->rowCount();

        return json([
            'last_week' => $lastweek,
            'user_agent' => $get('user_agent'),
            'ip_address' => $get('ip_address'),
            'unique' => $unique ?? 0
        ]);
    }

    public function create(Request $request)
    {
        $valid = $this->validate($request, [
            'name' => ['required', 'slug', 'trim', 'str', 'min:3', 'max:25', 'unik:link'],
            'link' => ['required', 'trim', 'url', 'str', 'min:5']
        ]);

        if (str_contains($valid->link, BASEURL)) {
            $valid->throw([
                'link' => 'Link ilegal'
            ]);
        }

        if ($valid->fails()) {
            return json([
                'error' => $valid->failed()
            ], 400);
        }

        $data = $valid->only(['name', 'link']);
        $data['user_id'] = $this->id;

        $status = Link::create($data);

        return json([
            'status' => (bool) $status
        ]);
    }

    public function update(Request $request)
    {
        $valid = $this->validate($request, [
            'old' => ['required', 'slug', 'trim', 'str', 'min:3', 'max:25'],
            'name' => ['required', 'slug', 'trim', 'str', 'min:3', 'max:25'],
            'link' => ['required', 'trim', 'url', 'str', 'min:5'],
            'password' => ['trim', 'str', 'max:20'],
            'buka' => ['trim', 'str', 'max:16'],
            'tutup' => ['trim', 'str', 'max:16']
        ]);

        if (str_contains($valid->link, BASEURL)) {
            $valid->throw([
                'link' => 'Link ilegal'
            ]);
        }

        if ($valid->old != $valid->name) {
            $valid->validate([
                'name' => ['unik:link']
            ]);
        }

        if ($valid->fails()) {
            return json([
                'error' => $valid->failed()
            ], 400);
        }

        $data = $valid->only(['name', 'link']);
        $data['link_password'] = empty($valid->password) ? null : $valid->password;
        $data['waktu_buka'] = empty($valid->buka) ? null : implode(' ', explode('T', $valid->buka)) . ':00';
        $data['waktu_tutup'] = empty($valid->tutup) ? null : implode(' ', explode('T', $valid->tutup)) . ':00';

        $result = Link::where('id', Link::find($valid->old, 'name')->id)
            ->where('user_id', $this->id)
            ->update($data);

        return json([
            'status' => $result
        ]);
    }

    public function delete(Request $request)
    {
        $valid = Validator::make($request->only(['name']), [
            'name' => ['required', 'slug', 'trim', 'str', 'min:3', 'max:25']
        ]);

        if ($valid->fails()) {
            return json([
                'error' => $valid->failed()
            ], 400);
        }

        $result = Link::where('name', $valid->name)
            ->where('user_id', $this->id)
            ->delete();

        return json([
            'status' => $result
        ]);
    }
}
