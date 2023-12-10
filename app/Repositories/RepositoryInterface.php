<?php

namespace App\Repositories;

interface RepositoryInterface
{
    public function find(int|string $id);
    public function all();
    public function create(array $data);
    public function update(array $data, string|int $id);
    public function delete(int|string $id);
}
