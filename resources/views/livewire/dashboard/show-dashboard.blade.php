<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <span>{{ config('app.name', 'Exporator') }}</span>
        </h2>
    </x-slot>

    <div>
        <div class="flex flex-row max-w-7xl mx-auto py-5 sm:px-6 lg:px-8">
            <div class="flex flex-col bg-white m-5 p-5 w-2/4">
                <p class="mb-3">
                    L'Exporateur, mot-valise entre <em>exposition</em> et <em>explorateur</em>, est un (énième ?)
                    site de référencement des expositions temporaires à Paris et ses proches alentours.
                </p>
                <p class="mb-3">

                </p>
            </div>
            <div class="flex flex-col m-5 w-1/4">
                <livewire:dashboard.stat-museum />
            </div>
            <div class="flex flex-col m-5 w-1/4">
                <livewire:dashboard.stat-exhibition />
            </div>
        </div>
    </div>
</div>
