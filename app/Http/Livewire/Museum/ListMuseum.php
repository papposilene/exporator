<?php

namespace App\Http\Livewire\Museum;

use App\Models\Museum;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithPagination;

class ListMuseum extends Component
{
    use WithPagination;

    public $filter = '';
    public $page = 1;
    public $search = '';

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
        if (Str::of($this->filter)->trim()->isNotEmpty())
        {
            $museums = Museum::withCount('hasExhibitions')
                ->where('type', $this->filter)
                ->where('name', 'like', '%'.$this->search.'%')
                ->orderBy('has_exhibitions_count', 'desc')
                ->orderBy('name', 'asc')
                ->paginate(25);
        }
        else
        {
            $museums = Museum::withCount('hasExhibitions')
                ->where('name', 'like', '%'.$this->search.'%')
                ->orderBy('has_exhibitions_count', 'desc')
                ->orderBy('name', 'asc')
                ->paginate(25);
        }

        return view('livewire.museum.list-museum', [
            'museums' => $museums,
        ]);
    }
}
