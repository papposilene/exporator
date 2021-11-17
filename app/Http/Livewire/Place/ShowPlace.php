<?php

namespace App\Http\Livewire\Place;

use App\Models\Place;
use Illuminate\Support\Facades\Auth;
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
        if (Auth::check())
        {
            $canPublish = Auth::user()->can('publish exhibitions');
        }
        else
        {
            $canPublish = false;
        }

        return view('livewire.place.show-place', [
            'place' => $this->place,
            'exhibitions' => $this->place->hasExhibitions()
                ->when($canPublish, function ($query) {
                    return $query;
                }, function ($query) {
                    return $query->where('is_published', true);
                })
                ->where('title', 'like', '%'.$this->search.'%')
                ->orderBy('began_at', 'desc')
                ->paginate(25),
        ]);
    }
}
