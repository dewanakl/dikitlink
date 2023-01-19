<?php

namespace App\Services;

interface ServiceContract
{
    public function create(int $id): array;
    public function update(int $id): bool;
}
