@section('title', @ucfirst(__('app.welcome')))
<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-bluegray-800 dark:text-bluegray-100 leading-tight">
            <span>@ucfirst(__('app.statistics'))</span>
        </h2>
    </x-slot>

    <div class="flex flex-wrap w-full max-w-7xl mx-auto">
        <div class="mx-auto md:w-1/4 py-5 px-6 w-full">
            <livewire:statistic.stat-place />
        </div>

        <div class="mx-auto md:w-3/4 py-5 px-6">
            <livewire:statistic.stat-year />
        </div>
    </div>
</div>
