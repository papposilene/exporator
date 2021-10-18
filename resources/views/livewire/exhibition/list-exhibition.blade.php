@section('title', @ucfirst(__('app.list_of', ['name' => __('app.exhibitions')])))

<div>
    <x-slot name="header">
        @auth
        @if (Auth::user()->can('create', App\Models\Exhibition::class))
        <livewire:modals.import-exhibition />
        @endif
        @endauth
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <span>@ucfirst(__('app.list_of', ['name' => __('app.exhibitions')]))</span>
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
                    <a href="?filter=" class="text-base rounded-r-none hover:scale-110 focus:outline-none flex justify-center px-4 py-2 rounded font-bold cursor-pointer
                        hover:bg-gray-300 hover:text-black bg-gray-200 border duration-200 ease-in-out border-gray-300 transition">
                        <div class="flex leading-5">@ucfirst(__('app.exhibitions_all'))</div>
                    </a>
                    <a href="?filter=past" class="text-base rounded-r-none hover:scale-110 focus:outline-none flex justify-center px-4 py-2 rounded font-bold cursor-pointer
                        hover:bg-red-200 hover:text-black bg-red-100 border duration-200 ease-in-out border-gray-300 transition">
                        <div class="flex leading-5">@ucfirst(__('app.exhibitions_past'))</div>
                    </a>
                    <a href="?filter=current" class="text-base rounded-l-none rounded-r-none border-l-0 border-r-0 hover:scale-110 focus:outline-none flex justify-center px-4 py-2 rounded font-bold cursor-pointer
                        hover:bg-green-200 hover:text-black bg-green-100 border duration-200 ease-in-out border-gray-300 transition">
                        <div class="flex leading-5">@ucfirst(__('app.exhibitions_current'))</div>
                    </a>
                    <a href="?filter=future" class="text-base rounded-l-none hover:scale-110 focus:outline-none flex justify-center px-4 py-2 rounded font-bold cursor-pointer
                        hover:bg-blue-200 hover:text-black bg-blue-100 border duration-200 ease-in-out border-gray-300 transition">
                        <div class="flex leading-5">@ucfirst(__('app.exhibitions_future'))</div>
                    </a>
                </div>
                <x-forms.input wire:model="search" type="search" class="ml-2" :placeholder="@ucfirst(__('app.search'))" />
            </div>
            {{ $exhibitions->links() }}
            <div class="py-5">
                <table class="w-full p-5 table-fixed">
                    <thead>
                        <tr class="bg-gray-700 text-white">
                            <th class="w-1/12 text-center p-3">@ucfirst(__('app.iteration'))</th>
                            <th class="w-3/12 text-center">@ucfirst(__('app.museums'))</th>
                            <th class="w-4/12 text-center">@ucfirst(__('app.titles'))</th>
                            <th class="w-2/12 text-center">@ucfirst(__('app.began_at'))</th>
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
                            <td>
                                <a href="{{ route('front.museum.show', ['slug' => $exhibition->inMuseum->slug]) }}"
                                    title="{{ $exhibition->inMuseum->name }}" aria-label="{{ $exhibition->inMuseum->name }}">
                                    {{ $exhibition->inMuseum->name }}
                                </a>
                            </td>
                            <td>
                                <a href="{{ route('front.exhibition.show', ['museum' => $exhibition->inMuseum->slug, 'exhibition' => $exhibition->slug]) }}"
                                    title="{{ $exhibition->title }}" aria-label="{{ $exhibition->title }}">
                                    {{ $exhibition->title }}
                                </a>
                            </td>
                            <td class="text-center">@date($exhibition->began_at)</td>
                            <td class="text-center">@date($exhibition->ended_at)</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{ $exhibitions->links() }}
        </div>
    </div>
</div>
