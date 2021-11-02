<?php

namespace App\Http\Livewire\Exhibition;

use App\Models\Exhibition;
use App\Models\Tagged;
use Livewire\Component;
use Livewire\WithPagination;

class ShowExhibition extends Component
{
    use WithPagination;

    public $page = 1;
    public $search = '';
    public Exhibition $exhibition;
    public $suggestions;

    protected $queryString = [
        'search' => ['except' => ''],
        'page' => ['except' => 1],
    ];

    public function mount($exhibition)
    {
        $this->exhibition = Exhibition::where('slug', $this->exhibition)->firstOrFail();
        $this->suggestions = Tagged::where('taggable_id', $this->exhibition)->get();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.exhibition.show-exhibition', [
            'exhibition' => $this->exhibition,
            'suggestions' => $this->suggestions
        ]);
    }
}
