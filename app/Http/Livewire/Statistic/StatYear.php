<?php

namespace App\Http\Livewire\Statistic;

use App\Models\Exhibition;
use Carbon\Carbon;
use Livewire\Component;

class StatYear extends Component
{
    public $year;

    public function render()
    {
        return view('livewire.statistic.stat-year', [
            'year' => $this->year,
        ]);
    }
}
