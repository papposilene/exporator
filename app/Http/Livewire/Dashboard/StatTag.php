<?php

namespace App\Http\Livewire\Dashboard;

use Livewire\Component;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;

class StatTag extends Component
{
    public function render()
    {
        $tags = Tag::withCount('hasExhibitions')
            ->inRandomOrder()
            ->limit(10)
            ->get();

        return view('livewire.dashboard.stat-tag', [
            'tags' => $tags,
            'user' => Auth::user(),
        ]);
    }
}
