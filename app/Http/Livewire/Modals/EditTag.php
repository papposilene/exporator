<?php

namespace App\Http\Livewire\Modals;

use App\Models\Tag;
use Livewire\Component;

class EditTag extends Component
{
    public Tag $tag;

    public function mount($tag)
    {
        $this->tag = $tag;
    }

    public function render()
    {
        return view('livewire.modals.edit-tag', [
            'tag' => $this->tag,
        ]);
    }
}
