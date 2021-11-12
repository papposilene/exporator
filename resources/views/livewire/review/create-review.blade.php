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
            <ul class="bg-rose-100 list-inside md:m-5 mt-5 md:mt-0 p-5 rounded shadow w-full">
                <li class="flex flex-grow justify-between" title="@ucfirst(__('app.tag'))">
                    <h4 class="font-bold text-2xl mb-5">
                        {{ $exhibition->inPlace->name }}
                    </h4>
                    <span><livewire:interfaces.follow-place :place="$exhibition->inPlace" :wire:key="$exhibition->inPlace->uuid" /></span>
                </li>
                <li title="@ucfirst(__('app.type'))">@ucfirst(__('app.' . Str::slug($exhibition->inPlace->type, '_')))</li>
                <li title="@ucfirst(__('app.address'))">{{ $exhibition->inPlace->address }}</li>
                <li>
                    <span title="@ucfirst(__('app.city'))">{{ $exhibition->inPlace->city }}</span>,
                    <span title="@ucfirst(__('app.country'))">{{ $exhibition->inPlace->inCountry->name_common_fra }}</span>.
                </li>
                <li class="mt-5" title="@ucfirst(__('app.link'))">
                    <a href="{{ $exhibition->inPlace->link }}" class="text-sky-700 hover:text-red-600" target="_blank" rel="noopener">
                        {{ $exhibition->inPlace->link }}
                    </a>
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

            <ul class="bg-sky-100 list-inside md:mt-0 p-5 rounded shadow w-full">
                <li class="flex flex-grow justify-between" title="@ucfirst(__('app.tag'))">
                    <h3 class="font-bold text-2xl mb-5">
                        {{ $exhibition->title }}
                    </h3>
                    <span><livewire:interfaces.follow-place :place="$exhibition->inPlace" :wire:key="$exhibition->inPlace->uuid" /></span>
                </li>
                <li class="">@nl2br($exhibition->description)</li>
                @if ($exhibition->link)
                <li class="mt-5" title="@ucfirst(__('app.link'))">
                    <a href="{{ $exhibition->link }}" class="text-sky-700 hover:text-red-600" target="_blank" rel="noopener">
                        {{ $exhibition->link }}
                    </a>
                </li>
                @endif
            </ul>

            <div class="bg-bluegray-600 dark:text-white my-5 p-5 rounded shadow w-full">
                <form method="POST" action="{{ route('admin.review.store') }}" enctype="multipart/form-data"
                    class="flex flex-col w-full">
                    @csrf

                    <input type="hidden" name="uuid" value="{{ $exhibition->uuid }}" />

                    <div class="mt-4">
                        @ucfirst(__('app.review_info'))
                    </div>

                    <div class="mt-4">
                        <x-forms.label class="text-gray-100 text-xl" for="title">@ucfirst(__('app.title'))</x-forms.label>
                        <x-forms.input class="text-gray-800 bg-bluegray-300 block mt-1 w-full"
                            type="text" id="title" name="title" required :value="old('title')" />
                    </div>

                    <div class="mt-4">
                        <x-forms.label class="text-gray-100 text-xl" for="review">@ucfirst(__('app.review'))</x-forms.label>
                        <x-forms.textarea class="text-gray-800 bg-bluegray-300 block mt-1 w-full"
                            type="text" id="review" name="review" rows="25" required :value="old('review')" />
                    </div>

                    <div class="mt-4">
                        <x-forms.label class="text-gray-100 text-xl" for="link">@ucfirst(__('app.link'))</x-forms.label>
                        <x-forms.input class="text-gray-800 bg-bluegray-300 block mt-1 w-full"
                            type="text" id="link" name="link" placeholder="{{ __('app.https') }}" :value="old('link')" />
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <x-forms.button class="ml-4 bg-bluegray-500 p-2">
                            @ucfirst(__('app.save'))
                        </x-forms.button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
