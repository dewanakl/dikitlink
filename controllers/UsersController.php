<?php

namespace Controllers;

use Core\Routing\Controller;
use Core\Valid\Validator;
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
        $valid = Validator::make([
            'id' => $id
        ], [
            'id' => ['required', 'int']
        ]);

        if ($valid->fails()) {
            return $this->json([
                'error' => $valid->failed()
            ]);
        }

        $getstats = $link->getStats($valid->id);
        $sumstats = $link->sumStats($valid->id);

        $unique = $link->join('stats', 'links.id', 'stats.link_id')
            ->where('links.user_id', $valid->id)
            ->groupBy('stats.user_agent', 'stats.ip_address')
            ->select('COUNT(stats.link_id)')
            ->get()
            ->rowCount();

        return $this->json([
            'last_month' => $link->lastMonth($valid->id),
            'user_agent' => $getstats('user_agent'),
            'ip_address' => $getstats('ip_address'),
            'jumlah_link' => $sumstats->jumlah_link ?? 0,
            'total_pengunjung' => $sumstats->total_pengunjung ?? 0,
            'unique_pengunjung' => $unique ?? 0
        ]);
    }

    public function update($id)
    {
        $newpass = substr(md5(time()), 0, 8);

        $valid = Validator::make([
            'newpass' => $newpass,
            'id' => $id
        ], [
            'newpass' => ['hash'],
            'id' => ['int']
        ]);

        User::where('id', $valid->id)->update([
            'password' => $valid->newpass
        ]);

        return $this->back()->with('berhasil', 'Mengupdate password "' . $newpass . '"');
    }

    public function delete($id)
    {
        User::where('id', $id)->delete();
        return $this->back()->with('berhasil', 'Berhasil menghapus user');
    }
}
