<?php

namespace App\Http\Livewire;

use App\Models\Country;
use Livewire\Component;

class CountryAutocomplete extends Component
{
    public $query= '';
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

    public function selectCountry($id = null)
    {
        $id = $id ?: $this->highlightIndex;

        $account = $this->countries[$id] ?? null;

        if ($account) {
            $this->showDropdown = true;
            $this->query = $account['name'];
            $this->selectedAccount = $account['id'];
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
