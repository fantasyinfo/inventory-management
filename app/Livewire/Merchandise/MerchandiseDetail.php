<?php

namespace App\Livewire\Merchandise;

use App\Models\Merchandise as ModelsMerchandise;
use Livewire\Component;

class MerchandiseDetail extends Component
{

    public $merchandise;
    public function mount($id){
        $this->merchandise = ModelsMerchandise::find($id);
    }

    public function render()
    {
        return view('livewire.merchandise.merchandise-detail')->layout('layouts.app');
    }
}
