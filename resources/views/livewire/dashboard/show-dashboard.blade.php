@section('title', @ucfirst(__('app.welcome')))

<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <span>{{ config('app.name', 'Exporator') }}</span>
        </h2>
    </x-slot>

    <div>
        <div class="flex flex-col lg:flex-row flex-wrap max-w-7xl mx-auto py-5 px-6">
            <div class="flex flex-grow lg:flex-grow-0 flex-wrap bg-gray-400 p-5 shadow w-full lg:w-1/4">
                <p class="text-lg mb-3">
                    L'Exporateur, mot-valise entre <em>exposition</em> et <em>explorateur</em>, est un (énième ?)
                    site de référencement des expositions temporaires à Paris et ses proches alentours.
                </p>
                <p class="mb-3">
                    Vous trouverez sur ce site les expositions temporaires actuellement en cours et futures (et
                    celles déjà passées, mais bon...) disponibles sous la forme d’<a href="{{ route('front.exhibition.index') }}"
                    class="text-blue-700 hover:text-red-600">une simple liste</a>, d’<a href="{{ route('front.exhibition.map') }}"
                    class="text-blue-700 hover:text-red-600">une représentation cartographique</a> et
                    d’<a href="{{ route('front.exhibition.calendar') }}" class="text-blue-700 hover:text-red-600">un agenda</a>.
                </p>
            </div>
            @auth
            <div class="flex flex-grow lg:flex-grow-0 flex-wrap bg-gray-300 p-5 shadow w-full lg:w-3/4">
                <livewire:dashboard.stat-user />
            </div>
            @else
            <div class="flex flex-grow lg:flex-grow-0 flex-wrap bg-gray-300 p-5 shadow w-full lg:w-3/4">
                <div>Non connecté.</div>
            </div>
            @endauth
        </div>
        <div class="flex flex-col lg:flex-row flex-wrap max-w-7xl mx-auto -mt-7 py-5 px-6">
            <div class="flex flex-grow lg:flex-grow-0 lg:pr-2 flex-wrap shadow w-full lg:w-2/4">
                <livewire:dashboard.stat-place />
            </div>
            <div class="flex flex-grow lg:flex-grow-0 flex-wrap shadow w-full lg:w-2/4">
                <livewire:dashboard.stat-exhibition />
            </div>
        </div>
        <div class="flex flex-col lg:flex-row flex-wrap max-w-7xl mx-auto -mt-7 py-5 px-6">
            <div class="flex flex-grow flex-wrap shadow w-full">
                <livewire:dashboard.stat-tag />
            </div>
        </div>
    </div>
</div>
