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
    public $search = '';
    public Exhibition $exhibition;

    protected $queryString = [
        'filter' => ['except' => ''],
        'page' => ['except' => 1],
        'search' => ['except' => ''],
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $today = date('Y-m-d');

        if ($this->filter === 'past')
        {
            $exhibitions = Exhibition::where('is_published', true)
                ->where('title', 'like', '%'.$this->search.'%')
                ->where('ended_at', '<', $today)
                ->orderBy('began_at', 'desc')
                ->paginate(25);
        }
        elseif ($this->filter === 'current')
        {
            $exhibitions = Exhibition::where('is_published', true)
                ->where('title', 'like', '%'.$this->search.'%')
                ->where('began_at', '<', $today)
                ->where('ended_at', '>', $today)
                ->orderBy('began_at', 'desc')
                ->paginate(25);
        }
        elseif ($this->filter === 'future')
        {
            $exhibitions = Exhibition::where('is_published', true)
                ->where('title', 'like', '%'.$this->search.'%')
                ->where('began_at', '>', $today)
                ->orderBy('began_at', 'desc')
                ->paginate(25);
        }
        else
        {
            $exhibitions = Exhibition::where('is_published', true)
            ->where('title', 'like', '%'.$this->search.'%')
            ->orderBy('began_at', 'desc')
            ->paginate(25);
        }


        return view('livewire.exhibition.list-exhibition', [
            'exhibitions' => $exhibitions,
        ]);
    }
}
