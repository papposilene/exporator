<?php

namespace App\Http\Livewire\Exhibition;

use App\Traits\WithFilter;
use App\Traits\WithSorting;
use App\Models\Exhibition;
use Livewire\Component;
use Livewire\WithPagination;

class ListExhibition extends Component
{
    use WithPagination, WithFilter, WithSorting;

    public $filter = 'all';
    public $page = 1;
    public $sort = 'asc';
    public $search = '';

    protected $queryString = [
        'filter' => ['except' => 'all'],
        'page' => ['except' => 1],
        'search' => ['except' => ''],
        'sort' => ['except' => ''],
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $exhibitions = Exhibition::where('title', 'like', '%'.$this->search.'%')
            ->where('title', 'like', '%'.$this->search.'%')
            ->orderBy('began_at', 'desc')
            ->paginate(25);

        return view('livewire.exhibition.list-exhibition', [
            'exhibitions' => $exhibitions,
        ]);
    }
}
