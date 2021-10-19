<?php

namespace App\Http\Livewire\Interfaces;

use App\Models\Museum;
use Livewire\Component;

class Map extends Component
{
    public Museum $museum;

    public function mount($museum)
    {
        $this->museum = $museum;
    }

    public function render()
    {
        return view('livewire.interfaces.map', [
            'museum' => $this->museum,
        ]);
    }
}
