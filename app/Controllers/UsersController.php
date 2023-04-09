<?php

namespace App\Controllers;

use Core\Database\DB;
use Core\Routing\Controller;
use Core\Valid\Validator;
use App\Models\User;
use App\Repositories\RepositoryContract;

class UsersController extends Controller
{
    public function index()
    {
        $users = DB::table('users')
            ->leftJoin('links', 'users.id', 'links.user_id')
            ->leftJoin('stats', 'links.id', 'stats.link_id')
            ->where('users.role_id', 2)
            ->groupBy('users.id')
            ->orderBy('users.id')
            ->select([
                'users.*',
                'count(DISTINCT links.id) as jumlah_link',
                'count(stats.id) as jumlah_pengunjung'
            ])
            ->get();

        return $this->view('admin/users', compact('users'));
    }

    public function detail(RepositoryContract $link, $id)
    {
        $valid = Validator::make([
            'id' => $id
        ], [
            'id' => ['required', 'max:5', 'int']
        ]);

        if ($valid->fails()) {
            return json([
                'error' => $valid->failed()
            ]);
        }

        $getstats = $link->getStats($valid->id);
        $sumstats = $link->sumStats($valid->id);

        return json([
            'last_month' => $link->lastMonth($valid->id),
            'user_agent' => $getstats('user_agent'),
            'ip_address' => $getstats('ip_address'),
            'jumlah_link' => $sumstats->jumlah_link ?? 0,
            'total_pengunjung' => $sumstats->total_pengunjung ?? 0,
            'unique_pengunjung' => $link->countUnique($valid->id)
        ]);
    }

    public function delete($id)
    {
        User::destroy($id);
        return $this->back()->with('berhasil', 'Berhasil menghapus user');
    }
}
