<?php

namespace App\Http\Livewire\Interfaces;

use App\Models\Exhibition;
use Livewire\Component;

class PublishExhibition extends Component
{
    public Exhibition $exhibition;

    public function mount($exhibition)
    {
        $this->exhibition = $exhibition;
    }

    public function render()
    {
        return view('livewire.interfaces.publish-exhibition', [
            'exhibition' => $this->exhibition,
        ]);
    }
}
