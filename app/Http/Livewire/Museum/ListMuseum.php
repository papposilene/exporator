<?php

namespace App\Http\Livewire\Museum;

use App\Models\Museum;
use App\Models\Type;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithPagination;

class ListMuseum extends Component
{
    use WithPagination;

    public $filter = '';
    public $page = 1;
    public $search = '';
    public $type = '';

    protected $queryString = [
        'filter' => ['except' => ''],
        'page' => ['except' => 1],
        'search' => ['except' => ''],
        'type' => ['except' => ''],
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        if (Str::of($this->filter)->trim()->isNotEmpty() === 'no_exhibition')
        {
            $museums = Museum::withCount('hasExhibitions')->get();
            $museums->whereDate('began_at', '<', date('Y-m-d'))
                ->where('has_exhibitions_count', 0)
                ->where('type', $this->type)
                ->where('name', 'like', '%'.$this->search.'%')
                ->orderBy('has_exhibitions_count', 'desc')
                ->orderBy('name', 'asc')
                ->get();
        }
        elseif (Str::of($this->type)->trim()->isNotEmpty())
        {
            $museums = Museum::withCount('hasExhibitions')
                ->where('type', $this->type)
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
        
        $types = Type::orderBy('slug', 'asc')->get();

        return view('livewire.museum.list-museum', [
            'museums' => $museums,
            'types' => $types,
        ]);
    }
}
