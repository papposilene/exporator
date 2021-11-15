@section('title', @ucfirst(__('app.welcome')))
<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-bluegray-800 dark:text-bluegray-100 leading-tight">
            <span>@ucfirst(__('app.statistics'))</span>
        </h2>
    </x-slot>

    <div class="flex flex-wrap w-full max-w-7xl mx-auto">
        <div class="flex flex-row flex-wrap bg-bluegray-300 mx-6 py-5 px-6 rounded shadow w-full">
            @foreach (array_keys($years) as $yearAvailable)
            <a href="{{ route('front.stat', ['year' => $yearAvailable]) }}"
                class="bg-bluegray-700 text-white mr-2 p-2 rounded shadow }">
                {{ $yearAvailable }}
            </a>
            @endforeach
        </div>

        <div class="mx-auto lg:w-1/4 py-5 px-6 lg:px-0 lg:pr-6 w-full">
            <livewire:statistic.stat-place />
        </div>

        <div class="mx-auto lg:w-3/4 py-5 px-6">
            <livewire:statistic.stat-year :year="$year" />
        </div>
    </div>
</div>
