@section('title', @ucfirst(__('app.welcome')))

<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <span>{{ config('app.name', 'Exporator') }}</span>
        </h2>
    </x-slot>

    <div>
        <div class="flex flex-row flex-wrap max-w-7xl mx-auto py-5 px-6">
            <div class="flex sm:flex-row lg:flex-col flex-grow flex-wrap bg-gray-300 lg:mr-3 p-5 shadow sm:w-full lg:w-1/4">
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
            <div class="flex sm:flex-row lg:flex-col flex-grow flex-wrap bg-yellow-300 lg:mr-3 p-5 shadow sm:w-full lg:w-3/4">
                <livewire:dashboard.stat-user />
            </div>
        </div>
        <div class="flex flex-row flex-wrap max-w-7xl mx-auto -mt-7 py-5 px-6">
            <div class="flex sm:flex-row lg:flex-col flex-grow flex-wrap bg-gray-300 lg:mr-3 p-5 shadow sm:w-full lg:w-1/3">
                <livewire:dashboard.stat-place />
            </div>
            <div class="flex sm:flex-row lg:flex-col flex-grow flex-wrap bg-gray-300 lg:mr-3 p-5 shadow sm:w-full lg:w-1/3">
                <livewire:dashboard.stat-exhibition />
            </div>
            <div class="flex sm:flex-row lg:flex-col flex-grow flex-wrap bg-gray-300 lg:mr-3 p-5 shadow sm:w-full lg:w-1/3">
                <livewire:dashboard.stat-tag />
            </div>
        </div>
    </div>
</div>
