<?php

namespace App\Http\Livewire\Dashboard;

use Livewire\Component;
use Spatie\Tags\Tag;

class StatTag extends Component
{
    public function render()
    {
        $tags = Tag::orderBy('type', 'asc')
            ->orderBy('name', 'asc')
            ->get();

        return view('livewire.dashboard.stat-tags', [
            'tags' => $tags,
        ]);
    }
}
