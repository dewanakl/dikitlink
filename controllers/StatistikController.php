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
        $sumstats = $link->sumStats($id);

        $unique = $link->join('stats', 'links.id', 'stats.link_id')
            ->where('links.user_id', $id)
            ->groupBy('stats.user_agent', 'stats.ip_address')
            ->select('COUNT(stats.link_id)')
            ->get()
            ->rowCount();

        return $this->view('statistik', [
            'last_month' => $link->lastMonth($id),
            'user_agent' => $getstats('user_agent'),
            'ip_address' => $getstats('ip_address'),
            'jumlah_link' => $sumstats->jumlah_link ?? 0,
            'total_pengunjung' => $sumstats->total_pengunjung ?? 0,
            'unique_pengunjung' => $unique ?? 0
        ]);
    }

    public function click(Request $request, $id)
    {
        $valid = Validator::make([
            'id' => $id
        ], [
            'id' => ['trim', 'slug', 'str', 'min:3', 'max:30']
        ]);

        if ($valid->fails()) {
            return $this->view('hilang');
        }

        $link = Link::find($valid->id, 'name');

        if (empty($link->id)) {
            return $this->view('hilang');
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
