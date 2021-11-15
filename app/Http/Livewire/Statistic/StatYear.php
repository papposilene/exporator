<?php

namespace App\Http\Livewire\Statistic;

use Livewire\Component;

class StatYear extends Component
{
    public $year;

    public function mount()
    {
        $this->year = ($this->year ? $this->year : date('Y'));
    }

    public function render()
    {
        return view('livewire.statistic.stat-year', [
            'year' => $this->year,
        ]);
    }
}
