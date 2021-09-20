<?php

namespace App\Http\Livewire\Country;

use App\Models\Country;
use Livewire\Component;
use Livewire\WithPagination;

class ListCountry extends Component
{
    use WithPagination;

    //protected $queryString = ['search'];
    public $search = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $countries = Country::withCount('hasMuseums')
            ->where('name_common_fra', 'like', '%'.$this->search.'%')
            ->orderBy('has_museums_count', 'desc')
            ->orderBy('name_common_fra', 'asc')
            ->paginate(25);

        return view('livewire.country.list-country',
            compact('countries')
        );
    }
}
