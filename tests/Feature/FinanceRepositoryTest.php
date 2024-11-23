<?php

namespace Tests\Feature;

use App\Models\Finance;
use App\Repositories\FinanceRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FinanceRepositoryTest extends TestCase
{
    use RefreshDatabase;
    protected $financeRepository;

    // Setup method
    public function setUp(): void
    {
        parent::setUp();
        $this->financeRepository = new FinanceRepository();
    }

    public function test_create_finance()
    {
        $data = [
            'amount' => 10000,
            'type' => 'in',
        ];
        $finance = $this->financeRepository->create($data);
        $this->assertInstanceOf(Finance::class, $finance);
        $this->assertEquals($data['amount'], $finance->amount);
        $this->assertEquals($data['type'], $finance->type);
    }

    public function test_update_finance()
    {
        $finance = Finance::factory()->create();
        $data = ['amount' => 12000];
        $this->financeRepository->update($finance->id, $data);
        $finance->refresh();
        $this->assertEquals($data['amount'], $finance->amount);
    }

    public function test_delete_finance()
    {
        $finance = Finance::factory()->create();
        $deleted = $this->financeRepository->delete($finance->id);
        $this->assertTrue($deleted);
        $this->assertNull(Finance::find($finance->id));
    }

    public function test_all_finances()
    {
        Finance::factory()->create();
        $finances = $this->financeRepository->all();
        $this->assertCount(1, $finances);
        $this->assertInstanceOf(Finance::class, $finances->first());
    }

    public function test_show_finance()
    {
        $finance = Finance::factory()->create();
        $foundFinance = $this->financeRepository->show($finance->id);
        $this->assertEquals($finance->id, $foundFinance->id);
        $this->assertInstanceOf(Finance::class, $foundFinance);
    }

    public function test_paginate_finance()
    {
        Finance::factory()->count(25)->create();
        $pagination = $this->financeRepository->paginate();
        $this->assertInstanceOf(\Illuminate\Contracts\Pagination\LengthAwarePaginator::class, $pagination);
        $this->assertCount(10, $pagination->items()); // Ensure 10 users per page
        $this->assertEquals(25, $pagination->total()); // Total users created
        $this->assertEquals(3, $pagination->lastPage()); // 25 users / 10 per page
    }
}
