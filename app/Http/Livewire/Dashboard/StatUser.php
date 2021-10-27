<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\User;
use Livewire\Component;

class StatUser extends Component
{
    public function render()
    {
        $user = User::findOrFail(Auth::id());
        
        return view('livewire.dashboard.stat-user', 
            compact(
                'user',
            );
    }
}
