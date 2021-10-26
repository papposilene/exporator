<?php

namespace App\Http\Livewire\Place;

use App\Models\Place;
use Livewire\Component;
use Livewire\WithPagination;

class ShowPlace extends Component
{
    use WithPagination;

    public $page = 1;
    public $search = '';
    public $slug;
    public Place $place;

    protected $queryString = [
        'search' => ['except' => ''],
        'page' => ['except' => 1],
    ];

    public function mount($slug)
    {
        $this->place = Place::where('slug', $this->slug)->firstOrFail();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.place.show-museum', [
            'place' => $this->place,
            'exhibitions' => $this->place->hasExhibitions()
                ->where('title', 'like', '%'.$this->search.'%')
                ->orderBy('began_at', 'desc')->paginate(25),
        ]);
    }
}
