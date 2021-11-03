<div class="relative">
    <div class="relative">
        <x-forms.input
            type="text"
            class="relative border-bluegray-300 focus:border-green-300 focus:ring focus:ring-green-200 focus:ring-opacity-50 rounded-md shadow-sm block mt-1 w-full"
            :placeholder="@ucfirst(__('app.search_some', ['what' => __('app.countries')]))"
            wire:model="query"
            wire:click="reset"
            wire:keydown.escape="hideDropdown"
            wire:keydown.tab="hideDropdown"
            wire:keydown.Arrow-Up="decrementHighlight"
            wire:keydown.Arrow-Down="incrementHighlight"
            wire:keydown.enter.prevent="selectCountry"
        />

        <input type="hidden" name="uuid" id="country" wire:model="selectedCountry">

        @if ($selectedCountry)
        <a class="absolute cursor-pointer top-2 right-2 text-bluegray-500" wire:click="reset">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        </a>
        @endif
    </div>

    @if(!empty($query) && $selectedCountry == '' && $showDropdown)
    <div class="absolute z-10 bg-white mt-1 w-full border border-bluegray-300 rounded-md shadow-lg">
        @if (!empty($countries))
        @foreach($countries as $i => $country)
        <a wire:click="selectCountry({{ $i }})"
            class="block py-1 px-2 text-sm cursor-pointer hover:bg-sky-50 {{ $highlightIndex === $i ? 'bg-sky-50' : '' }}"
            >{{ $country['name'] }}</a>
        @endforeach
        @else
        <span class="block py-1 px-2 text-sm">@ucfirst(__('app.nothing'))</span>
        @endif
    </div>
    @endif
</div>
