<?php

namespace App\Http\Livewire\Country;

use App\Models\Country;
use Livewire\Component;

class AutocompleteCountry extends Component
{
    public $query = '';
    public array $countries = [];
    public int $selectedCountry = 0;
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
        $this->selectedCountry = 0;
        $this->showDropdown = true;
    }

    public function hideDropdown()
    {
        $this->showDropdown = false;
    }

    public function incrementHighlight()
    {
        if ($this->highlightIndex === count($this->countries) - 1) {
            $this->highlightIndex = 0;
            return;
        }

        $this->highlightIndex++;
    }

    public function decrementHighlight()
    {
        if ($this->highlightIndex === 0) {
            $this->highlightIndex = count($this->countries) - 1;
            return;
        }

        $this->highlightIndex--;
    }

    public function selectCountry($uuid = null)
    {
        $uuid = $uuid ?: $this->highlightIndex;

        $country = $this->countries[$uuid] ?? null;

        if ($country) {
            $this->showDropdown = true;
            $this->query = $country['name'];
            $this->selectedCountry = $country['cca3'];
        }
    }

    public function updatedQuery()
    {
        $this->countries = Country::where('name_common_fra', 'like', '%' . $this->query. '%')
            ->orWhere('name_official_fra', 'like', '%' . $this->query. '%')
            ->orWhere('name_common_eng', 'like', '%' . $this->query. '%')
            ->orWhere('name_official_eng', 'like', '%' . $this->query. '%')
            ->take(5)
            ->get()
            ->toArray();
    }

    public function render()
    {
        return view('livewire.country.autocomplete-country');
    }
}
