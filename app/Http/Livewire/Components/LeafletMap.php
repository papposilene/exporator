<?php

namespace App\Http\Livewire\Components;

use Livewire\Component;

class LeafletMap extends Component
{
    public $mapApi;

    public function render()
    {
        return view('livewire.components.leaflet-map');
    }
}
