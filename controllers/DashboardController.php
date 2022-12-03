<?php

namespace Controllers;

use Core\Database\DB;
use Core\Routing\Controller;
use Repository\RepositoryContract;

class DashboardController extends Controller
{
    public function __invoke(RepositoryContract $repository)
    {
        $now = date('G');
        $greeting = null;

        if ($now >= 5 && $now < 18) {
            if ($now >= 5 && $now < 10) {
                $greeting = 'Pagi';
            } else if ($now >= 10 && $now < 15) {
                $greeting = 'Siang';
            } else {
                $greeting = 'Sore';
            }
        } else {
            $greeting = 'Malam';
        }

        $sumstats = $repository->sumStats(auth()->id());

        return $this->view('dashboard', [
            'salam' => $greeting,
            'jumlah_link' => $sumstats->jumlah_link ?? 0,
            'total_pengunjung' => $sumstats->total_pengunjung ?? 0,
            'unique_pengunjung' => $repository->countUnique(auth()->id())
        ]);
    }

    public function list()
    {
        DB::table('users')->where('id', auth()->user()->id)->update(['last_active' => now()]);
        return $this->view('list');
    }
}
