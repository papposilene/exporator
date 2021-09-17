<?php

namespace App\Http\Livewire\Museum;

use App\Models\Museum;
use Livewire\Component;
use Livewire\WithPagination;

class ListMuseum extends Component
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
        return view('livewire.museum.list-museum', [
            'museums' => Museum::withCount('hasExhibitions')->where('name', 'like', '%'.$this->search.'%')->orderBy('has_exhibitions_count', 'desc')->paginate(25),
        ]);
    }
}
