<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class StatUser extends Component
{
    public function render()
    {
        $year = date('Y');
        $user = User::findOrFail(Auth::id());
        $since = $eayr - date('Y', $user->created_at);

        return view('livewire.dashboard.stat-user',
            compact(
                'user',
                'since',
                'year'
            )
        );
    }
}
