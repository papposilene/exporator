<?php

namespace App\Http\Livewire\Tag;

use App\Models\Tag;
use Livewire\Component;
use Livewire\WithPagination;
//use Spatie\Tags\Tag;

class ListTag extends Component
{
    use WithPagination;

    public $page = 1;
    public $search = '';

    protected $queryString = [
        'search' => ['except' => ''],
        'page' => ['except' => 1],
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        //$exhibitions = Exhibition::withCount('hasTags')->get();
        $tags = Tag::where('name', 'like', '%'.$this->search.'%')
            ->orWhere('slug', 'like', '%'.$this->search.'%')
            ->orWhere('type', 'like', '%'.$this->search.'%')
            ->orderBy('type', 'asc')
            ->orderBy('name', 'asc')
            ->paginate(25);

        return view('livewire.tag.list-tag', [
            'tags' => $tags,
        ]);
    }
}
