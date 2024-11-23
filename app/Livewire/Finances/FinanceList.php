<?php

namespace App\Livewire\Finances;

use App\Repositories\Interface\FinanceRepositoryInterface;
use Livewire\Component;
use Livewire\WithPagination;

class FinanceList extends Component
{
    use WithPagination;
    public $paginationLink;

    protected $financeRepository;

    protected $listeners = [
        'refreshFinanceList' => '$refresh'
    ];

    public function boot(FinanceRepositoryInterface $financeRepository)
    {
        $this->financeRepository = $financeRepository;
    }

    public function mount()
    {
    }

    public function onClickEdit($id)
    {
        $this->dispatch('hit-action', 'edit');
        $this->dispatch('hit-id', $id);
    }

    public function onDeleteItem($itemId)
    {
        $this->financeRepository->delete($itemId);
        $this->dispatch('refreshFinanceList');
    }

    public function render()
    {
        return view('livewire.finances.finance-list', [
            'items' => $this->financeRepository->paginate()
        ]);
    }
}
