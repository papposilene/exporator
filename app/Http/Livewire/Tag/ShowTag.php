<?php

namespace App\Http\Livewire\Tag;

use App;
use App\Models\Tag;
use Livewire\Component;
use Livewire\WithPagination;
//use Spatie\Tags\Tag;

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
        $this->locale = App::currentLocale();
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
                ->where('title', 'like', '%'.$this->search.'%')
                ->orderBy('began_at', 'desc')->paginate(25),
        ]);
    }
}
