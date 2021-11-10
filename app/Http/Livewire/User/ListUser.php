<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class ListUser extends Component
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
        }

        if (Auth::check() &&
            ((string) Str::of($this->filter)->trim() === 'followed'))
        {
            $user = Auth::id();
            $user = User::findOrFail($user);
            $users = $user->followedTags()
                ->where('name', 'like', '%'.$this->search.'%')
                ->orWhere('email', 'like', '%'.$this->search.'%')
                ->orderBy('name', 'asc')
                ->paginate(25);
        }
        else
        {
            $users = User::where('name', 'like', '%'.$this->search.'%')
                ->orWhere('email', 'like', '%'.$this->search.'%')
                ->orderBy('name', 'asc')
                ->paginate(25);
        }

        return view('livewire.user.list-user', [
            'users' => $users,
        ]);
    }
}
