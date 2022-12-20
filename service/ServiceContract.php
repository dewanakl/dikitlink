<?php

namespace Service;

interface ServiceContract
{
    public function create(int $id): array;
    public function update(int $id): bool;
}
