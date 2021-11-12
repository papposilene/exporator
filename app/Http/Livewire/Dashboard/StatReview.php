<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\Review;
use Livewire\Component;

class StatExhibition extends Component
{
    public function render()
    {
        $reviews = Review::all();

        return view('livewire.dashboard.stat-review', [
            'reviews' => $reviews,
        ]);
    }
}
