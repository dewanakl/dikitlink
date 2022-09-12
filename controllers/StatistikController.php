<?php

namespace Controllers;

use Core\Auth\Auth;
use Core\Http\Request;
use Core\Routing\Controller;
use Core\Valid\Validator;
use Models\Link;
use Models\Stat;

class StatistikController extends Controller
{
    public function index(Link $link)
    {
        $id = Auth::user()->id;
        $getstats = $link->getStats($id);

        return $this->view('statistik', [
            'last_month' => $link->lastMonth($id),
            'user_agent' => $getstats('user_agent'),
            'ip_address' => $getstats('ip_address')
        ]);
    }

    public function download()
    {
        $hasil = Link::join('stats', 'links.id', 'stats.link_id')
            ->where('links.user_id', Auth::user()->id)
            ->select('stats.id', 'links.name', 'stats.user_agent', 'stats.ip_address', 'stats.created_at')
            ->get()
            ->toArray();

        header_remove();
        header('Content-Type: application/csv; charset=UTF-8');
        header('Content-Disposition: attachment; filename="statistik_' . now('Y-m-d_H-i-s') . '.csv";');

        $handle = fopen('php://output', 'w');

        fputcsv($handle, ['id', 'name', 'user_agent', 'ip_address', 'time'], ';');
        foreach ($hasil as $value) {
            fputcsv($handle, array_values($value), ';');
        }

        fclose($handle);
    }

    public function click(Request $request, $id)
    {
        $valid = Validator::make(
            [
                'id' => $id,
                'password' => $request->password
            ],
            [
                'id' => ['trim', 'slug', 'str', 'min:3', 'max:30'],
                'password' => ['trim', 'str', 'max:25']
            ]
        );

        if ($valid->fails()) {
            return $this->view('hilang');
        }

        $link = Link::find($valid->id, 'name');

        if (empty($link->id)) {
            return $this->view('hilang');
        }

        if (!empty($link->waktu_tutup) && time() >= strtotime($link->waktu_tutup)) {
            return $this->view('tunggu', [
                'opened' => false,
                'name' => $id,
                'time' => $link->waktu_tutup
            ]);
        }

        if (!empty($link->waktu_buka) && time() <= strtotime($link->waktu_buka)) {
            return $this->view('tunggu', [
                'opened' => true,
                'name' => $id,
                'time' => $link->waktu_buka
            ]);
        }

        if (!empty($link->link_password)) {
            if (!empty($valid->password)) {
                if ($link->link_password !== $valid->password) {
                    return $this->back()->with('gagal', 'Password salah !');
                }
            } else {
                if ($request->method() == 'POST') {
                    $request->validate([
                        'password' => ['required']
                    ]);
                }

                return $this->view('password', [
                    'name' => $valid->id
                ]);
            }
        }

        Stat::create([
            'link_id' => $link->id,
            'user_agent' => $request->server('HTTP_USER_AGENT'),
            'ip_address' => $request->ip()
        ]);

        header_remove();

        header('Last-Modified: ' . gmdate('D, d M Y H:i:s', 0) . ' GMT');
        header('Expires: ' . gmdate('D, d M Y H:i:s', 0) . ' GMT');
        header('Cache-Control: no-store, no-cache, must-revalidate');
        header('Pragma: no-cache');

        http_response_code(301);
        header('HTTP/1.1 301 Moved Permanently');
        header('Location: ' . trim($link->link), true, 301);
    }
}
