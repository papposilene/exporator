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
        $this->places = Place::withCount('hasExhibitions')->orderBy('has_exhibitions_count', 'DESC')->get();
        $this->exhibitions = Exhibition::whereYear('began_at', $this->year)->orderBy('began_at', 'ASC')->get();
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
