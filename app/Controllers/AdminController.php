<?php

namespace App\Controllers;

use Core\Routing\Controller;
use Core\Http\Request;
use App\Models\Link;

class AdminController extends Controller
{
    public function index()
    {
        $lastmonth = Link::join('stats', 'links.id', 'stats.link_id')
            ->where('stats.created_at', date('Y-m', strtotime('-1 years', strtotime('now'))) . '-01 00:00:00.000000', '>')
            ->groupBy('tgl')
            ->select([
                'concat(extract(YEAR from stats.created_at), \'-\', extract(MONTH from stats.created_at)) AS tgl',
                'count(stats.id) as hint'
            ])
            ->get()
            ->toArray();

        usort($lastmonth, fn ($a, $b) => strtotime($a['tgl']) - strtotime($b['tgl']));

        $getStats = function (string $select) {
            return Link::join('stats', 'links.id', 'stats.link_id')
                ->groupBy('stats.' . $select)
                ->orderBy('hint', 'DESC')
                ->select([
                    'stats.' . $select,
                    'count(stats.id) as hint'
                ])
                ->limit(10)
                ->get();
        };

        return $this->view('admin/statistik', [
            'last_month' => $lastmonth,
            'user_agent' => $getStats('user_agent'),
            'ip_address' => $getStats('ip_address')
        ]);
    }
}
