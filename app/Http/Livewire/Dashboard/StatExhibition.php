<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\Exhibition;
use Livewire\Component;

class StatExhibition extends Component
{
    public function render()
    {
        $exhibitions = Exhibition::count();

        return view('livewire.dashboard.stat-exhibition',
            compact('exhibitions')
        );
    }
}
