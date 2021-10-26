@section('title', @ucfirst(__('app.list_of', ['name' => __('app.places')])))

<div>
    <x-slot name="header">
        @auth
        @if (Auth::user()->can('create', App\Models\Place::class))
        <livewire:modals.import-place />
        <livewire:modals.create-place />
        @endif
        @endauth
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <span>@ucfirst(__('app.list_of', ['name' => __('app.places')]))</span>
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
                <div class="flex flex-wrap">
                    <a href="?type=" class="flex flex-auto text-base md:rounded-r-none hover:scale-110 focus:outline-none
                        justify-center px-4 py-2 hover:rounded font-bold cursor-pointer
                        hover:bg-gray-300 hover:text-black bg-gray-200 border duration-200 ease-in-out border-gray-400 transition">
                        <div class="flex leading-5">@ucfirst(__('app.all'))</div>
                    </a>
                    @foreach ($types as $type)
                    <a href="?type={{ $type->slug }}" class="flex flex-auto text-base md:rounded-r-none md:rounded-l-none md:border-l-0 md:border-r-0
                        hover:scale-110 focus:outline-none justify-center px-4 py-2 hover:rounded font-bold cursor-pointer
                        hover:bg-gray-200 hover:text-black bg-gray-300 border duration-200 ease-in-out border-gray-400 transition">
                        <div class="flex leading-5">@ucfirst(__('app.' . Str::slug($type->type, '_')))</div>
                    </a>
                    @endforeach
                    @auth
                    <a href="?filter=followed" class="flex flex-auto text-base md:rounded-r-none md:rounded-l-none md:border-l-0 md:border-r-0
                        hover:scale-110 focus:outline-none justify-center px-4 py-2 hover:rounded font-bold cursor-pointer
                        hover:bg-yellow-500 hover:text-black bg-yellow-400 border duration-200 ease-in-out border-yellow-600 transition">
                        <div class="flex leading-5">@ucfirst(__('app.followed')))</div>
                    </a>
                    @if (Auth::user()->can('create', App\Models\Exhibition::class))
                    <a href="?filter=no_exhibition" class="flex flex-auto text-base md:rounded-r-none md:rounded-l-none md:border-l-0 md:border-r-0
                        hover:scale-110 focus:outline-none justify-center px-4 py-2 hover:rounded font-bold cursor-pointer
                        hover:bg-red-300 hover:text-black bg-red-200 border duration-200 ease-in-out border-red-400 transition">
                        <div class="flex leading-5">@ucfirst(__('app.no_exhibition')))</div>
                    </a>
                    @endif
                    @endauth
                </div>
                <x-forms.input wire:model="search" type="search" class="ml-2" :placeholder="@ucfirst(__('app.search'))" />
            </div>
            {{ $places->links() }}
            <div class="py-5">
                <table class="w-full p-5 table-fixed shadow">
                    <thead>
                        <tr class="bg-gray-700 text-white">
                            <th class="w-1/12 text-center p-3">@ucfirst(__('app.iteration'))</th>
                            <th class="w-2/12 text-center hidden lg:table-cell">@ucfirst(__('app.types'))</th>
                            <th class="w-2/12 text-center hidden lg:table-cell">@ucfirst(__('app.cities'))</th>
                            <th class="w-4/12 text-center">@ucfirst(__('app.places'))</th>
                            <th class="w-2/12 text-center hidden lg:table-cell">@ucfirst(__('app.status'))</th>
                            <th class="w-1/12 text-center">@ucfirst(__('app.exhibitions'))</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($places as $place)
                        <tr class="bg-gray-200 border-b border-gray-300 border-dashed h-12 w-12 p-4">
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td class="hidden lg:table-cell">@ucfirst(__('app.' . Str::slug($place->hasType->type, '_')))</td>
                            <td class="hidden lg:table-cell">{{ $place->city }}</td>
                            <td class="break-words">
                                <a href="{{ route('front.place.show', ['slug' => $place->slug]) }}"
                                    title="{{ $place->name }}" aria-label="{{ $place->name }}">
                                    {{ $place->name }}
                                </a>
                            </td>
                            <td class="text-center hidden lg:table-cell">
                                @if ($place->status === 1)
                                <span class="text-green-900">@ucfirst(__('app.place_open'))</span>
                                @else
                                <span class="text-red-900">@ucfirst(__('app.place_close'))</span>
                                @endif
                            </td>
                            <td class="text-center">{{ $place->hasExhibitions()->count() }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{ $places->links() }}
        </div>
    </div>
</div>
