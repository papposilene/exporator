@section('title', $place->name)

<div>
    <x-slot name="header">
        @auth
        @if (Auth::user()->can('update places'))
        <livewire:modals.edit-place :place="$place" :wire:key="$place->uuid" />
        @endif
        @if (Auth::user()->can('create exhibitions'))
        <livewire:modals.create-exhibition :place="$place" :wire:key="$place->uuid" />
        @else
        <livewire:modals.propose-exhibition :place="$place" :wire:key="$place->uuid" />
        @endif
        @endauth
        <h2 class="font-semibold text-xl text-bluegray-800 dark:text-bluegray-100 leading-tight">
            <span>
                <a href="{{ route('front.place.index') }}">
                    @ucfirst(__('app.list_of', ['what' => __('app.places')]))
                </a>
            </span> /
            <span>{{ $place->name }}</span>
        </h2>
    </x-slot>

    <div class="flex flex-wrap w-full max-w-7xl mx-auto">
        <div class="mx-auto lg:w-1/4 py-5 px-6 lg:px-0 lg:pr-6">
            @if ($place->image)
            <ul class="bg-rose-100 list-inside md:m-5 mt-5 md:mt-0 p-5 rounded shadow w-full">
                <li>
                    <img src="{{ storage_path($place->image) }}" class="" alt="{{ $place->name }}" title="{{ $place->name }}" />
                </li>
            </ul>
            @endif
            <ul class="bg-rose-100 list-inside md:m-5 mt-5 md:mt-0 p-5 rounded shadow w-full">
                <li class="flex flex-grow justify-between" title="@ucfirst(__('app.tag'))">
                    <h3 class="font-bold text-2xl mb-5">
                        {{ $place->name }}
                    </h3>
                    <span><livewire:interfaces.follow-place :place="$place" :wire:key="$place->uuid" /></span>
                </li>
                <li title="@ucfirst(__('app.type'))">@ucfirst(__('app.' . Str::slug($place->type, '_')))</li>
                <li title="@ucfirst(__('app.address'))">{{ $place->address }}</li>
                <li>
                    <span title="@ucfirst(__('app.city'))">{{ $place->city }}</span>,
                    <span title="@ucfirst(__('app.country'))">{{ $place->inCountry->name_common_fra }}</span>.
                </li>
                <li class="mt-5" title="@ucfirst(__('app.link'))">
                    <a href="{{ $place->link }}" class="text-sky-700 hover:text-red-600" target="_blank" rel="noopener">{{ $place->link }}</a>
                </li>
            </ul>
            @if ($place->status === 1)
            <ul class="bg-green-100 list-inside md:m-5 mt-5 md:mt-0 p-5 rounded shadow w-full">
            @else
            <ul class="bg-red-100 list-inside md:m-5 mt-5 md:mt-0 p-5 rounded shadow w-full">
            @endif
                <li title="@ucfirst(__('app.is_open'))">
                    @if ($place->status === 1)
                    <span class="text-green-900">@ucfirst(__('app.place_open')).</span>
                    @else
                    <span class="text-red-900">@ucfirst(__('app.place_closed')).</span>
                    @endif
                </li>
            </ul>
            <ul class="list-inside md:m-5 mt-5 md:mt-0 shadow w-full">
                <li><livewire:interfaces.map :place="$place" :wire:key="$place->uuid" /></li>
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

            @if($exhibitions->count() > 0)
            <div class="flex flex-wrap justify-end">
                <x-forms.input wire:model="search" type="search" class="relative float-right h-9 ml-2 mb-3" :placeholder="@ucfirst(__('app.search'))" />
                {{ $exhibitions->links() }}
            </div>
            <div class="py-5">
                <table class="w-full p-5 table-fixed rounded shadow">
                    <thead>
                        <tr class="bg-bluegray-700 dark:bg-gray-900 text-white">
                            <th class="w-1/12 text-center p-3">@ucfirst(__('app.iteration'))</th>
                            <th class="w-7/12 text-center">@ucfirst(__('app.titles'))</th>
                            <th class="hidden md:table-cell md:w-2/12 text-center">@ucfirst(__('app.began_at'))</th>
                            <th class="w-2/12 text-center">@ucfirst(__('app.ended_at'))</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($exhibitions as $exhibition)
                        @php
                        // If not published
                        $is_not_published = '';
                        if ($exhibition->is_published === false) {
                            $is_not_published = 'font-bold text-red-500';
                        }

                        $today = date('Y-m-d');
                        if ($today > $exhibition->began_at && $today < $exhibition->ended_at) {
                            // Current exhibition
                            $is_current = 'bg-green-100';
                        }
                        elseif ($today > $exhibition->ended_at) {
                            // Past exhibition
                            $is_current = 'bg-red-100';
                        }
                        elseif ($today < $exhibition->began_at) {
                            // Future exhibition
                            $is_current = 'bg-sky-100';
                        }
                        else {
                            $is_current = 'bg-bluegray-200';
                        }
                        @endphp
                        <tr class="border-b border-bluegray-300 border-dashed h-12 w-12 p-4 {{ $is_not_published }} {{ $is_current }}">
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td class="break-words">
                                <a href="{{ route('front.exhibition.show', ['place' => $exhibition->inPlace->slug, 'slug' => $exhibition->slug]) }}"
                                    title="{{ $exhibition->title }}" aria-label="{{ $exhibition->title }}">
                                    {{ $exhibition->title }}
                                </a>
                            </td>
                            <td class="hidden md:table-cell text-center break-words">@date($exhibition->began_at)</td>
                            <td class="text-center break-words">@date($exhibition->ended_at)</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{ $exhibitions->links() }}
            @else
            <div class="flex justify-center bg-bluegray-500 text-white p-5 rounded shadow w-full">
                <p class="text-center py-10">
                    @ucfirst(__('app.nothing'))
                </p>
            </div>
            @endif
        </div>
    </div>
</div>
