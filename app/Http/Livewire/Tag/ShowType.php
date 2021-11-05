<?php

namespace App\Http\Livewire\Tag;

use App\Models\Tag;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class ShowType extends Component
{
    use WithPagination;

    public $page = 1;
    public $search = '';
    public $slug;
    public Tag $tag;

    protected $queryString = [
        'search' => ['except' => ''],
        'page' => ['except' => 1],
    ];

    public function mount($slug)
    {
        $this->type = Tag::where('type', $this->slug)
            ->firstOrFail();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.tag.show-type', [
            'type' => $this->type,
            'exhibitions' => $this->type->hasExhibitions()
                ->when(Auth::check(), function ($query) {
                    return $query;
                }, function ($query) {
                    return $query->where('is_published', true);
                })
                ->where('title', 'like', '%'.$this->search.'%')
                ->orderBy('began_at', 'desc')->paginate(25),
        ]);
    }
}
