<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\Country;
use Livewire\Component;

class StatCountry extends Component
{
    public function render()
    {
        $countries = Country::count();
        $top1_of_countries = Country::withCount('hasMuseums')->orderBy('has_museums_count', 'desc')->first();

        return view('livewire.dashboard.stat-country',
            compact('countries', 'top1_of_countries')
        );
    }
}
