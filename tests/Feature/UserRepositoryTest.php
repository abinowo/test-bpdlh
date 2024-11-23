<?php

namespace Tests\Unit;

use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Tests\TestCase;
use Illuminate\Support\Str;

class UserRepositoryTest extends TestCase
{
    use RefreshDatabase;

    protected $userRepository;

    public function setUp(): void
    {
        parent::setUp();
        $this->userRepository = new UserRepository();
        Role::create(['name' => 'staff']);
    }

    public function test_create_user()
    {
        $data = [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'uuid' => Str::uuid(),
            'password' => bcrypt('password123')
        ];
        $user = $this->userRepository->create('staff', $data);
        $this->assertInstanceOf(User::class, $user);
        $this->assertEquals($data['name'], $user->name);
        $this->assertEquals($data['email'], $user->email);
    }

    public function test_update_user()
    {
        $user = User::factory()->create(); // Assume you have a user factory
        $data = ['name' => 'Updated Name'];
        $this->userRepository->update($user->id, $data);
        $user->refresh();
        $this->assertEquals($data['name'], $user->name);
    }

    public function test_delete_user()
    {
        $user = User::factory()->create();
        $deleted = $this->userRepository->delete($user->id);
        $this->assertTrue($deleted);
        $this->assertNull(User::find($user->id));
    }

    public function test_all_users()
    {
        User::factory()->create();
        $users = $this->userRepository->all();
        $this->assertCount(1, $users);
        $this->assertInstanceOf(User::class, $users->first());
    }

    public function test_show_user()
    {
        $user = User::factory()->create();
        $foundUser = $this->userRepository->show($user->id);
        $this->assertEquals($user->id, $foundUser->id);
        $this->assertInstanceOf(User::class, $foundUser);
    }

    public function test_paginate_user()
    {
        User::factory()->count(25)->create();
        $pagination = $this->userRepository->paginate();
        $this->assertInstanceOf(\Illuminate\Contracts\Pagination\LengthAwarePaginator::class, $pagination);
        $this->assertCount(10, $pagination->items()); // Ensure 10 users per page
        $this->assertEquals(25, $pagination->total()); // Total users created
        $this->assertEquals(3, $pagination->lastPage()); // 25 users / 10 per page
    }
}