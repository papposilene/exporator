<?php

namespace App\Http\Livewire\Backend;

use App\Models\Country;
use Livewire\Component;

class StatCountry extends Component
{
    public function render()
    {
        $ountries = Country::count();

        return view('livewire.backend.stat-country',
            compact('countries')
        );
    }
}
