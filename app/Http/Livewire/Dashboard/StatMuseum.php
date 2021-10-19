<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\Museum;
use Livewire\Component;

class StatMuseum extends Component
{
    public function render()
    {
        $museums = Museum::count();
        $top1_of_museums = Museum::withCount('hasExhibitions')->orderBy('has_exhibitions_count', 'desc')->first();
        $museum_type = Museum::where('type', 'museum')->count();
        $gallery_type = Museum::where('type', 'gallery')->count();
        $artcenter_type = Museum::where('type', 'art center')->count();
        $artfair_type = Museum::where('type', 'art fair')->count();
        $library_type = Museum::where('type', 'library')->count();
        $foundation_type = Museum::where('type', 'foundation')->count();
        $other_type = Museum::where('type', 'other')->count();
        $open_museums_without_exhibition = Museum::where('status', 1)
            ->withCount('hasExhibitions')
            ->orderBy('name', 'asc')
            ->get();

        return view('livewire.dashboard.stat-museum',
            compact(
                'museums',
                'top1_of_museums',
                'museum_type',
                'gallery_type',
                'artcenter_type',
                'artfair_type',
                'library_type',
                'foundation_type',
                'other_type',
                'open_museums_without_exhibition'
            )
        );
    }
}
