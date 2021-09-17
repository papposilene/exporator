<?php

namespace App\Http\Livewire\Country;

use App\Models\Country;
use Livewire\Component;
use Livewire\WithPagination;

class ShowCountry extends Component
{
    use WithPagination;

    //protected $queryString = ['search'];
    public $cca3;
    public $search = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.country.show-country', [
            'country' => Country::where('cca3', $this->cca3)->firstOrFail(),
        ]);
    }
}
