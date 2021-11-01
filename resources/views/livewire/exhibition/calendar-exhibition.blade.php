@section('title', @ucfirst(__('app.calendar_of', ['name' => __('app.exhibitions')])))

<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <span id="top">@ucfirst(__('app.calendar_of', ['name' => __('app.exhibitions')]))</span>
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

            <div class="flex flex-wrap bg-gray-500 mb-2 w-full">
                @for ($ii = 0; $ii < ($remaining_days + 1); $ii++)
                @php
                $day = \Carbon\Carbon::today()->add($ii, 'day');
                @endphp
                <a href="#day-{{ $ii }}" class="flex-initial text-white hover:bg-gray-100 hover:text-black p-3">
                    @ucfirst(__('date.' . lcfirst($day->format('l')))) {{ $day->format('d') }}
                </a>
                @endfor
            </div>
            <h3 class="bg-gray-500 p-3 text-2xl font-bold cursor-pointer">
                @ucfirst(__('date.' . lcfirst($current_month))) {{ $year }}
            </h3>
            <div class="h-screen overflow-auto" x-data="{selected:null}">
                @for ($ii = 0; $ii < ($remaining_days + 1); $ii++)
                @php
                $day = \Carbon\Carbon::today()->add($ii, 'day');
                $exhibitions_of_the_day = $exhibitions->where('began_at', '>=', $day->format('Y-m-d'));
                @endphp
                <h4 id="day-{{ $ii }}" @click="selected !== {{ $ii }} ? selected = {{ $ii }} : selected = null"
                    class="bg-gray-400 border-b-2 border-t-2 border-black p-3 text-2xl font-bold cursor-pointer">
                    @ucfirst(__('date.' . lcfirst($day->format('l')))) {{ $day->format('d') }}
                    <a href="#top" class="relative float-right hover:text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 11l7-7 7 7M5 19l7-7 7 7" />
                        </svg>
                    </a>
                </h4>
                <div class="bg-gray-200 grid grid-cols-1 md:grid-cols-3 md:gap-4" x-show="selected == {{ $ii }}">
                    @foreach ($exhibitions_of_the_day as $exhibition_of_the_day)
                    <a href="{{ route('front.exhibition.show', ['place' => $exhibition_of_the_day->inPlace->slug, 'exhibition' => $exhibition_of_the_day->slug]) }}"
                            title="{{ $exhibition_of_the_day->title }}" aria-label="{{ $exhibition_of_the_day->title }}"
                            class="flex flex-col bg-gray-300 p-2 hover:bg-green-200">
                        <div class="italic">{{ $exhibition_of_the_day->g->name }}</div>
                        <div class="flex-grow font-semibold text-lg text-center">{{ $exhibition_of_the_day->title }}</div>
                        <div class="text-right text-sm italic">@ucfirst(__('app.until', ['date' => $exhibition_of_the_day->ended_at->format('d/m/Y')]))</div>
                    </a>
                    @endforeach
                </div>
                @endfor
            </div>
        </div>
    </div>
</div>
