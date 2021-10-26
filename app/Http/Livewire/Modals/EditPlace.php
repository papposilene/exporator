<?php

namespace App\Http\Livewire\Modals;

use App\Models\Place;
use App\Models\Type;
use Livewire\Component;

class EditPlace extends Component
{
    public Place $place;

    public function mount($place)
    {
        $this->place = $place;
    }

    public function render()
    {
        $types = Type::orderBy('type')->get();

        return view('livewire.modals.edit-place', [
            'place' => $this->place,
            'types' => $types,
        ]);
    }
}
