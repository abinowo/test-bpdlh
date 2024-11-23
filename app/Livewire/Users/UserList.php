<?php

namespace App\Livewire\Users;

use App\Models\User;
use App\Repositories\Interface\UserRepositoryInterface;
use Livewire\Component;
use Livewire\WithPagination;

class UserList extends Component
{
    use WithPagination;
    public $paginationLink;

    protected $userRepository;

    protected $listeners = [
        'refreshUserList' => '$refresh'
    ];

    public function boot(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
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
        $this->userRepository->delete($itemId);
        $this->dispatch('refreshUserList');
    }

    public function render()
    {
        return view('livewire.users.user-list', [
            'items' => $this->userRepository->paginate()
        ]);
    }
}
