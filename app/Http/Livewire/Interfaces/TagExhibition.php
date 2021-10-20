<?php

namespace App\Http\Livewire\Interfaces;

use App\Models\Exhibition;
use Livewire\Component;

class TagExhibition extends Component
{
    public Exhibition $exhibition;

    public function render()
    {
        return view('livewire.interfaces.tag-exhibition');
    }
}
