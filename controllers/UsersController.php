<?php

namespace Controllers;

use Core\Controller;
use Models\Link;
use Models\User;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::leftJoin('links', 'users.id', 'links.user_id')
            ->leftJoin('stats', 'links.id', 'stats.link_id')
            ->where('users.role_id', 2)
            ->groupBy('users.id')
            ->orderBy('users.id')
            ->select('users.*', 'count(DISTINCT links.id) as jumlah_link', 'count(stats.id) as jumlah_pengunjung')
            ->get();

        return $this->view('users', compact('users'));
    }

    public function detail($id)
    {
        $lastmonth = Link::join('stats', 'links.id', 'stats.link_id')
            ->where('links.user_id', $id)
            ->where('stats.created_at', date('Y-m-d H:i:s.u', strtotime('-1 month')), '>=')
            ->groupBy('tgl')
            ->orderBy('tgl')
            ->select('to_char(stats.created_at, \'YYYY-MM\') AS tgl', 'count(stats.id) as hint')
            ->get();

        $get = fn (string $select) => Link::join('stats', 'links.id', 'stats.link_id')
            ->where('links.user_id', $id)
            ->groupBy('stats.' . $select)
            ->orderBy('hint', 'DESC')
            ->select('stats.' . $select, 'count(stats.id) as hint')
            ->get();

        $sum = Link::leftJoin('stats', 'links.id', 'stats.link_id')
            ->where('links.user_id', $id)
            ->groupBy('links.user_id')
            ->select('count(distinct links.id) as jumlah_link', 'count(distinct stats.id) as total_pengunjung')
            ->first();

        return $this->json([
            'last_month' => $lastmonth,
            'user_agent' => $get('user_agent'),
            'ip_address' => $get('ip_address'),
            'jumlah_link' => $sum->jumlah_link ?? 0,
            'total_pengunjung' => $sum->total_pengunjung ?? 0
        ]);
    }

    public function delete($id)
    {
        User::where('id', $id)->delete();
        return $this->back()->with('berhasil', 'Berhasil menghapus user');
    }
}
