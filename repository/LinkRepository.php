<?php

namespace Repository;

use Models\Link;

class LinkRepository implements RepositoryContract
{
    private $link;

    function __construct(Link $link)
    {
        $this->link = $link;
    }

    public function lastMonth(int $id)
    {
        $lastmonth = $this->link->join('stats', 'links.id', 'stats.link_id')
            ->where('links.user_id', $id)
            ->where('stats.created_at', date('Y-m', strtotime('-1 years', strtotime('now'))) . '-01 00:00:00.000000', '>=')
            ->groupBy('tgl')
            ->select([
                'concat(extract(YEAR from stats.created_at), \'-\', extract(MONTH from stats.created_at)) AS tgl',
                'count(stats.id) as hint'
            ])
            ->get()
            ->toArray();

        usort($lastmonth, fn ($a, $b) => strtotime($a['tgl']) - strtotime($b['tgl']));
        return $lastmonth;
    }

    public function getStats(int $id, mixed $name = null, int $limit = 10)
    {
        return function (string $select) use ($id, $name, $limit) {
            $data = $this->link->join('stats', 'links.id', 'stats.link_id')
                ->where('links.user_id', $id);

            if ($name) {
                $data = $data->where('links.name', $name);
            }

            return $data->groupBy('stats.' . $select)
                ->orderBy('hint', 'DESC')
                ->select([
                    'stats.' . $select,
                    'count(stats.id) as hint'
                ])
                ->limit($limit)
                ->get();
        };
    }

    public function sumStats(int $id)
    {
        return $this->link->leftJoin('stats', 'links.id', 'stats.link_id')
            ->where('links.user_id', $id)
            ->groupBy('links.user_id')
            ->select([
                'count(distinct links.id) as jumlah_link',
                'count(distinct stats.id) as total_pengunjung'
            ])
            ->first();
    }

    public function countUnique(int $id, mixed $name = null)
    {
        $data = $this->link->join('stats', 'links.id', 'stats.link_id')
            ->where('links.user_id', $id);

        if ($name) {
            $data = $data->where('links.name', $name);
        }

        return $data->groupBy('stats.user_agent', 'stats.ip_address')
            ->select('COUNT(stats.link_id)')
            ->get()
            ->rowCount() ?? 0;
    }

    public function lastWeek(int $id, string $link)
    {
        $lastweek = $this->link->join('stats', 'links.id', 'stats.link_id')
            ->where('links.user_id', $id)
            ->where('links.name', $link)
            ->where('stats.created_at', date('Y-m-d', strtotime('-1 week', strtotime('now'))) . ' 00:00:00.000000', '>=')
            ->groupBy('tgl')
            ->select([
                'concat(extract(YEAR from stats.created_at), \'-\', extract(MONTH from stats.created_at), \'-\', extract(DAY from stats.created_at)) AS tgl',
                'count(stats.id) as hint'
            ])
            ->get()
            ->toArray();

        usort($lastweek, fn ($a, $b) => strtotime($a['tgl']) - strtotime($b['tgl']));
        return $lastweek;
    }
}