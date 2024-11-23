<?php

namespace App\Repositories;

use App\Models\Finance;
use App\Repositories\Interface\FinanceRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class FinanceRepository implements FinanceRepositoryInterface
{
    public function create(array $data): Finance
    {
        $finance = Finance::create($data);
        return $finance;
    }

    public function update(int $id, array $data): bool
    {
        $finance = Finance::findOrFail($id);
        return $finance->update($data);
    }

    public function delete(int $id): bool
    {
        $finance = Finance::findOrFail($id);
        return $finance->delete();
    }

    public function all(): \Illuminate\Database\Eloquent\Collection
    {
        return Finance::all();
    }

    public function show(int $id): Finance
    {
        return Finance::findOrFail($id);
    }

    public function paginate(): LengthAwarePaginator
    {
        return Finance::paginate(config('common.paginate'));
    }
}