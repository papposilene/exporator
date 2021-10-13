<?php

namespace App\Http\Livewire\Exhibition;

use App\Models\Exhibition;
use Livewire\Component;

class CalendarExhibition extends Component
{
    public function render()
    {
        // Bon ben vu que setlocale(LC_TIME, app()->getLocale()); ne fonctionne pas,
        // on va passer par un petit appel au fichier lang/fr/app
        // pour récupérer le nom et du jour et du mois, hein...

        $timestamp = strtotime(date('Y-m-d'));
        $year = date('Y');
        $current_month = date('F');
        $next_month = date('F', strtotime('+1 month'));
        $remaining_days = (int) date('t', $timestamp) - (int) date('j', $timestamp);
        $today = date('Y-m-d');

        $exhibitions = Exhibition::where('is_published', true)
            ->where('began_at', '>', $today)
            ->orderBy('began_at', 'asc')
            ->get();

        return view('livewire.exhibition.calendar-exhibition', [
            'year' => $year,
            'current_month' => $current_month,
            'next_month' => $next_month,
            'remaining_days' => $remaining_days,
            'exhibitions' => $exhibitions,
        ]);
    }
}
