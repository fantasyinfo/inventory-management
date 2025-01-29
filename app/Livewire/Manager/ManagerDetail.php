<?php

namespace App\Livewire\Manager;

use App\Models\User;
use Livewire\Component;

class ManagerDetail extends Component
{

    public $manager;

    public function mount($id)
    {
        $this->manager = User::findOrFail($id);
    }

    public function render()
    {
        return view('livewire.manager.manager-detail')->layout('layouts.app');
    }
}
