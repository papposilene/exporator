<?php

namespace App\Http\Livewire\Place;

use App\Models\Place;
use App\Models\Type;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class ListPlace extends Component
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
        if (Str::of($this->filter)->trim()->isNotEmpty() === 'followed')
        {
            $user = Auth::id();
            $museums = User::findOrFail($user);
            $places->followedPlaces()
                ->where('type', $this->type)
                ->where('name', 'like', '%'.$this->search.'%')
                ->orderBy('has_exhibitions_count', 'desc')
                ->orderBy('name', 'asc')
                ->get();
        }
        elseif (Str::of($this->filter)->trim()->isNotEmpty() === 'no_exhibition')
        {
            $places = Place::withCount('hasExhibitions')->get();
            $places->whereDate('ended_at', '<', date('Y-m-d'))
                ->where('has_exhibitions_count', 0)
                ->where('type', $this->type)
                ->where('name', 'like', '%'.$this->search.'%')
                ->orderBy('has_exhibitions_count', 'desc')
                ->orderBy('name', 'asc')
                ->get();
        }
        elseif (Str::of($this->type)->trim()->isNotEmpty())
        {
            $places = Place::withCount('hasExhibitions')
                ->where('type', $this->type)
                ->where('name', 'like', '%'.$this->search.'%')
                ->orderBy('has_exhibitions_count', 'desc')
                ->orderBy('name', 'asc')
                ->paginate(25);
        }
        else
        {
            $places = Place::withCount('hasExhibitions')
                ->where('name', 'like', '%'.$this->search.'%')
                ->orderBy('has_exhibitions_count', 'desc')
                ->orderBy('name', 'asc')
                ->paginate(25);
        }
        
        $types = Type::orderBy('slug', 'asc')->get();

        return view('livewire.place.list-museum', [
            'places' => $places,
            'types' => $types,
        ]);
    }
}
