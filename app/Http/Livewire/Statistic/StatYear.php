<?php

namespace App\Http\Livewire\Statistic;

use App\Models\Exhibition;
use Carbon\Carbon;
use Livewire\Component;

class StatYear extends Component
{
    public $year;
    public $years = null;

    public function mount()
    {
        $this->exhibitions = Exhibition::all();
        $this->years = $this->exhibitions->groupBy(function($date) {
            // Solution found at https://stackoverflow.com/a/25538667
            return Carbon::parse($date->began_at)->format('Y'); // grouping by years
            //return Carbon::parse($date->created_at)->format('m'); // grouping by months
        })->toArray();
    }

    public function render()
    {
        //dd( $this->years );

        return view('livewire.statistic.stat-year', [
            'years' => $this->years,
        ]);
    }
}
