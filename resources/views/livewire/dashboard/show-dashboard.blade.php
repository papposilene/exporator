<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <span>{{ config('app.name', 'Exporator') }}</span>
        </h2>
    </x-slot>

    <div>
        <div class="flex flex-row flex-wrap max-w-7xl mx-auto py-5 px-6">
            <div class="flex sm:flex-row lg:flex-col flex-grow bg-gray-400 lg:mr-3 p-5 shadow sm:w-full lg:w-1/4">
                <p class="mb-3">
                    L'Exporateur, mot-valise entre <em>exposition</em> et <em>explorateur</em>, est un (énième ?)
                    site de référencement des expositions temporaires à Paris et ses proches alentours.
                </p>
                <p class="mb-3">

                </p>
            </div>
            <div class="flex sm:flex-row lg:flex-col flex-grow shadow sm:w-full lg:w-1/4">
                <livewire:dashboard.stat-museum />
            </div>
            <div class="flex sm:flex-row lg:flex-col flex-grow shadow lg:ml-3 sm:w-full lg:w-1/4">
                <livewire:dashboard.stat-exhibition />
            </div>
        </div>
        <div class="flex flex-row flex-wrap max-w-7xl mx-auto -mt-7 py-5 px-6">
            <livewire:dashboard.stat-tag />
        </div>
    </div>
</div>
