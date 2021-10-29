<?php

namespace App\Http\Livewire\Modals;

use App\Models\Exhibition;
use Livewire\Component;

class EditExhibition extends Component
{
    public Exhibition $exhibition;

    public function mount($exhibition)
    {
        $this->exhibition = $exhibition;
    }

    public function render()
    {
        return view('livewire.modals.edit-exhibition', [
            'exhibition' => $this->exhibition,
        ]);
    }
}
