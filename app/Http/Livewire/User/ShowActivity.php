<?php

namespace App\Http\Livewire\User;

use App\Models\Country;
use App\Models\Exhibition;
use App\Models\Place;
use App\Models\Type;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Activitylog\Models\Activity;

class ShowActivity extends Component
{
    use WithPagination;

    public $activity_id;
    public $filter = '';
    public $page = 1;
    public $search = '';
    public $countries;
    public $exhibitions;
    public $places;
    public $types;
    public $users;

    protected $queryString = [
        'filter' => ['except' => ''],
        'page' => ['except' => 1],
        'search' => ['except' => ''],
    ];

    public function mount($activity_id)
    {
        if (! Auth::user()->hasAnyRole('super-admin', 'moderator'))
        {
            abort(403);
        }

        $this->activity = Activity::findOrFail($this->activity_id);
        $this->countries = Country::all();
        $this->exhibitions = Exhibition::all();
        $this->places = Place::all();
        $this->types = Type::all();
        $this->users = User::all();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.user.show-activity', [
            'activity' => $this->activity,
            'countries' => $this->countries,
            'exhibitions' => $this->exhibitions,
            'places' => $this->places,
            'types' => $this->types,
            'users' => $this->users,
        ]);
    }
}
