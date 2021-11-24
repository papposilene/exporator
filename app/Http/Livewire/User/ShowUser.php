<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class ShowUser extends Component
{
    public function render()
    {
        if( !Auth::check() || !Auth::user()->hasRole(['super-admin', 'moderator']) )
        {
            abort(403);
        }

        return view('livewire.user.show-user');
    }
}
