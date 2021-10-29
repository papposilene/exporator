<?php

namespace App\Http\Livewire\Dashboard;

use Livewire\Component;
use Spatie\Tags\Tag;

class StatTag extends Component
{
    public function render()
    {
        $tags = Tag::inRandomOrder()
            ->limit(12)
            ->get();

        return view('livewire.dashboard.stat-tag', [
            'tags' => $tags,
        ]);
    }
}
