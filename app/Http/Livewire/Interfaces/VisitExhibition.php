<?php

namespace App\Http\Livewire\Interfaces;

use App\Models\Exhibition;
use Livewire\Component;

class VisitExhibition extends Component
{
    public Exhibition $exhibition;

    public function mount($exhibition)
    {
        $this->exhibition = $exhibition;
    }

    public function render()
    {
        return view('livewire.interfaces.visit-exhibition', [
            'exhibition' => $this->exhibition,
        ]);
    }
}
