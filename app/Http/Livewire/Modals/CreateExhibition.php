<?php

namespace App\Http\Livewire\Modals;

use App\Models\Museum;
use Livewire\Component;

class CreateExhibition extends Component
{
    public Museum $museum;

    public function mount($museum)
    {
        $this->museum = $museum;
    }

    public function render()
    {
        return view('livewire.modals.create-exhibition', [
            'museum' => $this->museum,
        ]);
    }
}
