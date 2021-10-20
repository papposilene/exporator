@section('title', $museum->name)

<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <span>
                <a href="{{ route('front.museum.index') }}">
                    @ucfirst(__('app.list_of', ['name' => __('app.museums')]))
                </a>
            </span> /
            <span>{{ $museum->name }}</span>
        </h2>
    </x-slot>

    <div class="flex flex-wrap w-full max-w-7xl mx-auto">
        <div class="mx-auto md:w-1/4 py-5 px-6">
            <ul class="bg-purple-100 list-inside md:m-5 mt-5 md:mt-0 p-5 shadow w-full">
                <li title="@ucfirst(__('app.museum'))">
                    <h3 class="font-bold text-2xl mb-5">
                        {{ $museum->name }}
                    </h3>
                </li>
                <li title="@ucfirst(__('app.type'))">@ucfirst(__('app.' . Str::slug($museum->type, '_')))</li>
                <li title="@ucfirst(__('app.address'))">{{ $museum->address }}</li>
                <li>
                    <span title="@ucfirst(__('app.city'))">{{ $museum->city }}</span>,
                    <span title="@ucfirst(__('app.country'))">{{ $museum->inCountry->name_common_fra }}</span>.
                </li>
                <li class="mt-5" title="@ucfirst(__('app.link'))">
                    <a href="{{ $museum->link }}" class="text-blue-700 hover:text-red-600" target="_blank" rel="noopener">{{ $museum->link }}</a>
                </li>
            </ul>
            @if ($museum->status === 1)
            <ul class="bg-green-100 list-inside md:m-5 mt-5 md:mt-0 p-5 shadow w-full">
            @else
            <ul class="bg-red-100 list-inside md:m-5 mt-5 md:mt-0 p-5 shadow w-full">
            @endif
                <li title="@ucfirst(__('app.is_open'))">
                    @if ($museum->status === 1)
                    <span class="text-green-900">@ucfirst(__('app.museum_open')).</span>
                    @else
                    <span class="text-red-900">@ucfirst(__('app.museum_close')).</span>
                    @endif
                </li>
            </ul>
            <ul class="list-inside md:m-5 mt-5 md:mt-0 shadow w-full">
                <li><livewire:interfaces.map :museum="$museum" :wire:key="$museum->uuid" /></li>
            </ul>
            @auth
            @if (Auth::user()->can('create', App\Models\Exhibition::class))
            <ul class="bg-gray-200 list-inside md:mt-5 md:mr-5 p-5 shadow w-full">
                <li><livewire:modals.edit-museum :museum="$museum" :wire:key="$museum->uuid" /></li>
                <li><livewire:modals.create-exhibition :museum="$museum" :wire:key="$museum->uuid" /></li>
            </ul>
            @endif
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
                            <td>
                                <a href="{{ route('front.exhibition.show', ['museum' => $exhibition->inMuseum->slug, 'exhibition' => $exhibition->slug]) }}"
                                    title="{{ $exhibition->title }}" aria-label="{{ $exhibition->title }}">
                                    {{ $exhibition->title }}
                                </a>
                            </td>
                            <td class="hidden md:table-cell text-center">@date($exhibition->began_at)</td>
                            <td class="text-center">@date($exhibition->ended_at)</td>
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
