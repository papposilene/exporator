<?php

namespace App\Http\Livewire\Review;

use App\Models\Exhibition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CreateReview extends Component
{
    public $uuid;
    public Exhibition $exhibition;

    public function mount()
    {
        if (! Auth::user()->can('create reviews'))
        {
            abort('403');
        }

        $this->exhibition = Exhibition::findOrFail($this->uuid);
    }

    public function render()
    {
        return view('livewire.review.create-review', [
            'exhibition' => $this->exhibition,
        ]);
    }
}
