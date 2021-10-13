<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <span>@ucfirst(__('app.calendar_of', ['name' => __('app.exhibitions')]))</span>
        </h2>
    </x-slot>

    <div>
    <div class="max-w-7xl mx-auto py-5 px-6">
            @if ($errors->any())
            <div class="bg-red-400 border border-red-500 py-5 text-black">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <div class="relative flex items-center justify-between mb-2 w-full">
                <div class="flex">

                </div>
                <x-forms.input wire:model="search" type="search" class="ml-2" :placeholder="@ucfirst(__('app.search'))" />
            </div>
            <div class="py-5 h-screen overflow-auto">
                <h3 class="bg-gray-400 p-3 text-2xl font-bold">
                    {{ $month }} {{ $year }}
                </h3>
                @for ($ii = 0; $ii < ($remaining_days + 1); $ii++)
                @php
                $day = \Carbon\Carbon::today()->add($ii, 'day');
                $exhibitions_of_the_day = $exhibitions->where('began_at', '>=', $day->format('Y-m-d'));
                @endphp
                <h4 class="bg-gray-300 p-3 text-2xl font-bold">
                    {{ $day->formatLocalized('%A %d %B') }}
                </h4>
                <ul>
                    @foreach ($exhibitions_of_the_day as $exhibition_of_the_day)
                    <li class="bg-gray-200 p-2">
                        <a href="">
                            <em>{{ $exhibition_of_the_day->inMuseum->name }}</em><br />
                            {{ $exhibition_of_the_day->title }}
                        </a>
                    </li>
                    @endforeach
                </ul>
                @endfor
            </div>
        </div>
    </div>
</div>
