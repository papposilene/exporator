<?php

namespace App\Http\Livewire\Modals;

use App\Models\Type;
use Livewire\Component;

class CreatePlace extends Component
{
    public function render()
    {
        $types = Type::orderBy('type')->get();

        return view('livewire.modals.create-place', [
            'types' => $types,
        ]);
    }
}
