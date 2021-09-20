<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @ucfirst(__('app.dashboard'))
        </h2>
    </x-slot>

    <div class="py-12">
        <livewire:dashboard.stat-country />
        <livewire:dashboard.stat-museum />
        <livewire:dashboard.stat-exhibition />
    </div>
</div>
