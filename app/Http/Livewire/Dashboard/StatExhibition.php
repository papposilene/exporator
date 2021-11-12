<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\Exhibition;
use Livewire\Component;

class StatExhibition extends Component
{
    public function render()
    {
        $today = date('Y-m-d');
        $month = date('Y-m-30');
        $month_next = date('Y-m-01', strtotime('+1 month'));
        $year = date('Y');

        $exhibitions = Exhibition::count();
        $exhibitions_today = Exhibition::whereDate('began_at', '<', $today)
            ->whereDate('ended_at', '>', $today)
            ->count();
        $exhibitions_nextmonth = Exhibition::whereDate('began_at', '>', $month_next)
            ->count();
        $exhibitions_finaldays = Exhibition::whereDate('ended_at', '=', $month)
            ->get();


        return view('livewire.dashboard.stat-exhibition', [
            'exhibitions' => $exhibitions,
            'exhibitions_today' => $exhibitions_today,
            'exhibitions_finaldays' => $exhibitions_finaldays,
            'exhibitions_nextmonth' => $exhibitions_nextmonth,
        ]);
    }
}
