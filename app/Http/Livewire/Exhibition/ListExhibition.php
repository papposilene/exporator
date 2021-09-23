<?php

namespace App\Http\Livewire\Exhibition;

use App\Models\Exhibition;
use Livewire\Component;
use Livewire\WithPagination;

class ListExhibition extends Component
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
        $exhibitions = Exhibition::where('title', 'like', '%'.$this->search.'%')
            ->orderBy('began_at', 'asc')
            ->paginate(25);

        return view('livewire.exhibition.list-exhibition', [
            'exhibitions' => $exhibitions,
        ]);
    }
}
