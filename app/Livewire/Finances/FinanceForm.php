<?php

namespace App\Livewire\Finances;

use App\Repositories\Interface\FinanceRepositoryInterface;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;

class FinanceForm extends Component
{
    public $action, $id;


    #[Validate('required|numeric')]
    public $amount = '';

    #[Validate('required')]
    public $type = 'in';

    public function boot(FinanceRepositoryInterface $financeRepository)
    {
        $this->financeRepository = $financeRepository;
    }

    #[On('hit-action')]
    public function onHitAction($action)
    {
        $this->action = $action;
    }

    #[On('hit-id')]
    public function onHitId($id)
    {
        $item = $this->financeRepository->show($id);
        $this->id = $id;
        $this->amount = $item->amount;
        $this->type = $item->type;
    }

    public function onSave()
    {
        $this->validate();

        $this->financeRepository->create([
            'amount' => $this->amount,
            'type' => $this->type,
        ]);

        $this->dispatch('refreshFinanceList');
        $this->dispatch('closeLwModal');
        $this->type = 'in';
        $this->reset(['amount']);
    }

    public function onUpdate()
    {
        $this->validate();

        $this->financeRepository->update($this->id, [
            'amount' => $this->amount,
            'type' => $this->type
        ]);

        $this->dispatch('refreshFinanceList');
        $this->dispatch('closeLwModal');
        $this->type = 'in';
        $this->reset(['amount']);
    }

    public function render()
    {
        return view('livewire.finances.finance-form');
    }
}
