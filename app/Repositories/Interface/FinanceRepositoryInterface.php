<?php

namespace App\Repositories\Interface;

use App\Models\Finance;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

interface FinanceRepositoryInterface
{
    public function all(): Collection;
    public function create(array $data): Finance;
    public function update(int $id, array $data): bool;
    public function delete(int $id): bool;
    public function show(int $id): Finance;
    public function paginate(): LengthAwarePaginator;
}