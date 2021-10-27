<?php

namespace App\Http\Livewire\Interfaces;

use App\Models\Place;
use Livewire\Component;

class AutocompletePlace extends Component
{
    public $query = '';
    public array $places = [];
    public string $selectedPlace = '';
    public int $highlightIndex = 0;
    public bool $showDropdown;

    public function mount()
    {
        $this->reset();
    }

    public function reset(...$properties)
    {
        $this->places = [];
        $this->highlightIndex = 0;
        $this->query = '';
        $this->selectedPlace = '';
        $this->showDropdown = true;
    }

    public function hideDropdown()
    {
        $this->showDropdown = false;
    }

    public function incrementHighlight()
    {
        if ($this->highlightIndex === count($this->places) - 1) {
            $this->highlightIndex = 0;
            return;
        }

        $this->highlightIndex++;
    }

    public function decrementHighlight()
    {
        if ($this->highlightIndex === 0) {
            $this->highlightIndex = count($this->places) - 1;
            return;
        }

        $this->highlightIndex--;
    }

    public function selectPlace($uuid = null)
    {
        $uuid = $uuid ?: $this->highlightIndex;
        $place = $this->places[$uuid] ?? null;

        if ($place) {
            $this->showDropdown = true;
            $this->query = $place['name'];
            $this->selectedPlace = $place['uuid'];
        }
    }

    public function updatedQuery()
    {
        $this->places = Place::where('name', 'like', '%' . $this->query. '%')
            ->take(5)
            ->get()
            ->toArray();
    }

    public function render()
    {
        return view('livewire.interfaces.autocomplete-place');
    }
}
