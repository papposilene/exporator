<?php

namespace App\Http\Livewire\Exhibition;

use App\Models\Exhibition;
use Livewire\Component;
use Livewire\WithPagination;

class ProposeExhibition extends Component
{
    use WithPagination;

    public $page = 1;
    public $search = '';
    public $exhibition;

    protected $queryString = [
        'search' => ['except' => ''],
        'page' => ['except' => 1],
    ];

    public function mount($exhibition)
    {
        $this->exhibition = Exhibition::where('is_published', false)->get();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.exhibition.propose-exhibition', [
            'exhibition' => $this->exhibition
        ]);
    }
}
