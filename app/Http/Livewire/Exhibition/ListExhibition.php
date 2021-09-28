<?php

namespace App\Http\Livewire\Exhibition;

use App\Models\Exhibition;
use Livewire\Component;
use Livewire\WithPagination;

class ListExhibition extends Component
{
    use WithPagination;

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

    public function updatingFilter($filters = 'all')
    {
        $today = date('Y-m-d');

        if($filters === 'past')
        {
            $this->exhibition->whereDate('ended_at', '<', $today);
        }
        elseif($filters === 'current')
        {
            $this->whereDate('began_at', '>', $today)
                ->whereDate('ended', '<', $today);
        }
        elseif($filters === 'future')
        {
            $this->whereDate('began_at', '>', $today);
        }

        return $this->query;
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
