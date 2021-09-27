<?php

namespace App\Http\Livewire\Exhibition;

use App\Traits\ForExhibition;
use App\Traits\WithSorting;
use App\Models\Exhibition;
use Livewire\Component;
use Livewire\WithPagination;

class ListExhibition extends Component
{
    use WithPagination, ForExhibition, WithSorting;

    public $filter = 'all';
    public $page = 1;
    public $sort = 'asc';
    public $search = '';
    public Exhibition $exhibition;

    protected $queryString = [
        'filter' => ['except' => 'all'],
        'page' => ['except' => 1],
        'search' => ['except' => ''],
        'sort' => ['except' => 'asc'],
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $exhibitions = Exhibition::where('title', 'like', '%'.$this->search.'%')
            ->where('title', 'like', '%'.$this->search.'%')
            ->filter($this->filter)
            ->orderBy('began_at', 'desc')
            ->paginate(25);

        return view('livewire.exhibition.list-exhibition', [
            'exhibitions' => $exhibitions,
        ]);
    }
}
