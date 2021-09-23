<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\Exhibition;
use Livewire\Component;

class StatExhibition extends Component
{
    public function render()
    {
        $today = date('Y-m-d');
        $month = date('m');
        $year = date('Y');

        $exhibitions = Exhibition::count();
        $exhibitions_today = Exhibition::whereDate('began_at', '<', $today)
            ->whereDate('ended_at', '<', $today)
            ->count();
        $exhibitions_finaldays = Exhibition::whereDate('ended_at', '=', $month)
            ->get();

        return view('livewire.dashboard.stat-exhibition',
            compact(
                'exhibitions',
                'exhibitions_today',
                'exhibitions_finaldays'
            )
        );
    }
}
