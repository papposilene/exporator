<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\Exhibition;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class StatExhibition extends Component
{
    public function render()
    {
        $today = date('Y-m-d');
        $month = date('Y-m-30');
        $month_next = date('Y-m-d', strtotime('+30 days'));
        $year = date('Y');

        $exhibitions = Exhibition::count();
        $exhibitions_future = Exhibition::whereDate('began_at', '>', $today)
            ->count();
        $exhibitions_today = Exhibition::whereDate('began_at', '<', $today)
            ->whereDate('ended_at', '>', $today)
            ->count();

        return view('livewire.dashboard.stat-exhibition', [
            'exhibitions' => $exhibitions,
            'exhibitions_future' => $exhibitions_future,
            'exhibitions_today' => $exhibitions_today,
            'user' => Auth::user(),
        ]);
    }
}
