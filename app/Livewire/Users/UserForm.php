<?php

namespace App\Livewire\Users;

use App\Models\User;
use App\Repositories\Interface\UserRepositoryInterface;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Illuminate\Support\Str;

use Hash;

class UserForm extends Component
{
    public $action, $id;


    #[Validate('required|min:3')]
    public $name = '';

    #[Validate('required|email')]
    public $email = '';

    public function boot(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    #[On('hit-action')]
    public function onHitAction($action)
    {
        $this->action = $action;
    }

    #[On('hit-id')]
    public function onHitId($id)
    {
        $item = $this->userRepository->show($id);
        $this->id = $id;
        $this->email = $item->email;
        $this->name = $item->name;
    }

    public function onSave()
    {
        $this->validate();

        $getUser = User::where('email', $this->email)->first();

        if (!is_null($getUser)) {
            return redirect()->route('staff.index')->with('failed', trFirst('email,exists'));
        }

        $this->userRepository->create('staff', [
            'uuid' => Str::uuid(),
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make('pass'),
            'email_verified_at' => date('Y-m-d H:i:s'),
        ]);

        $this->dispatch('refreshUserList');
        $this->dispatch('closeLwModal');
        $this->reset(['name', 'email']);
    }

    public function onUpdate()
    {
        $this->validate();

        $this->userRepository->update($this->id, [
            'name' => $this->name,
        ]);

        $this->dispatch('refreshUserList');
        $this->dispatch('closeLwModal');
        $this->reset(['name', 'email']);
    }

    public function render()
    {
        return view('livewire.users.user-form');
    }
}
