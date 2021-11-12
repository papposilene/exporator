<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\Place;
use Livewire\Component;

class StatPlace extends Component
{
    public function render()
    {
        $places = Place::count();
        $top1_of_places = Place::withCount('hasExhibitions')->orderBy('has_exhibitions_count', 'desc')->first();
        $museum_type = Place::where('type', 'museum')->count();
        $gallery_type = Place::where('type', 'gallery')->count();
        $artcenter_type = Place::where('type', 'art center')->count();
        $artfair_type = Place::where('type', 'art fair')->count();
        $library_type = Place::where('type', 'library')->count();
        $foundation_type = Place::where('type', 'foundation')->count();
        $other_type = Place::where('type', 'other')->count();
        $open_places_without_exhibition = Place::where('status', 1)
            ->withCount('hasExhibitions')
            ->orderBy('name', 'asc')
            ->get();

        return view('livewire.dashboard.stat-place', [
            'places' => $places,
            'top1_of_places' => $top1_of_places,
            'museum_type' => $museum_type,
            'gallery_type' => $gallery_type,
            'artcenter_type' => $artcenter_type,
            'artfair_type' => $artfair_type,
            'library_type' => $library_type,
            'foundation_type' => $foundation_type,
            'other_type' => $other_type,
            'open_places_without_exhibition' => $open_places_without_exhibition,
        ]);
    }
}
