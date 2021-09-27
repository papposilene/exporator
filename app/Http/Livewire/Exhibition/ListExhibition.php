<?php

namespace App\Http\Livewire\Exhibition;

use App\Traits\ForExhibition;
use App\Traits\WithSorting;
use App\Models\Exhibition;
use Livewire\Component;
use Livewire\WithPagination;

class ListExhibition extends Component
{
    use WithPagination, WithSorting;

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

    public function mount()
    {
        $this->exhibition = Exhibition::all();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingFilter($filters = 'all')
    {
        $today = date('Y-m-d');

        if($filters === 'past')
        {
            $this->exhibition->whereDate('ended_at', '<', $today);
        }
        elseif($filters === 'current')
        {
            $this->exhibition->whereDate('began_at', '>', $today)
                ->whereDate('ended', '<', $today);
        }
        elseif($filters === 'future')
        {
            $this->exhibition->whereDate('began_at', '>', $today);
        }

        return $this->exhibition;
    }

    public function render()
    {
        $exhibitions = $this->exhibition
            ->where('title', 'like', '%'.$this->search.'%')
            ->orderBy('began_at', 'desc')
            ->paginate(25);

        return view('livewire.exhibition.list-exhibition', [
            'exhibitions' => $exhibitions,
        ]);
    }
}
