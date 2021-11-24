<?php

namespace App\Http\Livewire\Contact;

use App\Models\Contact;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class ListContact extends Component
{
    use AuthorizesRequests;
    use WithPagination;

    public $filter = '';
    public $page = 1;
    public $search = '';

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
        if( !Auth::check() || !Auth::user()->hasRole(['super-admin', 'moderator']) )
        {
            abort(403);
        }

        $contacts = Contact::paginate(25);

        return view('livewire.contact.list-contact', [
            'contacts' => $contacts,
        ]);
    }
}
