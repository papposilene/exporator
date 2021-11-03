<?php

namespace App\Http\Livewire\Dashboard;

use Livewire\Component;
use App\Models\Tag;

class StatTag extends Component
{
    public function render()
    {
        $tags = Tag::withCount('hasExhibitions')
            ->inRandomOrder()
            ->limit(12)
            ->get();

        return view('livewire.dashboard.stat-tag', [
            'tags' => $tags,
        ]);
    }
}
