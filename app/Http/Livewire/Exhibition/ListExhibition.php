<?php

namespace App\Http\Livewire\Exhibition;

use App\Models\Exhibition;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class ListExhibition extends Component
{
    use WithPagination;

    public $filter = '';
    public $page = 1;
    public $search = '';
    public Exhibition $exhibition;

    protected $queryString = [
        'filter' => ['except' => ''],
        'page' => ['except' => 1],
        'search' => ['except' => ''],
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $today = date('Y-m-d');

        if (Auth::check())
        {
            $canPublish = Auth::user()->can('publish exhibitions');
        }
        else
        {
            $canPublish = false;
        }


        if ($this->filter === 'past')
        {
            $exhibitions = Exhibition::when($canPublish, function ($query) {
                    return $query;
                }, function ($query) {
                    return $query->where('is_published', true);
                })
                ->where('title', 'like', '%'.$this->search.'%')
                ->where('ended_at', '<', $today)
                ->orderBy('ended_at', 'desc')
                ->paginate(25);
        }
        elseif ($this->filter === 'current')
        {
            $exhibitions = Exhibition::when($canPublish, function ($query) {
                    return $query;
                }, function ($query) {
                    return $query->where('is_published', true);
                })
                ->where('title', 'like', '%'.$this->search.'%')
                ->where('began_at', '<', $today)
                ->where('ended_at', '>', $today)
                ->orderBy('ended_at', 'desc')
                ->paginate(25);
        }
        elseif ($this->filter === 'future')
        {
            $exhibitions = Exhibition::when($canPublish, function ($query) {
                    return $query;
                }, function ($query) {
                    return $query->where('is_published', true);
                })
                ->where('title', 'like', '%'.$this->search.'%')
                ->where('began_at', '>', $today)
                ->orderBy('ended_at', 'desc')
                ->paginate(25);
        }
        else
        {
            $exhibitions = Exhibition::when($canPublish, function ($query) {
                    return $query;
                }, function ($query) {
                    return $query->where('is_published', true);
                })
                ->where('title', 'like', '%'.$this->search.'%')
                ->orderBy('ended_at', 'desc')
                ->paginate(25);
        }


        return view('livewire.exhibition.list-exhibition', [
            'exhibitions' => $exhibitions,
        ]);
    }
}
