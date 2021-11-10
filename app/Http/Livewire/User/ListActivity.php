<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class ListActivity extends Component
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
        $activities = User::where('name', 'like', '%'.$this->search.'%')
            ->orWhere('email', 'like', '%'.$this->search.'%')
            ->orderBy('name', 'asc')
            ->paginate(25);

        return view('livewire.user.list-activity', [
            'activities' => $activities,
        ]);
    }
}
