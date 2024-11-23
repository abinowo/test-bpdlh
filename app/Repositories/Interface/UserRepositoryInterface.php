<?php

namespace App\Repositories\Interface;

use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

interface UserRepositoryInterface
{
    public function all(): Collection;
    public function create(string $role, array $data): User;
    public function update(int $id, array $data): bool;
    public function delete(int $id): bool;
    public function show(int $id): User;
    public function paginate(): LengthAwarePaginator;
}