<div class="relative">
    <div class="relative">
        <x-forms.input
            type="text"
            class="relative border-gray-300 focus:border-green-300 focus:ring focus:ring-green-200 focus:ring-opacity-50 rounded-md shadow-sm block mt-1 w-full"
            :placeholder="@ucfirst(__('app.search_some', ['what' => __('app.tags')]))"
            wire:model="query"
            wire:click="reset"
            wire:keydown.escape="hideDropdown"
            wire:keydown.tab="hideDropdown"
            wire:keydown.Arrow-Up="decrementHighlight"
            wire:keydown.Arrow-Down="incrementHighlight"
            wire:keydown.enter.prevent="selectTag"
        />

        <input type="hidden" name="slug" id="tag" wire:model="selectedTag">

        @if ($selectedTag)
        <a class="absolute cursor-pointer top-2 right-2 text-gray-500" wire:click="reset">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        </a>
        @endif
    </div>

    @if(!empty($query) && $selectedTag == '' && $showDropdown)
    <div class="absolute z-10 bg-white mt-1 w-full border border-gray-300 rounded-md shadow-lg">
        @if (!empty($tags))
        @foreach($tags as $i => $tag)
        <a wire:click="selectTag({{ $i }})"
            class="block py-1 px-2 text-sm cursor-pointer hover:bg-blue-50 {{ $highlightIndex === $i ? 'bg-blue-50' : '' }}"
            >{{ $tag['name'] }}</a>
        @endforeach
        @else
        <span class="block py-1 px-2 text-sm">@ucfirst(__('app.nothing'))</span>
        @endif
    </div>
    @endif
</div>
