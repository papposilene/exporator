<?php

namespace App\Http\Livewire\Exhibition;

use App\Models\Exhibition;
use Livewire\Component;

class CalendarExhibition extends Component
{
    public $exhibitions = '';

    public function render()
    {
        $this->exhibitions = json_encode(Exhibition::all());

        dd($this->exhibitions);

        return view('livewire.exhibition.calendar-exhibition');
    }
}
