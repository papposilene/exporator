<?php

namespace App\Http\Livewire\Tag;

use App\Models\Exhibition;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class ListTag extends Component
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
        if (Auth::check())
        {
            $user = Auth::user();
            $team = \App\Models\Team::where('id', $user->current_team_id)->first();
        }

        if (Auth::check() &&
            ((string) Str::of($this->filter)->trim() === 'followed'))
        {
            $user = Auth::id();
            $user = User::findOrFail($user);
            $tags = $user->followedTags()
                ->where('name', 'like', '%'.$this->search.'%')
                ->orWhere('slug', 'like', '%'.$this->search.'%')
                ->orWhere('type', 'like', '%'.$this->search.'%')
                ->orderBy('name', 'asc')
                ->paginate(25);
        }
        else
        {
            $tags = Tag::where('name', 'like', '%'.$this->search.'%')
                ->orWhere('slug', 'like', '%'.$this->search.'%')
                ->orWhere('type', 'like', '%'.$this->search.'%')
                ->orderBy('type', 'asc')
                ->orderBy('name', 'asc')
                ->paginate(25);
        }

        $without_tags = Exhibition::query()->withCount('tags')->get();

        return view('livewire.tag.list-tag', [
            'tags' => $tags,
            'without_tags' => $without_tags,
        ]);
    }
}
