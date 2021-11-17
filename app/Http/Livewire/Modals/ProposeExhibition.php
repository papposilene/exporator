<?php

namespace App\Http\Livewire\Modals;

use App\Models\Place;
use Livewire\Component;

class ProposeExhibition extends Component
{
    public Place $place;

    public function mount($place)
    {
        $this->place = $place;
    }

    public function render()
    {
        return view('livewire.modals.propose-exhibition', [
            'place' => $this->place,
        ]);
    }
}
