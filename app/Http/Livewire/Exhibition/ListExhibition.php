<?php

namespace App\Http\Livewire\Exhibition;

use App\Models\Exhibition;
use Livewire\Component;
use Livewire\WithPagination;

class ListExhibition extends Component
{
    use WithPagination;

    public $filter = '';
    public $page = 1;
    public $sort = 'asc';
    public $search = '';
    public Exhibition $exhibition;

    protected $queryString = [
        'filter' => ['except' => ''],
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
        $today = date('Y-m-d');

        $exhibitions = Exhibition::where('title', 'like', '%'.$this->search.'%')
            ->where('title', 'like', '%'.$this->search.'%')
            ->whereDate('ended_at', '>', $today)
            ->orderBy('began_at', 'desc')
            ->paginate(25);

        return view('livewire.exhibition.list-exhibition', [
            'exhibitions' => $exhibitions,
        ]);
    }
}
