@section('title', @ucfirst(__('app.list_of', ['what' => __('app.places')])))

<div>
    <x-slot name="header">
        @auth
        @if (Auth::user()->can('export places'))
        <livewire:interfaces.export-place />
        @endif
        @if (Auth::user()->can('import places'))
        <livewire:modals.import-place />
        @endif
        @if (Auth::user()->can('create places'))
        <livewire:modals.create-place />
        @endif
        @endauth
        <h2 class="font-semibold text-xl text-bluegray-800 dark:text-bluegray-100 leading-tight">
            <span>@ucfirst(__('app.list_of', ['what' => __('app.places')]))</span>
        </h2>
    </x-slot>

    <div>
        <div class="max-w-7xl mx-auto py-5 px-6">
            @if ($errors->any())
            <div class="bg-red-500 border border-red-700 mb-3 p-3 rounded shadow text-white font-bold">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <!-- Navigation and search -->
            <div class="relative flex items-center justify-between mb-2 w-full">
                <div class="flex flex-wrap">
                    <a href="{{ route('front.place.index', ['type' => '']) }}" class="flex flex-auto text-base hover:scale-110 focus:outline-none
                        justify-center px-4 py-2 rounded font-bold cursor-pointer hover:text-black
                        hover:bg-bluegray-300 bg-bluegray-200 hover:border-bluegray-400
                        border duration-200 ease-in-out transition lg:rounded-r-none">
                        <div class="flex leading-5">@ucfirst(__('app.all'))</div>
                    </a>
                    @foreach($types as $type)
                    <a href="{{ route('front.place.index', ['type' => $type->slug]) }}" class="flex flex-auto text-base hover:scale-110 focus:outline-none
                        justify-center px-4 py-2 rounded font-bold cursor-pointer hover:text-black
                        hover:bg-bluegray-300 bg-bluegray-200 hover:border-bluegray-400
                        border duration-200 ease-in-out transition lg:rounded-none">
                        <div class="flex leading-5">@ucfirst(__('app.' . Str::slug($type->type, '_')))</div>
                    </a>
                    @endforeach
                    <a href="{{ route('front.place.index', ['filter' => 'followed']) }}" class="flex flex-auto text-base hover:scale-110 focus:outline-none
                        justify-center mr-2 px-4 py-2 rounded font-bold cursor-pointer hover:text-black
                        hover:bg-bluegray-300 bg-bluegray-200 hover:border-bluegray-400
                        border duration-200 ease-in-out transition lg:rounded-l-none">
                        <div class="flex leading-5">
                            <svg xmlns="http://www.w3.org/2000/svg" class="fill-current text-yellow-500 h-6 w-6" fill="yes" viewBox="0 0 24 24" stroke="currentColor" title="@ucfirst(__('app.followed'))">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                            </svg>
                        </div>
                    </a>
                </div>
                <x-forms.input wire:model="search" type="search" class="ml-2" :placeholder="@ucfirst(__('app.search'))" />
            </div>
            <!-- End of navigation and search -->

            <!-- Pagination -->
            {{ $places->links() }}
            <!-- End of pagination -->

            <!-- Places -->
            <div class="py-5">
                <table class="w-full p-5 table-fixed rounded shadow">
                    <thead>
                        <tr class="bg-bluegray-700 dark:bg-gray-900 text-white">
                            <th class="w-1/12 text-center p-3 hidden lg:table-cell">@ucfirst(__('app.iteration'))</th>
                            <th class="w-1/12 text-center p-3 hidden lg:table-cell">@ucfirst(__('app.followed'))</th>
                            <th class="w-2/12 text-center hidden lg:table-cell">@ucfirst(__('app.types'))</th>
                            <th class="w-2/12 text-center hidden lg:table-cell">@ucfirst(__('app.cities'))</th>
                            <th class="w-3/12 text-center">@ucfirst(__('app.places'))</th>
                            <th class="w-2/12 text-center hidden lg:table-cell">@ucfirst(__('app.status'))</th>
                            <th class="w-1/12 text-center">@ucfirst(__('app.exhibitions'))</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($places as $place)
                        <tr class="bg-bluegray-200 border-b border-bluegray-300 border-dashed h-12 w-12 p-4" itemscope itemtype="https://schema.org/TouristAttraction">
                            <td class="text-center hidden lg:table-cell">{{ $loop->iteration }}</td>
                            <td class="hidden lg:table-cell">
                                <livewire:interfaces.follow-place :place="$place" :wire:key="$place->uuid" />
                            </td>
                            <td class="hidden lg:table-cell">@ucfirst(__('app.' . Str::slug($place->hasType->type, '_')))</td>
                            <td class="hidden lg:table-cell">{{ $place->city }}</td>
                            <td class="break-words">
                                <a href="{{ route('front.place.show', ['slug' => $place->slug]) }}"
                                    title="{{ $place->name }}" aria-label="{{ $place->name }}">
                                    <span itemprop="name">{{ $place->name }}</span>
                                </a>
                            </td>
                            <td class="text-center hidden lg:table-cell">
                                @if ($place->status === 1)
                                <span class="text-green-900">@ucfirst(__('app.place_open'))</span>
                                @else
                                <span class="text-red-900">@ucfirst(__('app.place_closed'))</span>
                                @endif
                            </td>
                            <td class="text-center">{{ $place->hasExhibitions()->count() }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- End of places -->

            <!-- Pagination -->
            {{ $places->links() }}
            <!-- End of pagination -->
        </div>
    </div>
</div>
