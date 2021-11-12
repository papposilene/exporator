@section('title', $exhibition->title)

<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-bluegray-800 dark:text-bluegray-100 leading-tight">
            <span>
                <a href="{{ route('front.place.index') }}">
                    @ucfirst(__('app.write_one_review'))
                </a>
            </span> /
            <span>{{ $exhibition->title }}</span>
        </h2>
    </x-slot>

    <div class="flex flex-wrap w-full max-w-7xl mx-auto">
        <div class="mx-auto md:w-1/4 py-5 px-6 w-full">
            @if ($exhibition->inPlace->image)
            <ul class="bg-rose-100 list-inside md:m-5 mt-5 md:mt-0 p-5 rounded shadow w-full">
                <li>
                    <img src="{{ storage_path($exhibition->inPlace->image) }}" class=""
                        alt="{{ $exhibition->inPlace->name }}" title="{{ $exhibition->inPlace->name }}" />
                </li>
            </ul>
            @endif

            <ul class="bg-rose-100 list-inside md:m-5 mt-5 md:mt-0 p-5 rounded shadow w-full">
                <li class="flex flex-grow justify-between" title="@ucfirst(__('app.tag'))">
                    <h3 class="font-bold text-2xl mb-5">
                        {{ $exhibition->inPlace->name }}
                    </h3>
                    <span><livewire:interfaces.follow-place :place="$exhibition->inPlace" :wire:key="$exhibition->inPlace->uuid" /></span>
                </li>
                <li title="@ucfirst(__('app.type'))">@ucfirst(__('app.' . Str::slug($exhibition->inPlace->type, '_')))</li>
                <li title="@ucfirst(__('app.address'))">{{ $exhibition->inPlace->address }}</li>
                <li>
                    <span title="@ucfirst(__('app.city'))">{{ $exhibition->inPlace->city }}</span>,
                    <span title="@ucfirst(__('app.country'))">{{ $exhibition->inPlace->inCountry->name_common_fra }}</span>.
                </li>
                <li class="mt-5" title="@ucfirst(__('app.link'))">
                    <a href="{{ $exhibition->inPlace->link }}" class="text-sky-700 hover:text-red-600" target="_blank" rel="noopener">{{ $exhibition->inPlace->link }}</a>
                </li>
            </ul>
            <ul class="list-inside md:m-5 mt-5 md:mt-0 shadow w-full">
                <li><livewire:interfaces.map :place="$exhibition->inPlace" :wire:key="$exhibition->inPlace->uuid" /></li>
            </ul>
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

            <div class="py-5">

            </div>
        </div>
    </div>
</div>
