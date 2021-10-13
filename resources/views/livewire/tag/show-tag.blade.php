@section('title', @ucfirst($tag->name))

<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <span>
                @auth
                <a href="{{ route('admin.tag.index') }}">
                @else
                <a href="{{ route('front.tag.index') }}">
                @endauth
                    @ucfirst(__('app.list_of', ['name' => __('app.tags')]))
                </a>
            </span> /
            <span>@ucfirst($tag->name)</span>
        </h2>
    </x-slot>

    <div>
        <div class="max-w-7xl md:w-3/12 mx-auto py-5 px-6 md:float-left">
            <ul class="bg-indigo-100 list-inside md:m-5 p-5 w-full">
                <li title="@ucfirst(__('app.tag'))">
                    <h3 class="font-bold text-2xl mb-5">
                        @ucfirst($tag->name)
                    </h3>
                </li>
                <li title="@ucfirst(__('app.type'))">@ucfirst($tag->type)</li>
            </ul>
            @auth
            @if (Auth::user()->can('create', App\Models\Tag::class))
            <ul class="bg-gray-200 list-inside md:m-5 p-5 w-full">
                <li><livewire:modals.edit-tag :tag="$tag" :wire:key="$tag->id" /></li>
            </ul>
            @endif
            @endauth
        </div>

        <div class="max-w-7xl md:w-9/12 mx-auto py-5 px-6 md:float-right">
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
            <div>
                <x-forms.input wire:model="search" type="search" class="relative float-right h-9 ml-2 mb-3" :placeholder="@ucfirst(__('app.search'))" />
                {{ $exhibitions->links() }}
            </div>
            <div class="py-5">
                <table class="w-full p-5 table-fixed">
                    <thead>
                        <tr class="bg-gray-700 text-white">
                            <th class="w-1/12 text-center p-3">@ucfirst(__('app.iteration'))</th>
                            <th class="w-3/12 text-center">@ucfirst(__('app.museums'))</th>
                            <th class="w-4/12 text-center">@ucfirst(__('app.titles'))</th>
                            <th class="w-2/12 text-center">@ucfirst(__('app.began_at'))</th>
                            <th class="hidden md:table-cell md:w-2/12 text-center">@ucfirst(__('app.ended_at'))</th>
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
                            <td class="hidden md:table-cell text-center">@date($exhibition->ended_at)</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{ $exhibitions->links() }}
            @else
            <div class="max-w-7xl mx-auto py-5 sm:px-6 lg:px-8">
                <p class="text-center py-10">
                    @ucfirst(__('app.nothing'))
                </p>
            </div>
            @endif
        </div>
    </div>
</div>
