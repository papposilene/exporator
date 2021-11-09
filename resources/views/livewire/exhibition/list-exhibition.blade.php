@section('title', @ucfirst(__('app.list_of', ['what' => __('app.exhibitions')])))

<div>
    <x-slot name="header">
        @auth
        @if (Auth::user()->can('create', App\Models\Exhibition::class))
        <livewire:modals.import-exhibition />
        @endif
        @endauth
        <h2 class="font-semibold text-xl text-bluegray-800 dark:text-bluegray-100 leading-tight">
            <span>@ucfirst(__('app.list_of', ['what' => __('app.exhibitions')]))</span>
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
                    <a href="?filter=" class="flex flex-auto text-base md:rounded-r-none hover:scale-110 focus:outline-none
                        justify-center px-4 py-2 hover:rounded font-bold cursor-pointer
                        hover:bg-bluegray-300 hover:text-black bg-bluegray-200 border duration-200 ease-in-out hover:border-bluegray-300 transition">
                        <div class="flex leading-5">@ucfirst(__('app.all'))</div>
                    </a>
                    <a href="?filter=past" class="flex flex-auto text-base md:rounded-r-none md:rounded-l-none md:border-l-0 md:border-r-0
                        hover:scale-110 focus:outline-none justify-center px-4 py-2 hover:rounded font-bold cursor-pointer
                        hover:bg-red-200 hover:text-black bg-red-100 border duration-200 ease-in-out hover:border-bluegray-300 transition">
                        <div class="flex leading-5">@ucfirst(__('app.exhibitions_past'))</div>
                    </a>
                    <a href="?filter=current" class="flex flex-auto text-base md:rounded-r-none md:rounded-l-none md:border-l-0 md:border-r-0
                        hover:scale-110 focus:outline-none justify-center px-4 py-2 hover:rounded font-bold cursor-pointer
                        hover:bg-green-200 hover:text-black bg-green-100 border duration-200 ease-in-out hover:border-bluegray-300 transition">
                        <div class="flex leading-5">@ucfirst(__('app.exhibitions_current'))</div>
                    </a>
                    <a href="?filter=future" class="flex flex-auto text-base md:rounded-l-none hover:scale-110 focus:outline-none
                        justify-center px-4 py-2 hover:rounded font-bold cursor-pointer
                        hover:bg-sky-200 hover:text-black bg-sky-100 border duration-200 ease-in-out hover:border-bluegray-300 transition">
                        <div class="flex leading-5">@ucfirst(__('app.exhibitions_future'))</div>
                    </a>
                </div>
                <x-forms.input wire:model="search" type="search" class="ml-2" :placeholder="@ucfirst(__('app.search'))" />
            </div>
            {{ $exhibitions->links() }}
            <div class="py-5">
                <table class="w-full p-5 table-fixed shadow">
                    <thead>
                        <tr class="bg-bluegray-700 dark:bg-gray-900 text-white">
                            <th class="w-1/12 text-center p-3">@ucfirst(__('app.iteration'))</th>
                            <th class="w-1/12 text-center hidden lg:table-cell">@ucfirst(__('app.followed'))</th>
                            <th class="w-3/12 text-center">@ucfirst(__('app.places'))</th>
                            <th class="w-4/12 text-center">@ucfirst(__('app.titles'))</th>
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
                            <td class="hidden lg:table-cell">
                                <livewire:interfaces.follow-exhibition :exhibition="$exhibition" :wire:key="$exhibition->uuid" />
                            </td>
                            <td class="break-words">
                                <a href="{{ route('front.place.show', ['slug' => $exhibition->inPlace->slug]) }}"
                                    title="{{ $exhibition->inPlace->name }}" aria-label="{{ $exhibition->inPlace->name }}">
                                    {{ $exhibition->inPlace->name }}
                                </a>
                            </td>
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
        </div>
    </div>
</div>
