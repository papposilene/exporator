@section('title', $exhibition->title)

<div>
    <x-slot name="header">
        @auth
        @if (Auth::user()->can('update exhibitions'))
        <livewire:modals.edit-exhibition :exhibition="$exhibition" :wire:key="$exhibition->uuid" />
        @endif
        @if (Auth::user()->can('create reviews'))
        <!-- livewire:modals.create-review :exhibition="$exhibition" :wire:key="$exhibition->uuid" / -->
        @endif
        @endauth
        <h2 class="font-semibold text-xl text-bluegray-800 dark:text-bluegray-100 leading-tight">
            <span>
                <a href="{{ route('front.place.show', ['slug' => $exhibition->inPlace->slug]) }}">
                    {{ $exhibition->inPlace->name }}
                </a>
            </span> /
            <span>{{ $exhibition->title }}</span>
        </h2>
    </x-slot>

    <div class="flex flex-wrap w-full max-w-7xl mx-auto">
        <div class="mx-auto lg:w-1/4 py-5 px-6 lg:px-0 lg:pr-6">
            <ul class="bg-indigo-100 list-inside lg:m-5 mt-5 lg:mt-0 p-5 rounded shadow w-full">
                <li class="flex flex-grow justify-between" title="@ucfirst(__('app.place'))">
                    <h3 class="font-bold text-2xl mb-5">
                        <a href="{{ route('front.place.show', ['slug' => $exhibition->inPlace->slug]) }}">
                            {{ $exhibition->inPlace->name }}
                        </a>
                    </h3>
                    <span><livewire:interfaces.follow-place :place="$exhibition->inPlace" :wire:key="$exhibition->inPlace->uuid" /></span>
                </li>
                <li title="@ucfirst(__('app.type'))">@ucfirst(__('app.' . Str::slug($exhibition->inPlace->type, '_')))</li>
                <li title="@ucfirst(__('app.address'))">{{ $exhibition->inPlace->address }}</li>
                <li>
                    <span title="@ucfirst(__('app.city'))">{{ $exhibition->inPlace->city }}</span>,
                    <span title="@ucfirst(__('app.country'))">{{ $exhibition->inPlace->inCountry->name_common_fra }}</span>.
                </li>
                <li class="mt-5" title="@ucfirst(__('app.link'))">
                    <a href="{{ $exhibition->inPlace->link }}" class="text-sky-700 hover:text-red-600" target="_blank" rel="noopener">{{ $exhibition->inPlace->link }}</a>
                </li>
            </ul>
            @if ($exhibition->inPlace->status === 1)
            <ul class="bg-green-100 list-inside lg:m-5 mt-5 lg:mt-0 p-5 rounded shadow w-full">
            @else
            <ul class="bg-red-100 list-inside lg:m-5 mt-5 lg:mt-0 p-5 rounded shadow w-full">
            @endif
                <li title="@ucfirst(__('app.is_open'))">
                    @if ($exhibition->inPlace->status === 1)
                    <span class="text-green-900">@ucfirst(__('app.place_open')).</span>
                    @else
                    <span class="text-red-900">@ucfirst(__('app.place_closed')).</span>
                    @endif
                </li>
            </ul>
            <ul class="list-inside lg:m-5 mt-5 lg:mt-0 rounded shadow w-full">
                <li><livewire:interfaces.map :place="$exhibition->inPlace" :wire:key="$exhibition->inPlace->uuid" /></li>
            </ul>
        </div>

        <div class="mx-auto lg:w-3/4 py-5 px-6">
            @if ($errors->any())
            <div class="bg-red-500 border border-red-700 mb-3 p-3 rounded shadow text-white font-bold">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            @if (!$exhibition->is_published)
            <!-- Not published exhibition -->
            <div class="bg-red-500 border border-red-700 mb-5 p-3 text-white font-bold rounded shadow">
                <ul>
                    <li>@ucfirst(__('app.published_info'))</li>
                    <li class="flex flex-row justify-around mt-2">
                        <livewire:interfaces.publish-exhibition :exhibition="$exhibition" :wire:key="$exhibition->uuid" />
                        <livewire:interfaces.delete-exhibition :exhibition="$exhibition" :wire:key="$exhibition->uuid" />
                    </li>
                </ul>
            </div>
            <!-- End of not published exhibition -->
            @endif

            @if ($exhibition->ended_at < date('Y-m-d'))
            <!-- Ended exhibition -->
            <div class="bg-red-400 border border-red-600 mb-5 p-3 text-white font-bold rounded shadow">
                <ul>
                    <li>@ucfirst(__('app.ended_info', ['date' => $exhibition->ended_at->format('d/m/Y')]))</li>
                </ul>
            </div>
            <!-- End of ended exhibition -->
            @endif

            <!-- Exhibition title -->
            <div class="flex flex-grow justify-between bg-bluegray-300 font-bold text-2xl p-3 rounded shadow w-full"
                title="@ucfirst(__('app.exhibition'))">
                <h4>
                    {{ $exhibition->title }}
                </h4>
                <span><livewire:interfaces.follow-exhibition :exhibition="$exhibition" :wire:key="$exhibition->uuid" /></span>
            </div>
            <!-- End of exhibition title -->

            <!-- Exhibition informations -->
            <div class="flex space-x-5 lg:bg-bluegray-200 lg:px-0 lg:p-5 justify-center my-5 rounded lg:shadow w-full">
                <span class="bg-yellow-100 border border-yellow-300 p-2 rounded shadow" title="@ucfirst(__('app.price'))">
                    @ucfirst(__('app.price')) :
                    @if ($exhibition->price)
                    @currency($exhibition->price)&nbsp;&euro;.
                    @else
                    {{ __('app.no_price') }}.
                    @endif
                </span>
                <span class="bg-green-100 border border-green-300 p-2 rounded shadow" title="@ucfirst(__('app.began_at'))">
                    @ucfirst(__('app.began_at')) : @date($exhibition->began_at).
                </span>
                <span class="bg-red-100 border border-red-300 p-2 rounded shadow" title="@ucfirst(__('app.ended_at'))">
                    @ucfirst(__('app.ended_at')) : @date($exhibition->ended_at).
                </span>
            </div>
            <!-- End of exhibition informations -->

            <!-- End of exhibition data -->
            <ul class="list-inside bg-bluegray-200 rounded shadow w-full">
                <li class="p-5">
                    @nl2br($exhibition->description)
                </li>
                <li class="p-5" title="@ucfirst(__('app.link'))">
                    @if ($exhibition->link)
                    <a href="{{ $exhibition->link }}" class="text-sky-700 hover:text-red-600" target="_blank" rel="noopener">{{ $exhibition->link }}</a>
                    @else
                    <a href="{{ $exhibition->inPlace->link }}" class="text-sky-700 hover:text-red-600" target="_blank" rel="noopener">{{ $exhibition->inPlace->link }}</a>
                    @endif
                </li>
            </ul>
            <!-- End of exhibition data -->

            <!-- User actions -->
            <div class="flex space-x-5 bg-bluegray-200 justify-center my-5 rounded shadow w-full">
                <livewire:interfaces.visit-exhibition :exhibition="$exhibition" :wire:key="$exhibition->uuid" />
            </div>
            <!-- End of user actions -->

            <!-- Tags -->
            <div class="bg-indigo-300 mt-5 px-5 p-5 rounded shadow w-full">
                @if (count($exhibition->tags) > 0)
                @foreach ($exhibition->tags as $tag)
                <a href="{{ route('front.tag.show', ['slug' => $tag->slug]) }}"
                    class="bg-indigo-500 text-white mr-2 p-2 inline-block rounded shadow" title="{{ $tag->type }}">
                    {{ $tag->name }}
                </a>
                @endforeach
                @else
                <div title="@ucfirst(__('app.no_tags'))">@ucfirst(__('app.no_tags'))</div>
                @endif
                @auth
                @if (Auth::user()->can('update exhibitions'))
                <livewire:interfaces.tag-exhibition :exhibition="$exhibition" :wire:key="$exhibition->uuid" />
                @endif
                @endauth
            </div>
            <!-- End of tags -->
        </div>

        <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "Event",
            "name": "{{ $exhibition->name }}",
            "startDate": "@datedit($exhibition->began_at)",
            "endDate": "@datedit($exhibition->ended_at)",
            "eventStatus": "https://schema.org/EventScheduled",
            "location": {
                "@type": "Place",
                "name": "{{ $exhibition->inPlace->name }}",
                "address": {
                    "@type": "PostalAddress",
                    "streetAddress": "{{ $exhibition->inPlace->address }}",
                    "addressLocality": "{{ $exhibition->inPlace->city }}",
                    "addressCountry": "{{ $exhibition->inPlace->inCountry->cca2 }}"
                }
            },
            "description": "{{ $exhibition->description }}",
            "offers": {
                "@type": "Offer",
                "url": "{{ $exhibition->link }}",
                "price": "@currency($exhibition->price)",
                "priceCurrency": "EUR"
            },
            "organizer": {
                "@type": "Organization",
                "name": "{{ $exhibition->inPlace->name }}",
                "url": "{{ $exhibition->inPlace->link }}"
            }
        }
        </script>
    </div>
</div>
