<?php

namespace App\Http\Livewire\Contact;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class ShowContact extends Component
{
    public function render()
    {
        if( !Auth::check() || !Auth::user()->hasRole(['super-admin', 'moderator']) )
        {
            abort(403);
        }

        return view('livewire.contact.show-contact');
    }
}
