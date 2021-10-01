<?php

namespace App\Http\Livewire\Museum;

use App\Models\Museum;
use Livewire\Component;

class AutocompleteMuseum extends Component
{
    public $query = '';
    public array $museums = [];
    public string $selectedMuseum = '';
    public int $highlightIndex = 0;
    public bool $showDropdown;

    public function mount()
    {
        $this->reset();
    }

    public function reset(...$properties)
    {
        $this->countries = [];
        $this->highlightIndex = 0;
        $this->query = '';
        $this->selectedMuseum = '';
        $this->showDropdown = true;
    }

    public function hideDropdown()
    {
        $this->showDropdown = false;
    }

    public function incrementHighlight()
    {
        if ($this->highlightIndex === count($this->museum) - 1) {
            $this->highlightIndex = 0;
            return;
        }

        $this->highlightIndex++;
    }

    public function decrementHighlight()
    {
        if ($this->highlightIndex === 0) {
            $this->highlightIndex = count($this->museum) - 1;
            return;
        }

        $this->highlightIndex--;
    }

    public function selectMuseum($name = null)
    {
        $name = $name ?: $this->highlightIndex;
        $museum = $this->museums[$name] ?? null;

        if ($museum) {
            $this->showDropdown = true;
            $this->query = $museum['name'];
            $this->selectedMuseum = $museum['uuid'];
        }
    }

    public function updatedQuery()
    {
        $this->museums = Museum::where('name', 'like', '%' . $this->query. '%')
            ->orWhere('slug', 'like', '%' . $this->query. '%')
            ->take(5)
            ->get()
            ->toArray();
    }

    public function render()
    {
        return view('livewire.museum.autocomplete-museum');
    }
}
