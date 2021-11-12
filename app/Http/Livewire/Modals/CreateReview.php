<?php

namespace App\Http\Livewire\Modals;

use App\Models\Exhibition;
use Livewire\Component;

class CreateReview extends Component
{
    public Exhibition $exhibition;

    public function mount($exhibition)
    {
        $this->exhibition = $exhibition;
    }

    public function render()
    {
        return view('livewire.modals.create-review', [
            'exhibition' => $this->exhibition,
        ]);
    }
}
