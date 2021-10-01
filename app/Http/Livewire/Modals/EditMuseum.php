<?php

namespace App\Http\Livewire\Modals;

use App\Models\Museum;
use App\Models\Type;
use Livewire\Component;

class EditMuseum extends Component
{
    public Museum $museum;

    public function mount($museum)
    {
        $this->museum = $museum;
    }

    public function render()
    {
        $types = Type::orderBy('type')->get();

        return view('livewire.modals.edit-museum', [
            'museum' => $this->museum,
            'types' => $types,
        ]);
    }
}
