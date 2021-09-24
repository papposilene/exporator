<?php

namespace App\Http\Livewire\Museum;

use App\Models\Museum;
use Livewire\Component;
use Livewire\WithPagination;

class ListMuseum extends Component
{
    use WithPagination;

    public $page = 1;
    public $search = '';

    protected $queryString = [
        'search' => ['except' => ''],
        'page' => ['except' => 1],
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $museums = Museum::withCount('hasExhibitions')
            ->where('name', 'like', '%'.$this->search.'%')
            ->orderBy('has_exhibitions_count', 'desc')
            ->orderBy('name', 'asc')
            ->paginate(25);

        return view('livewire.museum.list-museum', [
            'museums' => $museums,
        ]);
    }
}
