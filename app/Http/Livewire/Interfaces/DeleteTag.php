<?php

namespace App\Http\Livewire\Interfaces;

//use App\Models\Tag;
use Livewire\Component;
use Spatie\Tags\Tag;

class DeleteTag extends Component
{
    public $tag;

    public function mount($tag)
    {
        $this->tag = Tag::where('name', 'like', '%' . $tag->name. '%')->firstOrFail();
    }

    public function render()
    {
        return view('livewire.interfaces.delete-tag', [
            'tag' => $this->tag,
        ]);
    }
}
