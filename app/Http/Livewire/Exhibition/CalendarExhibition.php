<?php

namespace App\Http\Livewire\Exhibition;

use App\Models\Exhibition;
use Livewire\Component;

class CalendarExhibition extends Component
{
    public $page = 1;
    public $search = '';

    protected $queryString = [
        'search' => ['except' => ''],
        'page' => ['except' => 1],
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        // Bon ben vu que setlocale(LC_TIME, app()->getLocale()); ne fonctionne pas,
        // on va passer par un petit appel au fichier lang/fr/app
        // pour récupérer le nom et du jour et du mois, hein...

        $timestamp = strtotime(date('Y-m-d'));
        $year = date('Y');
        $month = date('F');
        $remaining_days = (int) date('t', $timestamp) - (int)date('j', $timestamp);
        $today = date('Y-m-d');

        $exhibitions = Exhibition::where('is_published', true)
            ->where('began_at', '>', $today)
            ->where('title', 'like', '%'.$this->search.'%')
            ->orderBy('began_at', 'asc')
            ->get();

        return view('livewire.exhibition.calendar-exhibition', [
            'year' => $year,
            'month' => $month,
            'remaining_days' => $remaining_days,
            'exhibitions' => $exhibitions,
        ]);
    }
}
