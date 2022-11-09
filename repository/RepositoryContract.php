<?php

namespace Repository;

interface RepositoryContract
{
    public function lastMonth(int $id);
    public function getStats(int $id, mixed $name = null, int $limit = 10);
    public function sumStats(int $id);
    public function countUnique(int $id, mixed $name = null);
    public function lastWeek(int $id, string $link);
}
