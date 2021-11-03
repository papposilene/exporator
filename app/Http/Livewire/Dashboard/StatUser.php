<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class StatUser extends Component
{
    public function render()
    {
        $year = date('Y');
        $user = User::findOrFail(Auth::id());
        $since = $year - Carbon::createFromFormat('Y-m-d', $user->created_at)->format('Y');

        return view('livewire.dashboard.stat-user',
            compact(
                'user',
                'since',
                'year'
            )
        );
    }
}
