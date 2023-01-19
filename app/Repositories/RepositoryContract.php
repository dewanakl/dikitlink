<?php

namespace App\Repositories;

use Closure;

interface RepositoryContract
{
    public function lastMonth(int $id): array;
    public function getStats(int $id, mixed $name = null, int $limit = 10): Closure;
    public function sumStats(int $id): object;
    public function countUnique(int $id, mixed $name = null): int;
    public function lastWeek(int $id, string $link): array;
    public function lastClick(int $id, string $link): string|null;
}
