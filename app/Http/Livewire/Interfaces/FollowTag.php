<?php

namespace App\Http\Livewire\Interfaces;

use App\Models\Tag;
use Livewire\Component;

class FollowTag extends Component
{
    public Tag $tag;

    public function mount($tag)
    {
        $this->tag = $tag;
    }

    public function render()
    {
        return view('livewire.interfaces.follow-tag', [
            'tag' => $this->tag,
        ]);
    }
}
