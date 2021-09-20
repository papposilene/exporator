<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\Museum;
use Livewire\Component;

class StatMuseum extends Component
{
    public function render()
    {
        $museums = Museum::count();

        return view('livewire.dashboard.stat-museum',
            compact('museums')
        );
    }
}
