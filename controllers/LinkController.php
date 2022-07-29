<?php

namespace Controllers;

use Core\Controller;
use Core\Request;
use Models\Link;
use Models\Stat;

class LinkController extends Controller
{
    public function show()
    {
        return $this->json(Link::where('user_id', auth()->user()->id)->orderBy('id', 'DESC')->get());
    }

    public function create(Request $request)
    {
        $data = $request->json()->validate([
            'name' => ['str', 'max:20', 'unik:link'],
            'link' => ['trim', 'required', 'str']
        ]);

        if (!filter_var($request->link, FILTER_VALIDATE_URL)) {
            $request->throwError([
                'link' => 'Link tidak sesuai !'
            ]);
        }

        $data['user_id'] = auth()->user()->id;
        Link::create($data);

        return $this->json([
            'status' => true
        ]);
    }

    public function delete($id)
    {
        Link::where('name', $id)->delete();
        return $this->json([
            'status' => true
        ]);
    }

    public function click(Request $request, $id)
    {
        $link = Link::find($id, 'name');

        if (empty($link->id)) {
            notFound();
        }

        Stat::create([
            'link_id' => $link->id,
            'user_agent' => $request->server('HTTP_USER_AGENT'),
            'ip_address' => $request->server('REMOTE_ADDR')
        ]);

        header('HTTP/1.1 301 Moved Permanently');
        header('Location: ' . trim($link->link));
        exit();
    }
}
