@section('title', @ucfirst(__('app.calendar_of', ['name' => __('app.exhibitions')])))

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
            <h3 class="bg-gray-400 p-3 text-2xl font-bold">
                @ucfirst(__('date.' . lcfirst($month))) {{ $year }}
            </h3>
            <div class="h-screen overflow-auto">
                @for ($ii = 0; $ii < ($remaining_days + 1); $ii++)
                @php
                $day = \Carbon\Carbon::today()->add($ii, 'day');
                $exhibitions_of_the_day = $exhibitions->where('began_at', '>=', $day->format('Y-m-d'));
                @endphp
                <h4 class="bg-gray-300 p-3 text-2xl font-bold">
                    @ucfirst(__('date.' . lcfirst($day->format('l')))) {{ $day->format('d') }}
                </h4>
                <div class="bg-gray-200 grid grid-cols-1 md:grid-cols-3 md:gap-4">
                    @foreach ($exhibitions_of_the_day as $exhibition_of_the_day)
                    <div class="p-2">
                        <a href="{{ route('front.exhibition.show', ['museum' => $exhibition_of_the_day->inMuseum->slug, 'exhibition' => $exhibition_of_the_day->slug]) }}"
                            title="{{ $exhibition_of_the_day->title }}" aria-label="{{ $exhibition_of_the_day->title }}">
                            <em>{{ $exhibition_of_the_day->inMuseum->name }}</em><br />
                            {{ $exhibition_of_the_day->title }}
                        </a>
                    </div>
                    @endforeach
                </ul>
                @endfor
            </div>
        </div>
    </div>
</div>
