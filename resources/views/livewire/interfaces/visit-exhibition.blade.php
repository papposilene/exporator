<div>
    @if (Auth::check() && $exhibition->isFollowed)
    @if (filled(Auth::user()->isFollowingExhibition->visited_at))
    <form method="POST" action="{{ route('admin.user.exhibition_unvisited') }}" class="flex flex-col w-full">
        @csrf

        <input type="hidden" name="visit" value="{{ $exhibition->hasOne(\App\Models\UserExhibition::class)->first()->uuid }}" />

        <div class="grid grid-cols-1 gap-4">
            <p>
                @ucfirst(__('app.visit_info'))
            </p>
        </div>

        <div class="grid grid-cols-1 gap-4 mt-2 lg:grid-cols-2">
            <div>
                <p class="bg-bluegray-300 dark:text-gray-800 dark:bg-bluegray-300 block py-2 px-2 rounded-md shadow-sm w-full">
                    @ucfirst(__('app.visited_at', ['date' => $exhibition->hasOne(\App\Models\UserExhibition::class)->first()->visited_at->format('d/m/Y')]))
                </p>
            </div>

            <x-forms.button class="block bg-bluegray-500 p-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="text-yellow-500 h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
                </svg>
                @ucfirst(__('app.mark_as_unvisited'))
            </x-forms.button>
        </div>
    </form>
    @endif
    @elseif (Auth::check() && !$exhibition->isFollowed)
    <form method="POST" action="{{ route('admin.user.exhibition_visited') }}" class="flex flex-col w-full">
        @csrf

        <input type="hidden" name="exhibition" value="{{ $exhibition->uuid }}" />

        <div class="grid grid-cols-1 gap-4">
            <p>
                @ucfirst(__('app.visit_info'))
            </p>
        </div>

        <div class="grid grid-cols-1 gap-4 mt-2 lg:grid-cols-2">
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="w-5 h-5 text-gray-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd">
                        </path>
                    </svg>
                </div>
                <input datepicker type="text" name="date" id="datepicker" placeholder="Select date"
                    datepicker-autohide datepicker-format="dd/mm/yyyy"
                    class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 datepicker-input">
            </div>

            <x-forms.button class="block bg-bluegray-500 p-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="text-yellow-500 h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
                </svg>
                @ucfirst(__('app.mark_as_visited'))
            </x-forms.button>
        </div>
    </form>
    @else
    <div class="flex flex-col w-full">
        <div class="grid grid-cols-1 gap-4 p-5">
            <p>
                @ucfirst(__('app.visit_login'))
            </p>
            <div>
                <a href="{{ route('login') }}" class="bg-bluegray-400 hover:bg-bluegray-600 ml-4 p-2 text-white rounded">@ucfirst(__('auth.login'))</a>
                @if (Route::has('register'))
                <a href="{{ route('register') }}" class="bg-bluegray-400 hover:bg-bluegray-600 ml-4 p-2 text-white rounded">@ucfirst(__('auth.register'))</a>
                @endif
            </div>
        </div>
    </div>
    @endif
</div>

<script>
document.addEventListener('livewire:load', function () {
    new Datepicker(document.getElementById('datepicker'));
})
</script>
