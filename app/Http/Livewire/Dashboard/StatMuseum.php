<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\Museum;
use Livewire\Component;

class StatMuseum extends Component
{
    public function render()
    {
        $museums = Museum::count();
        $top1_of_museums = Museum::withCount('hasExhibitions')->orderBy('has_exhibitions_count', 'desc')->first();

        return view('livewire.dashboard.stat-museum',
            compact('museums', 'top1_of_museums')
        );
    }
}
