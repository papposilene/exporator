<?php

namespace App\Http\Livewire\Museum;

use App\Models\Museum;
use Livewire\Component;
use Livewire\WithPagination;

class ShowMuseum extends Component
{
    use WithPagination;

    //protected $queryString = ['search'];
    public $slug;
    public Museum $museum;
    public $search = '';

    public function mount($slug)
    {
        $this->museum = Museum::where('slug', $this->slug)->firstOrFail();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.museum.show-museum', [
            'museum' => $this->museum,
            'exhibitions' => $this->museum->hasExhibitions()->paginate(25),
        ]);
    }
}
