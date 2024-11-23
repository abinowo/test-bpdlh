<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = collect([
            [
                'role' => 'admin',
                'name' => 'admin',
                'email' => 'admin@test.com'
            ],
            [
                'role' => 'staff',
                'name' => 'staff',
                'email' => 'staff@test.com'
            ],
        ]);

        $data->each(function ($item) {
            $this->_create((object) $item);
        });
    }

    public function _create($data): void
    {
        $role = Role::create(['name' => $data->role]);

        $user = User::create([
            'uuid' => Str::uuid(),
            'name' => $data->name,
            'email' => $data->email,
            'password' => Hash::make('pass'),
            'email_verified_at' => date('Y-m-d H:i:s'),
        ]);

        $user->assignRole($role);
    }
}
