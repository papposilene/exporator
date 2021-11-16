<?php

namespace App\Http\Livewire\Statistic;

use App\Models\Exhibition;
use App\Models\Place;
use Livewire\Component;

class StatYear extends Component
{
    public Exhibition $exhibition;
    public Place $place;
    public $year;

    public function mount()
    {
        $this->year = ($this->year ? $this->year : date('Y'));
        //$this->places = Place::withCount('hasExhibitions')->orderBy('has_exhibitions_count', 'DESC')->get();
        $this->exhibitions = Exhibition::whereYear('began_at', $this->year)->orderBy('began_at', 'ASC')->get();
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
            'year' => $this->year,
            'places' => $this->places,
            'exhibitions' => $this->exhibitions,
        ]);
    }
}
