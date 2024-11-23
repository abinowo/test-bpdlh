<?php

namespace App\Livewire\Components;

use Livewire\Component;

class ButtonCreate extends Component
{

    public function onClickCreate()
    {
        $this->dispatch('hit-action', action: 'create');
    }

    public function render()
    {
        return view('livewire.components.button-create');
    }
}
