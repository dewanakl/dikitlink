<?php

namespace Models;

use Core\Model;

final class Link extends Model
{
    protected $table = 'links';

    protected $primaryKey = 'id';

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    public function lastMonth(int $id)
    {
        return $this->join('stats', 'links.id', 'stats.link_id')
            ->where('links.user_id', $id)
            ->where('stats.created_at', date('Y-m-d H:i:s.u', strtotime('-1 month')), '>=')
            ->groupBy('tgl')
            ->orderBy('tgl')
            ->select('concat(extract(YEAR from stats.created_at), \'-\', extract(MONTH from stats.created_at)) AS tgl', 'count(stats.id) as hint')
            ->get();
    }

    public function getStats(int $id)
    {
        return fn (string $select) => $this->join('stats', 'links.id', 'stats.link_id')
            ->where('links.user_id', $id)
            ->groupBy('stats.' . $select)
            ->orderBy('hint', 'DESC')
            ->select('stats.' . $select, 'count(stats.id) as hint')
            ->get();
    }

    public function sumStats(int $id)
    {
        return $this->leftJoin('stats', 'links.id', 'stats.link_id')
            ->where('links.user_id', $id)
            ->groupBy('links.user_id')
            ->select('count(distinct links.id) as jumlah_link', 'count(distinct stats.id) as total_pengunjung')
            ->first();
    }
}
