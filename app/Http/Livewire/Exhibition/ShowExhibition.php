<?php

namespace App\Http\Livewire\Exhibition;

use App\Models\Exhibition;
use App\Models\Tagged;
use App\Models\UserReview;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class ShowExhibition extends Component
{
    use WithPagination;

    public $page = 1;
    public $search = '';
    public $slug;
    public Exhibition $exhibition;
    public $suggestions;

    protected $queryString = [
        'search' => ['except' => ''],
        'page' => ['except' => 1],
    ];

    public function mount($slug)
    {
        if (Auth::check())
        {
            $canPublish = Auth::user()->can('publish exhibitions');
        }
        else
        {
            $canPublish = false;
        }

        $this->exhibition = Exhibition::when($canPublish, function ($query) {
                return $query;
            }, function ($query) {
                return $query->where('is_published', true);
            })
            ->where('slug', $this->slug)
            ->firstOrFail();

        $hasTags = ($this->exhibition->isTagged()->first() ? $this->exhibition->isTagged()->first()->id : 0);
        $this->suggestions = Tagged::where('tag_id', $hasTags)
                ->inRandomOrder()
                ->take(3)
                ->get();

        $this->reviews = $this->exhibition->hasReviews()->when($canPublish, function ($query) {
                return $query;
            }, function ($query) {
                return $query->where('is_published', true);
            })
            ->orderBy('updated_at', 'desc')
            ->get();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.exhibition.show-exhibition', [
            'exhibition' => $this->exhibition,
            'suggestions' => $this->suggestions,
            'reviews' => $this->reviews,
        ]);
    }
}
