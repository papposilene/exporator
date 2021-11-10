<?php

namespace App\Http\Livewire\User;

use App\Models\Country;
use App\Models\Exhibition;
use App\Models\Place;
use App\Models\Type;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Activitylog\Models\Activity;

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
        $activities = Activity::orderBy('updated_at', 'desc')
            ->paginate(25);
        $exhibitions = Exhibition::select('uuid')->addSelect('title');
        $places = Place::select('uuid')->addSelect('name');
        $types = Type::select('uuid')->addSelect('type');
        $users = User::select('uuid')->addSelect('name');

        return view('livewire.user.list-activity', [
            'activities' => $activities,
            'exhibitions' => $exhibitions,
            'places' => $places,
            'types' => $types,
            'users' => $users,
        ]);
    }
}
