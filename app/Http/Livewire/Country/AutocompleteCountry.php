<?php

namespace App\Http\Livewire\Country;

use App\Models\Country;
use Livewire\Component;

class AutocompleteCountry extends Component
{
    public $query = '';
    public array $countries = [];
    public string $selectedCountry = '';
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
        $this->selectedCountry = '';
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

    public function selectCountry($cca3 = null)
    {
        $cca3 = $cca3 ?: $this->highlightIndex;
        $country = $this->countries[$cca3] ?? null;

        if ($country) {
            $this->showDropdown = true;
            $this->query = $country['name_common_fra'];
            $this->selectedCountry = $country['cca3'];
        }
    }

    public function updatedQuery()
    {
        $this->countries = Country::where('name_common_fra', 'like', '%' . $this->query. '%')
            ->orWhere('name_official_fra', 'like', '%' . $this->query. '%')
            ->orWhere('name_common_eng', 'like', '%' . $this->query. '%')
            ->orWhere('name_official_eng', 'like', '%' . $this->query. '%')
            ->orWhere('cca3', 'like', '%' . $this->query. '%')
            ->take(5)
            ->get()
            ->toArray();
    }

    public function render()
    {
        return view('livewire.country.autocomplete-country');
    }
}
