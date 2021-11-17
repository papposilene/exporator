<?php

namespace App\Http\Livewire\Statistic;

use App\Models\Exhibition;
use App\Models\Place;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class StatYear extends Component
{
    public Exhibition $exhibition;
    public Place $place;
    public User $user;
    public $year;

    public function mount()
    {
        $this->year = ($this->year ? $this->year : date('Y'));
        $this->day1 = ($this->year ? date($this->year . '-01-01') : date('Y-01-01'));
        $this->day365 = ($this->year ? date($this->year . '-12-31') : date('Y-12-31'));
        $this->user = User::findOrFail(Auth::id());
        $this->exhibitions = Exhibition::whereBetween('began_at', [$this->day1, $this->day365])
            ->orWhereBetween('ended_at', [$this->day1, $this->day365])
            ->orderBy('began_at', 'ASC')->get();
        $this->places = $this->exhibitions->groupBy(function($place) {
            // Solution found at https://stackoverflow.com/a/25538667
            return $place->inPlace->name;
            //return Carbon::parse($date->created_at)->format('m'); // grouping by months
        })->toArray();
        arsort($this->places);
    }

    public function render()
    {
        return view('livewire.statistic.stat-year', [
            'exhibitions' => $this->exhibitions,
            'places' => $this->places,
            'user' => $this->user,
            'year' => $this->year,
        ]);
    }
}
