<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <span>
                <a href="{{ route('admin.museum.show', ['slug' => $exhibition->inMuseum->slug]) }}">
                    {{ $exhibition->inMuseum->name }}
                </a>
            </span> /
            <span>{{ $exhibition->title }}</span>
        </h2>
    </x-slot>

    <div>
        <div class="w-3/12 mx-auto py-5 sm:px-6 lg:px-8 float-left">
            <ul class="bg-purple-100 list-inside m-5 p-5 w-full">
                <li title="@ucfirst(__('app.museum'))">
                    <h3 class="font-bold text-2xl mb-5">
                        {{ $exhibition->inMuseum->name }}
                    </h3>
                </li>
                <li title="@ucfirst(__('app.type'))">@ucfirst(__('app.' . Str::slug($exhibition->inMuseum->type, '_')))</li>
                <li title="@ucfirst(__('app.address'))">{{ $exhibition->inMuseum->address }}</li>
                <li>
                    <span title="@ucfirst(__('app.city'))">{{ $exhibition->inMuseum->city }}</span>,
                    <span title="@ucfirst(__('app.country'))">{{ $exhibition->inMuseum->inCountry->name_common_fra }}</span>.
                </li>
                <li class="mt-5" title="@ucfirst(__('app.link'))">
                    <a href="{{ $exhibition->inMuseum->link }}" target="_blank" rel="noopener">{{ $exhibition->inMuseum->link }}</a>
                </li>
            </ul>
            @if ($exhibition->inMuseum->status === 1)
            <ul class="bg-green-100 list-inside m-5 p-5 w-full">
            @else
            <ul class="bg-red-100 list-inside m-5 p-5 w-full">
            @endif
                <li title="@ucfirst(__('app.is_open'))">
                    @if ($exhibition->inMuseum->status === 1)
                    <span class="text-green-900">@ucfirst(__('app.museum_open')).</span>
                    @else
                    <span class="text-red-900">@ucfirst(__('app.museum_close')).</span>
                    @endif
                </li>
            </ul>
            @if (Auth::user()->can('create', App\Models\Exhibition::class))
            <ul class="bg-gray-200 list-inside m-5 p-5 w-full">
                <li><livewire:modals.edit-exhibition :exhibition="$exhibition" :wire:key="$exhibition->uuid" /></li>
            </ul>
            @endif
        </div>

        <div class="w-9/12 mx-auto py-5 sm:px-6 lg:px-8 float-right">
            @if ($errors->any())
            <div class="bg-red-400 border border-red-500 py-5 sm:px-6 lg:px-8 text-black rounded">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <ul class="list-inside m-5 p-5 w-full">
                <li title="@ucfirst(__('app.exhibition'))">
                    <h4 class="font-bold text-2xl mb-5">
                        {{ $exhibition->title }}
                    </h4>
                </li>
                <li title="@ucfirst(__('app.began_at'))">@date($exhibition->began_at)</li>
                <li title="@ucfirst(__('app.ended_at'))">@date($exhibition->ended_at)</li>
                <li>
                    {{ $exhibition->description }}
                </li>
                <li class="mt-5" title="@ucfirst(__('app.link'))">
                    @if ($exhibition->link)
                    <a href="{{ $exhibition->link }}" target="_blank" rel="noopener">{{ $exhibition->link }}</a>
                    @else
                    <a href="{{ $exhibition->inMuseum->link }}" target="_blank" rel="noopener">{{ $exhibition->inMuseum->link }}</a>
                    @endif
                </li>
                <li class="mt-5" title="@ucfirst(__('app.tags'))">
                    @if ($exhibition->tags)
                    @foreach ($exhibition->tags as $tag)
                    {{ $tag->name }}
                    @endforeach
                    @else
                    @ucfirst(__('app.notags'))
                    @endif
                </li>
            </ul>
        </div>
    </div>
</div>
