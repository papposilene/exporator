<?php

namespace App\Http\Livewire\Interfaces;

use App\Models\Tag;
use Livewire\Component;

class AutocompleteTag extends Component
{
    public $query = '';
    public array $tags = [];
    public string $selectedTag = '';
    public int $highlightIndex = 0;
    public bool $showDropdown;

    public function mount()
    {
        $this->reset();
    }

    public function reset(...$properties)
    {
        $this->tags = [];
        $this->highlightIndex = 0;
        $this->query = '';
        $this->selectedTag = '';
        $this->showDropdown = true;
    }

    public function hideDropdown()
    {
        $this->showDropdown = false;
    }

    public function incrementHighlight()
    {
        if ($this->highlightIndex === count($this->tags) - 1) {
            $this->highlightIndex = 0;
            return;
        }

        $this->highlightIndex++;
    }

    public function decrementHighlight()
    {
        if ($this->highlightIndex === 0) {
            $this->highlightIndex = count($this->tags) - 1;
            return;
        }

        $this->highlightIndex--;
    }

    public function selectTag($slug = null)
    {
        $slug = $slug ?: $this->highlightIndex;
        $tag = $this->tags[$slug] ?? null;

        if ($tag) {
            $this->showDropdown = true;
            $this->query = $tag['name'];
            $this->selectedTag = $tag['name'];
            $this->selectedType = $tag['type'];
        }
    }

    public function updatedQuery()
    {
        $lang = app()->getLocale();

        $this->tags = Tag::where('name', 'like', '%' . $this->query. '%')
            ->orWhere('slug', 'like', '%' . $this->query. '%')
            ->orWhere('type', 'like', '%' . $this->query. '%')
            ->take(5)
            ->get()
            ->map(function ($item, $key) use ($lang) {
                return [
                    'id' => $item->id,
                    'name' => $item->getTranslation('name', $lang),
                    'slug' => $item->getTranslation('slug', $lang),
                    'type' => $item->type,
                ];
            })
            ->toArray();
    }

    public function render()
    {
        return view('livewire.interfaces.autocomplete-tag');
    }
}
