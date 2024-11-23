<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Interface\UserRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class UserRepository implements UserRepositoryInterface
{
    public function create(string $role = 'staff', array $data): User
    {
        $user = User::create($data);
        $user->assignRole($role);
        return $user;
    }

    public function update(int $id, array $data): bool
    {
        $user = User::findOrFail($id);
        return $user->update($data);
    }

    public function delete(int $id): bool
    {
        $user = User::findOrFail($id);
        return $user->delete();
    }

    public function all(): \Illuminate\Database\Eloquent\Collection
    {
        return User::all();
    }

    public function show(int $id): User
    {
        return User::findOrFail($id);
    }

    public function paginate(): LengthAwarePaginator
    {
        return User::paginate(config('common.paginate'));
    }
}