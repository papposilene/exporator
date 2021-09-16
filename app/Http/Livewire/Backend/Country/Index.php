<?php

namespace App\Http\Livewire\Backend\Country;

use App\Models\Country;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public function render()
    {
        return view('livewire.backend.country.index', [
            'countries' => Country::withCount('hasMuseums')->orderBy('has_museums_count', 'desc')->paginate(25),
        ]);
    }
}
