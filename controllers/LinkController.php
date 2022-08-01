<?php

namespace Controllers;

use Core\Auth;
use Core\Controller;
use Core\Request;
use Models\Link;

class LinkController extends Controller
{
    public function show()
    {
        return $this->json(
            Link::leftJoin('stats', 'links.id', 'stats.link_id')
                ->where('links.user_id', Auth::user()->id)
                ->groupBy('stats.link_id', 'links.id')
                ->orderBy('links.id', 'DESC')
                ->select('links.name', 'links.link', 'count(stats.id) as hint')
                ->get()
        );
    }

    public function detail(Request $request)
    {
        $request->json()->validate([
            'name' => ['required', 'slug', 'trim', 'str', 'min:3', 'max:25'],
        ]);

        $lastweek = Link::join('stats', 'links.id', 'stats.link_id')
            ->where('links.user_id', Auth::user()->id)
            ->where('links.name', $request->name)
            ->where('stats.created_at', date('Y-m-d H:i:s.u', strtotime('-1 week')), '>=')
            ->groupBy('tgl')
            ->orderBy('tgl')
            ->select('to_char(stats.created_at, \'YYYY-MM-DD\') AS tgl', 'count(stats.id) as hint')
            ->get();

        $get = fn (string $select) => Link::join('stats', 'links.id', 'stats.link_id')
            ->where('links.user_id', Auth::user()->id)
            ->where('links.name', $request->name)
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
        $data = $request->json()->validate([
            'name' => ['required', 'slug', 'trim', 'str', 'min:3', 'max:25', 'unik:link'],
            'link' => ['required', 'trim', 'url', 'str', 'min:5']
        ]);

        if (str_contains($request->link, BASEURL)) {
            $request->json()->throwError([
                'link' => 'Link ilegal'
            ]);
        }

        $data['user_id'] = Auth::user()->id;
        Link::create($data);

        return $this->json([
            'status' => true
        ]);
    }

    public function update(Request $request)
    {
        $request->json()->validate([
            'old' => ['required', 'slug', 'trim', 'str', 'min:3', 'max:25'],
            'name' => ['required', 'slug', 'trim', 'str', 'min:3', 'max:25'],
            'link' => ['required', 'trim', 'url', 'str', 'min:5']
        ]);

        if (str_contains($request->link, BASEURL)) {
            $request->json()->throwError([
                'link' => 'Link ilegal'
            ]);
        }

        if ($request->old != $request->name) {
            $request->json()->validate([
                'name' => ['unik:link']
            ]);
        }

        $old = Link::find($request->old, 'name');

        $result = Link::where('id', $old->id)
            ->where('user_id', Auth::user()->id)
            ->update([
                'name' => $request->name,
                'link' => $request->link
            ]);

        return $this->json([
            'status' => $result
        ]);
    }

    public function delete(Request $request)
    {
        $request->json()->validate([
            'name' => ['required', 'slug', 'trim', 'str', 'min:3', 'max:25'],
        ]);

        $result = Link::where('name', $request->name)
            ->where('user_id', Auth::user()->id)
            ->delete();

        return $this->json([
            'status' => $result
        ]);
    }
}
