<?php

namespace App\Http\Livewire\Country;

use App\Models\Country;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    protected $queryString = ['search'];
    public $search = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.backend.country.index', [
            'countries' => Country::withCount('hasMuseums')->where('name_common_fra', 'like', '%'.$this->search.'%')->orderBy('has_museums_count', 'desc')->paginate(25),
        ]);
    }
}
