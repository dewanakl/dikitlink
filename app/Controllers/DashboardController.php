<?php

namespace App\Controllers;

use Core\Database\DB;
use Core\Routing\Controller;
use App\Repositories\RepositoryContract;

class DashboardController extends Controller
{
    public function __invoke(RepositoryContract $repository)
    {
        $now = date('G');
        $greeting = null;

        if ($now >= 5 && $now < 18) {
            if ($now >= 5 && $now < 10) {
                $greeting = '<i class="fa-solid fa-mug-saucer me-2"></i>Pagi';
            } else if ($now >= 10 && $now < 15) {
                $greeting = '<i class="fa-solid fa-sun me-2"></i>Siang';
            } else {
                $greeting = '<i class="fa-solid fa-mountain-sun me-2"></i>Sore';
            }
        } else {
            $greeting = '<i class="fa-solid fa-moon me-2"></i>Malam';
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
