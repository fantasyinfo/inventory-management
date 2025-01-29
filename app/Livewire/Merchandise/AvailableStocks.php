<?php

namespace App\Livewire\Merchandise;

use App\Models\Merchandise;
use Livewire\Component;

class AvailableStocks extends Component
{
    public $merchandises = [];
    public function mount()
    {
        $this->merchandises = Merchandise::all();
    }



    public function render()
    {
        return view('livewire.merchandise.available-stocks', [
            'merchandises' => $this->merchandises
        ])->layout('layouts.app');
    }
}
