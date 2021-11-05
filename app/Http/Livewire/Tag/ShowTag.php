<?php

namespace App\Http\Livewire\Tag;

use App\Models\Tag;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class ShowTag extends Component
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
        $this->locale = app()->getLocale();
        $this->tag = Tag::where('slug->' . $this->locale, $this->slug)
            ->firstOrFail();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.tag.show-tag', [
            'tag' => $this->tag,
            'exhibitions' => $this->tag->hasExhibitions()
                ->when(Auth::check(), function ($query) {
                    return $query;
                }, function ($query) {
                    return $query->where('is_published', true);
                })
                ->where('title', 'like', '%'.$this->search.'%')
                ->orderBy('began_at', 'desc')->paginate(25),
            'suggestions' => $this->tag->where('type', $this->tag->type)->take(5)->get(),
        ]);
    }
}
