<?php

namespace Service;

use Core\Http\Request;
use Core\Valid\Validator;
use Models\Link;

class LinkService implements ServiceContract
{
    private $request;

    function __construct(Request $requst)
    {
        $this->request = $requst;
    }

    public function create(int $id): array
    {
        $valid = Validator::make($this->request->only(['name', 'link']), [
            'name' => ['required', 'str', 'trim', 'slug', 'min:3', 'max:25', 'unik:link'],
            'link' => ['required', 'str', 'trim', 'min:5', 'url']
        ]);

        if (str_contains($valid->link, BASEURL)) {
            $valid->throw([
                'link' => 'Link ilegal'
            ]);
        }

        if (is_null(auth()->user()->email_verify)) {
            if (Link::where('user_id', $id)->counts('link')->first()->link >= 3) {
                $valid->throw([
                    'link' => 'Verifikasi akun untuk menambahkan lagi'
                ]);
            }
        }

        if ($valid->fails()) {
            respond()->send(json([
                'error' => $valid->failed()
            ], 400));
        }

        $data = $valid->only(['name', 'link']);
        $data['user_id'] = $id;
        return $data;
    }

    public function update(int $id): bool
    {
        $valid = Validator::make($this->request->all(), [
            'old' => ['required', 'str', 'trim', 'slug', 'min:3', 'max:25'],
            'name' => ['required', 'str', 'trim', 'slug', 'min:3', 'max:25'],
            'link' => ['required', 'str', 'trim', 'min:5', 'url'],
            'password' => ['str', 'trim', 'max:25'],
            'buka' => ['str', 'trim', 'max:16'],
            'tutup' => ['str', 'trim', 'max:16'],
            'stats' => ['bool']
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
            respond()->send(json([
                'error' => $valid->failed()
            ], 400));
        }

        $result = Link::where('name', $valid->old)
            ->where('user_id', $id)
            ->first();

        $result->name = $valid->name;

        if (!is_null(auth()->user()->email_verify)) {
            $result->link = $valid->link;
        }

        $result->link_password = empty($valid->password) ? null : $valid->password;
        $result->record_statistics = $valid->stats;
        $result->waktu_buka = empty($valid->buka) ? null : implode(' ', explode('T', $valid->buka)) . ':00';
        $result->waktu_tutup = empty($valid->tutup) ? null : implode(' ', explode('T', $valid->tutup)) . ':00';

        return $result->save();
    }
}
