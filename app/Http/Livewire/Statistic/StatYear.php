<?php

namespace App\Http\Livewire\Statistic;

use App\Models\Exhibition;
use Livewire\Component;

class StatYear extends Component
{
    public Exhibition $exhibition;
    public $year;

    public function mount()
    {
        $this->year = ($this->year ? $this->year : date('Y'));
        $this->exhibitions = Exhibition::whereYear('began_at', $this->year)->orderBy('began_at', 'ASC')->get();
    }

    public function render()
    {
        return view('livewire.statistic.stat-year', [
            'year' => $this->year,
            'exhibitions' => $this->exhibitions,
        ]);
    }
}
