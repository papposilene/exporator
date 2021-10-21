@section('title', $exhibition->title)

<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <span>
                <a href="{{ route('front.museum.show', ['slug' => $exhibition->inMuseum->slug]) }}">
                    {{ $exhibition->inMuseum->name }}
                </a>
            </span> /
            <span>{{ $exhibition->title }}</span>
        </h2>
    </x-slot>

    <div class="flex flex-wrap w-full max-w-7xl mx-auto">
        <div class="mx-auto md:w-1/4 py-5 px-6 w-full">
            <ul class="bg-indigo-100 list-inside md:m-5 mt-5 md:mt-0 p-5 shadow w-full">
                <li title="@ucfirst(__('app.museum'))">
                    <h3 class="font-bold text-2xl mb-5">
                        <a href="{{ route('front.museum.show', ['slug' => $exhibition->inMuseum->slug]) }}">
                            {{ $exhibition->inMuseum->name }}
                        </a>
                    </h3>
                </li>
                <li title="@ucfirst(__('app.type'))">@ucfirst(__('app.' . Str::slug($exhibition->inMuseum->type, '_')))</li>
                <li title="@ucfirst(__('app.address'))">{{ $exhibition->inMuseum->address }}</li>
                <li>
                    <span title="@ucfirst(__('app.city'))">{{ $exhibition->inMuseum->city }}</span>,
                    <span title="@ucfirst(__('app.country'))">{{ $exhibition->inMuseum->inCountry->name_common_fra }}</span>.
                </li>
                <li class="mt-5" title="@ucfirst(__('app.link'))">
                    <a href="{{ $exhibition->inMuseum->link }}" class="text-blue-700 hover:text-red-600" target="_blank" rel="noopener">{{ $exhibition->inMuseum->link }}</a>
                </li>
            </ul>
            @auth
            <ul class="bg-yellow-400 list-inside md:m-5 mt-5 md:mt-0 p-5 shadow w-full">
                <li><livewire:interfaces.follow-exhibition :exhibition="$exhibition" :wire:key="$exhibition->uuid" /></li>
            </ul>
            @endauth
            @if ($exhibition->inMuseum->status === 1)
            <ul class="bg-green-100 list-inside md:m-5 mt-5 md:mt-0 p-5 shadow w-full">
            @else
            <ul class="bg-red-100 list-inside md:m-5 mt-5 md:mt-0 p-5 shadow w-full">
            @endif
                <li title="@ucfirst(__('app.is_open'))">
                    @if ($exhibition->inMuseum->status === 1)
                    <span class="text-green-900">@ucfirst(__('app.museum_open')).</span>
                    @else
                    <span class="text-red-900">@ucfirst(__('app.museum_close')).</span>
                    @endif
                </li>
            </ul>
            <ul class="list-inside md:m-5 mt-5 md:mt-0 shadow w-full">
                <li><livewire:interfaces.map :museum="$exhibition->inMuseum" :wire:key="$exhibition->inMuseum->uuid" /></li>
            </ul>
            @auth
            @if (Auth::user()->can('create', App\Models\Exhibition::class))
            <ul class="bg-gray-200 list-inside md:m-5 mt-5 md:mt-0 p-5 shadow w-full">
                <li><livewire:modals.edit-exhibition :exhibition="$exhibition" :wire:key="$exhibition->uuid" /></li>
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

            <ul class="list-inside bg-gray-200 my-5 w-full">
                <li title="@ucfirst(__('app.exhibition'))">
                    <h4 class="bg-gray-300 font-bold text-2xl p-3 mb-5">
                        {{ $exhibition->title }}
                    </h4>
                </li>
                <li class="flex space-x-5 md:px-0 justify-end mb-5">
                    <span class="bg-yellow-100 p-2" title="@ucfirst(__('app.price'))">
                        @ucfirst(__('app.price')) :
                        @if ($exhibition->price)
                            {{ $exhibition->price }}.
                        @else
                            {{ __('app.no_price') }}.
                        @endif
                    </span>
                    <span class="bg-green-100 p-2" title="@ucfirst(__('app.began_at'))">
                        @ucfirst(__('app.began_at')) : @date($exhibition->began_at).
                    </span>
                    <span class="bg-red-100 p-2" title="@ucfirst(__('app.ended_at'))">
                        @ucfirst(__('app.ended_at')) : @date($exhibition->ended_at).
                    </span>
                </li>
                <li class="px-5">
                    {{ $exhibition->description }}
                </li>
                <li class="mt-5 p-5" title="@ucfirst(__('app.link'))">
                    @if ($exhibition->link)
                    <a href="{{ $exhibition->link }}" class="text-blue-700 hover:text-red-600" target="_blank" rel="noopener">{{ $exhibition->link }}</a>
                    @else
                    <a href="{{ $exhibition->inMuseum->link }}" class="text-blue-700 hover:text-red-600" target="_blank" rel="noopener">{{ $exhibition->inMuseum->link }}</a>
                    @endif
                </li>
            </ul>
            <div class="bg-gray-200 px-5 p-5 w-full">
                @if (count($exhibition->tags) > 0)
                @foreach ($exhibition->tags as $tag)
                <a href="{{ route('front.tag.show', ['slug' => $tag->slug]) }}"
                    class="bg-gray-300 mr-2 p-2 inline-block" title="{{ $tag->type }}">
                    {{ $tag->name }}
                </a>
                @endforeach
                @else
                <div title="@ucfirst(__('app.no_tags'))">@ucfirst(__('app.no_tags'))</div>
                @endif
                <livewire:interfaces.tag-exhibition :exhibition="$exhibition" :wire:key="$exhibition->uuid" />
            </div>
        </div>
    </div>
</div>
