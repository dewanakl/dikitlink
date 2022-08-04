<?php

namespace Controllers;

use Core\Auth;
use Core\Controller;
use Core\Request;
use Core\Validator;
use Models\Link;

class LinkController extends Controller
{
    private $id;

    function __construct()
    {
        $this->id = Auth::user()->id;
    }

    public function show()
    {
        return $this->json(
            Link::leftJoin('stats', 'links.id', 'stats.link_id')
                ->where('links.user_id', $this->id)
                ->groupBy('stats.link_id', 'links.id')
                ->orderBy('links.id', 'DESC')
                ->select('links.name', 'links.link', 'count(stats.id) as hint')
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

        $lastweek = Link::join('stats', 'links.id', 'stats.link_id')
            ->where('links.user_id', $this->id)
            ->where('links.name', $valid->name)
            ->where('stats.created_at', date('Y-m-d H:i:s.u', strtotime('-1 week')), '>=')
            ->groupBy('tgl')
            ->orderBy('tgl')
            ->select('concat(extract(YEAR from stats.created_at), \'-\', extract(MONTH from stats.created_at), \'-\', extract(DAY from stats.created_at)) AS tgl', 'count(stats.id) as hint')
            ->get();

        $get = fn (string $select) => Link::join('stats', 'links.id', 'stats.link_id')
            ->where('links.user_id', $this->id)
            ->where('links.name', $valid->name)
            ->groupBy('stats.' . $select)
            ->orderBy('hint', 'DESC')
            ->select('stats.' . $select, 'count(stats.id) as hint')
            ->get();

        return $this->json([
            'last_week' => $lastweek,
            'user_agent' => $get('user_agent'),
            'ip_address' => $get('ip_address')
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

        $data = $valid->validated();
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
