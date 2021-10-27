<?php

namespace App\Http\Livewire\Interfaces;

use App\Models\Place;
use Livewire\Component;

class FollowPlace extends Component
{
    public Place $place;

    public function mount($place)
    {
        $this->place = $place;
    }

    public function render()
    {
        return view('livewire.interfaces.follow-place', [
            'place' => $this->place,
        ]);
    }
}
