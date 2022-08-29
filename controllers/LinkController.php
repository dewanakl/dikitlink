<?php

namespace Controllers;

use Core\Auth\Auth;
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
            'order' => ['required', 'trim', 'str', 'max:1'],
            'init' => ['trim', 'max:3', 'int'],
            'end' => ['required', 'trim', 'max:3', 'int']
        ]);

        if ($valid->fails()) {
            return $this->json([
                'error' => $valid->failed()
            ], 400);
        }

        $nama = (!empty($valid->nama)) ? $valid->nama : null;

        return $this->json(
            Link::leftJoin('stats', 'links.id', 'stats.link_id')
                ->where('links.user_id', $this->id)
                ->where('links.name', "%$nama%", 'LIKE')
                ->groupBy('links.id')
                ->orderBy('links.id', ($valid->order == 'a') ? 'DESC' : 'ASC')
                ->limit($valid->end)
                ->offset($valid->init)
                ->select('links.name', 'links.link', 'links.created_at', 'count(stats.id) as hint')
                ->get()
        );
    }

    public function detail(Request $request)
    {
        $valid = Validator::make($request->only(['name']), [
            'name' => ['required', 'slug', 'trim', 'str', 'min:3', 'max:25'],
        ]);

        if ($valid->fails()) {
            return $this->json([
                'error' => $valid->failed()
            ], 400);
        }

        $base = fn () => Link::join('stats', 'links.id', 'stats.link_id')
            ->where('links.user_id', $this->id)
            ->where('links.name', $valid->name);

        $lastweek = $base()
            ->where('stats.created_at', date('Y-m-d H:i:s.u', strtotime('-6 day', strtotime('now'))), '>')
            ->groupBy('tgl')
            ->select('concat(extract(YEAR from stats.created_at), \'-\', extract(MONTH from stats.created_at), \'-\', extract(DAY from stats.created_at)) AS tgl', 'count(stats.id) as hint')
            ->get();

        $lastweek = json_decode(json_encode($lastweek), true);
        usort($lastweek, fn ($a, $b) => strtotime($a['tgl']) - strtotime($b['tgl']));

        $get = fn (string $select) => $base()
            ->groupBy('stats.' . $select)
            ->orderBy('hint', 'DESC')
            ->select('stats.' . $select, 'count(stats.id) as hint')
            ->get();

        $unique = $base()
            ->groupBy('stats.user_agent', 'stats.ip_address')
            ->select('COUNT(stats.link_id)')
            ->get()
            ->rowCount();

        $sum = $base()
            ->groupBy('links.id')
            ->select('count(stats.id) as jumlah')
            ->first();

        return $this->json([
            'last_week' => $lastweek,
            'user_agent' => $get('user_agent'),
            'ip_address' => $get('ip_address'),
            'unique' => $unique ?? 0,
            'jumlah' => $sum->jumlah ?? 0
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
            return $this->json([
                'error' => $valid->failed()
            ], 400);
        }

        $data = $valid->only(['name', 'link']);
        $data['user_id'] = $this->id;
        Link::create($data);

        return $this->json([
            'status' => true
        ]);
    }

    public function update(Request $request)
    {
        $valid = $this->validate($request, [
            'old' => ['required', 'slug', 'trim', 'str', 'min:3', 'max:25'],
            'name' => ['required', 'slug', 'trim', 'str', 'min:3', 'max:25'],
            'link' => ['required', 'trim', 'url', 'str', 'min:5']
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
            return $this->json([
                'error' => $valid->failed()
            ], 400);
        }

        $old = Link::find($valid->old, 'name');

        $result = Link::where('id', $old->id)
            ->where('user_id', $this->id)
            ->update([
                'name' => $valid->name,
                'link' => $valid->link
            ]);

        return $this->json([
            'status' => $result
        ]);
    }

    public function delete(Request $request)
    {
        $valid = Validator::make($request->only(['name']), [
            'name' => ['required', 'slug', 'trim', 'str', 'min:3', 'max:25'],
        ]);

        if ($valid->fails()) {
            return $this->json([
                'error' => $valid->failed()
            ], 400);
        }

        $result = Link::where('name', $valid->name)
            ->where('user_id', $this->id)
            ->delete();

        return $this->json([
            'status' => $result
        ]);
    }
}
