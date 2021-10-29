@section('title', $place->name)

<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <span>
                <a href="{{ route('front.place.index') }}">
                    @ucfirst(__('app.list_of', ['name' => __('app.places')]))
                </a>
            </span> /
            <span>{{ $place->name }}</span>
        </h2>
    </x-slot>

    <div class="flex flex-wrap w-full max-w-7xl mx-auto">
        <div class="mx-auto md:w-1/4 py-5 px-6 w-full">
            @if ($place->image)
            <ul class="bg-purple-100 list-inside md:m-5 mt-5 md:mt-0 p-5 shadow w-full">
                <li>
                    <img src="{{ storage_path($place->image) }}" class="" alt="{{ $place->name }}" title="{{ $place->name }}" />
                </li>
            </ul>
            @endif
            <ul class="bg-purple-100 list-inside md:m-5 mt-5 md:mt-0 p-5 shadow w-full">
                <li title="@ucfirst(__('app.place'))">
                    <h3 class="font-bold text-2xl mb-5">
                        {{ $place->name }}
                    </h3>
                </li>
                <li title="@ucfirst(__('app.type'))">@ucfirst(__('app.' . Str::slug($place->type, '_')))</li>
                <li title="@ucfirst(__('app.address'))">{{ $place->address }}</li>
                <li>
                    <span title="@ucfirst(__('app.city'))">{{ $place->city }}</span>,
                    <span title="@ucfirst(__('app.country'))">{{ $place->inCountry->name_common_fra }}</span>.
                </li>
                <li class="mt-5" title="@ucfirst(__('app.link'))">
                    <a href="{{ $place->link }}" class="text-blue-700 hover:text-red-600" target="_blank" rel="noopener">{{ $place->link }}</a>
                </li>
            </ul>
            @auth
            <ul class="bg-yellow-400 list-inside md:m-5 mt-5 md:mt-0 p-5 shadow w-full">
                <li><livewire:interfaces.follow-place :place="$place" :wire:key="$place->uuid" /></li>
            </ul>
            @endauth
            @if ($place->status === 1)
            <ul class="bg-green-100 list-inside md:m-5 mt-5 md:mt-0 p-5 shadow w-full">
            @else
            <ul class="bg-red-100 list-inside md:m-5 mt-5 md:mt-0 p-5 shadow w-full">
            @endif
                <li title="@ucfirst(__('app.is_open'))">
                    @if ($place->status === 1)
                    <span class="text-green-900">@ucfirst(__('app.place_open')).</span>
                    @else
                    <span class="text-red-900">@ucfirst(__('app.place_close')).</span>
                    @endif
                </li>
            </ul>
            <ul class="list-inside md:m-5 mt-5 md:mt-0 shadow w-full">
                <li><livewire:interfaces.map :place="$place" :wire:key="$place->uuid" /></li>
            </ul>
            @auth
            <ul class="bg-gray-200 list-inside md:m-5 mt-5 md:mt-0 p-5 shadow w-full">
            @if (Auth::user()->can('create', App\Models\Exhibition::class))
                <li><livewire:modals.edit-place :place="$place" :wire:key="$place->uuid" /></li>
                <li><livewire:modals.create-exhibition :place="$place" :wire:key="$place->uuid" /></li>
            @else
                <li><livewire:modals.propose-exhibition :place="$place" :wire:key="$place->uuid" /></li>
            @endif
            </ul>
            @endauth
        </div>

        <div class="mx-auto md:w-3/4 py-5 px-6">
            @if ($errors->any())
            <div class="bg-red-400 border border-red-500 py-5 text-black rounded">
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
                <table class="w-full p-5 table-fixed shadow">
                    <thead>
                        <tr class="bg-gray-700 text-white">
                            <th class="w-1/12 text-center p-3">@ucfirst(__('app.iteration'))</th>
                            <th class="w-7/12 text-center">@ucfirst(__('app.titles'))</th>
                            <th class="hidden md:table-cell md:w-2/12 text-center">@ucfirst(__('app.began_at'))</th>
                            <th class="w-2/12 text-center">@ucfirst(__('app.ended_at'))</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($exhibitions as $exhibition)
                        @php
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
                            $is_current = 'bg-blue-100';
                        }
                        else {
                            $is_current = 'bg-gray-200';
                        }
                        @endphp
                        <tr class="border-b border-gray-300 border-dashed h-12 w-12 p-4 {{ $is_current }}">
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td class="break-words">
                                <a href="{{ route('front.exhibition.show', ['place' => $exhibition->inPlace->slug, 'exhibition' => $exhibition->slug]) }}"
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
            <div class="max-w-8xl mx-auto py-5 sm:px-6 lg:px-8">
                <p class="text-center py-10">
                    @ucfirst(__('app.nothing'))
                </p>
            </div>
            @endif
        </div>
    </div>
</div>
