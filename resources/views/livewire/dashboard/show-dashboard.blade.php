<div>
    <div class="flex flex-row justify-center w-full">
        <livewire:dashboard.stat-country />
        <livewire:dashboard.stat-museum />
        <livewire:dashboard.stat-exhibition />
    </div>
    <div class="flex flex-row justify-center w-full">
        <livewire:components.leaflet-map wire-model="museum" />
    </div>
    <div class="flex flex-row justify-center w-full">
        <livewire:components.amcharts-timeline />
    </div>
</div>
