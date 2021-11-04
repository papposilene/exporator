@section('title', @ucfirst($tag->name))

<div>
    <x-slot name="header">
        @auth
        @if (Auth::user()->can('delete', App\Models\User::class, App\Models\Tag::class))
        <livewire:interfaces.delete-tag :tag="$tag" :wire:key="$tag->id" />
        @endif
        @if (Auth::user()->can('update', App\Models\User::class, App\Models\Tag::class))
        <livewire:modals.edit-tag :tag="$tag" :wire:key="$tag->id" />
        @endif
        @endauth
        <h2 class="font-semibold text-xl text-bluegray-800 leading-tight">
            <span>
                <a href="{{ route('front.tag.index') }}">
                    @ucfirst(__('app.list_of', ['name' => __('app.tags')]))
                </a>
            </span> /
            <span>@ucfirst($tag->name)</span>
        </h2>
    </x-slot>

    <div class="flex flex-wrap w-full max-w-7xl mx-auto">
        <div class="mx-auto md:w-1/4 py-5 px-6 w-full">
            <ul class="bg-indigo-300 list-inside md:m-5 mt-5 md:mt-0 p-5 shadow w-full">
                <li title="@ucfirst(__('app.tag'))">
                    <h3 class="font-bold text-2xl mb-5">
                        @ucfirst($tag->name)
                    </h3>
                </li>
                <li title="@ucfirst(__('app.type'))">@ucfirst($tag->type)</li>
            </ul>
            <ul class="bg-bluegray-200 list-inside md:m-5 mt-5 md:mt-0 p-5 shadow w-full">
                <li><livewire:interfaces.follow-tag :tag="$tag" :wire:key="$tag->id" /></li>
            </ul>
            @if ($otherTags->count()  > 0)
            <ul class="bg-indigo-200 list-inside md:m-5 mt-5 md:mt-0 p-5 shadow w-full">
                @foreach ($otherTags as $otherTag)
                <li>
                    <a href="{{ route('front.tag.show', ['slug' => $otherTag->slug]) }}"
                        title="{{ $otherTag->name }}" aria-label="{{ $otherTag->name }}">
                        @ucfirst($otherTag->name)
                    </a>
                </li>
                @endforeach
                <li>
                    <a href="{{ route('front.tag.index') }}">
                        @ucfirst(__('app.explore_other', ['name' => __('app.tags')]))
                    </a>
                </li>
            </ul>
            @endif
        </div>

        <div class="mx-auto md:w-3/4 py-5 px-6">
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
            <div>
                <x-forms.input wire:model="search" type="search" class="relative float-right h-9 ml-2 mb-3" :placeholder="@ucfirst(__('app.search'))" />
                {{ $exhibitions->links() }}
            </div>
            <div class="py-5">
                <table class="w-full p-5 table-fixed shadow">
                    <thead>
                        <tr class="bg-bluegray-700 text-white">
                            <th class="w-1/12 text-center p-3">@ucfirst(__('app.iteration'))</th>
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
