<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @ucfirst(__('app.dashboard'))
        </h2>
    </x-slot>

    <div class="py-12">
        <livewire:backend.stat-country />
        <livewire:backend.stat-museum />
        <livewire:backend.stat-exhibition />
    </div>
</div>
