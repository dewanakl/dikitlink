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

    public function detail(Link $link, $id)
    {
        $getstats = $link->getStats($id);
        $sumstats = $link->sumStats($id);

        return $this->json([
            'last_month' => $link->lastMonth($id),
            'user_agent' => $getstats('user_agent'),
            'ip_address' => $getstats('ip_address'),
            'jumlah_link' => $sumstats->jumlah_link ?? 0,
            'total_pengunjung' => $sumstats->total_pengunjung ?? 0
        ]);
    }

    public function delete($id)
    {
        User::where('id', $id)->delete();
        return $this->back()->with('berhasil', 'Berhasil menghapus user');
    }
}
