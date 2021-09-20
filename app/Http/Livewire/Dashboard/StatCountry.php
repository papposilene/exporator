<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\Country;
use Livewire\Component;

class StatCountry extends Component
{
    public function render()
    {
        $countries = Country::count();

        return view('livewire.dashboard.stat-country',
            compact('countries')
        );
    }
}
