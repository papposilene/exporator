<?php

namespace App\Http\Livewire\Components;

use Livewire\Component;

class LeafletMap extends Component
{
    public $api = 'museum';

    public function render()
    {
        return view('livewire.components.leaflet-map', [
            'api' => $this->api,
        ]);
    }
}
