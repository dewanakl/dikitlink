<?php

namespace Controllers;

use Core\Auth\Auth;
use Core\Routing\Controller;
use Models\Link;

class DashboardController extends Controller
{
    public function __invoke(Link $link)
    {
        $id = Auth::user()->id;
        $sumstats = $link->sumStats($id);

        $unique = $link->join('stats', 'links.id', 'stats.link_id')
            ->where('links.user_id', $id)
            ->groupBy('stats.user_agent', 'stats.ip_address')
            ->select('COUNT(stats.link_id)')
            ->get()
            ->rowCount();

        $now = date('G');
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

        return $this->view('dashboard', [
            'salam' => $greeting,
            'jumlah_link' => $sumstats->jumlah_link ?? 0,
            'total_pengunjung' => $sumstats->total_pengunjung ?? 0,
            'unique_pengunjung' => $unique ?? 0
        ]);
    }

    public function list()
    {
        return $this->view('list');
    }
}
