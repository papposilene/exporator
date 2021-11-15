<?php

namespace App\Http\Livewire\Statistic;

use App\Models\Exhibition;
use Carbon\Carbon;
use Livewire\Component;

class ShowStatistic extends Component
{
    public function render()
    {
        $exhibitions = Exhibition::all();
        $years = $exhibitions->groupBy(function($date) {
            // Solution found at https://stackoverflow.com/a/25538667
            return Carbon::parse($date->began_at)->format('Y'); // grouping by years
            //return Carbon::parse($date->created_at)->format('m'); // grouping by months
        })->toArray();


        return view('livewire.statistic.show-statistic', [
            'years' => $years,
        ]);
    }
}
