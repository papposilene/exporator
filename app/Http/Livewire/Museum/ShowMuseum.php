<?php

namespace App\Http\Livewire\Museum;

use App\Models\Museum;
use Livewire\Component;
use Livewire\WithPagination;

class ShowMuseum extends Component
{
    use WithPagination;

    public $page = 1;
    public $search = '';
    public $slug;
    public Museum $museum;

    protected $queryString = [
        'search' => ['except' => ''],
        'page' => ['except' => 1],
    ];

    public function mount($slug)
    {
        $this->museum = Museum::where('slug', $this->slug)->firstOrFail();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.museum.show-museum', [
            'museum' => $this->museum,
            'exhibitions' => $this->museum->hasExhibitions()->orderBy('began_at', 'desc')->paginate(25),
        ]);
    }
}
