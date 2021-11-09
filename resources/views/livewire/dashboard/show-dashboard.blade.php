@section('title', @ucfirst(__('app.welcome')))

<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-bluegray-800 dark:text-bluegray-100 leading-tight">
            <span>{{ config('app.name', 'Exporator') }}</span>
        </h2>
    </x-slot>

    <div>
        <div class="flex flex-col lg:flex-row flex-wrap max-w-7xl mx-auto py-5 px-6">
            <div class="flex flex-grow lg:flex-grow-0 flex-wrap bg-bluegray-500 text-white p-5 shadow w-full">
                @auth
                <h3 class="font-bold text-2xl mb-5">@ucfirst(__('app.welcome_to', ['name' => Auth::user()->name]))</h3>
                @else
                <h3 class="font-bold text-2xl mb-5">@ucfirst(__('app.welcome'))</h3>
                @endauth
                <div class="grid grid-cols-1 mb-3">
                    <p class="text-lg">
                        L'Exporateur, mot-valise entre <em>exposition</em> et <em>explorateur</em>, est un (énième ?)
                        site de référencement des expositions temporaires à Paris et ses proches alentours.
                    </p>
                    <p class="mb-3">
                        Vous trouverez sur ce site les expositions temporaires actuellement en cours et futures (et
                        celles déjà passées, mais bon...) disponibles sous la forme d’<a href="{{ route('front.exhibition.index') }}"
                        class="text-white hover:text-red-400">une simple liste</a> et d’<a href="{{ route('front.exhibition.map') }}"
                        class="text-white hover:text-red-400">une représentation cartographique</a>.
                    </p>
                </div>
                @guest
                <div class="mb-3">
                    <a href="{{ route('login') }}" class="text-white hover:text-red-400">@ucfirst(__('auth.login'))</a>
                    @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="text-white hover:text-red-400">@ucfirst(__('auth.register'))</a>
                    @endif
                </div>
                @endguest
            </div>
        </div>
        <div class="flex flex-col lg:flex-row flex-wrap max-w-7xl mx-auto -mt-8 py-5 px-6">
            <div class="flex flex-grow lg:flex-grow-0 lg:pr-2 flex-wrap w-full lg:w-2/4">
                <livewire:dashboard.stat-place />
            </div>
            <div class="flex flex-grow lg:flex-grow-0 flex-wrap w-full lg:w-2/4">
                <livewire:dashboard.stat-exhibition />
            </div>
        </div>
        <div class="flex flex-col lg:flex-row flex-wrap max-w-7xl mx-auto -mt-8 py-5 px-6">
            <div class="flex flex-grow flex-wrap shadow w-full">
                <livewire:dashboard.stat-tag />
            </div>
        </div>
    </div>
</div>
