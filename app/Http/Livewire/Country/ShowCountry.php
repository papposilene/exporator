<?php

namespace App\Http\Livewire\Country;

use App\Models\Country;
use Livewire\Component;
use Livewire\WithPagination;

class ShowCountry extends Component
{
    use WithPagination;

    public $cca3;
    public $page = 1;
    public $search = '';

    protected $queryString = [
        'search' => ['except' => ''],
        'page' => ['except' => 1],
    ];

    public function mount($cca3)
    {
        $this->country = Country::where('cca3', $this->cca3)->firstOrFail();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.country.show-country', [
            'country' => $this->country,
            'museums' => $this->country->hasMuseums()->paginate(25),
        ]);
    }
}
