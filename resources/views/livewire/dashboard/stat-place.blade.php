<div class="flex-grow bg-rose-300 p-5 rounded shadow w-full">
    <h3 class="font-bold text-2xl mb-5">
        <a href="{{ route('front.place.index') }}">
            @ucfirst(__('app.places'))
        </a>
    </h3>
    <div class="grid grid-cols-1 gap-2 lg:gap-4">
        @auth
        <div class="bg-rose-500 text-white p-2 rounded" title="@ucfirst(__('app.followed_places'))">
            <a href="{{ route('front.place.index', ['filter' => 'followed']) }}" class="flex flex-grow justify-between">
                <span class="px-3">@ucfirst(__('app.followed_places'))</span>
                <span class="px-3">{{ $user->followedPlaces()->count() }}</span>
            </a>
        </div>
        @endauth
        <div class="bg-rose-500 text-white p-2 rounded">
            <a href="{{ route('front.place.index', ['type' => '']) }}" class="flex flex-grow justify-between">
                <span class="px-3">@ucfirst(__('app.numbers_of_places'))</span>
                <span class="px-3">{{ $places }}</span>
            </a>
        </div>
        <div class="bg-rose-500 text-white p-2 rounded">
            <a href="{{ route('front.place.index', ['type' => 'museum']) }}" class="flex flex-grow justify-between">
                <span class="px-3">@ucfirst(__('app.numbers_of_museum_type'))</span>
                <span class="px-3">{{ $museum_type }}</span>
            </a>
        </div>
        <div class="bg-rose-500 text-white p-2 rounded">
            <a href="{{ route('front.place.index', ['type' => 'gallery']) }}" class="flex flex-grow justify-between">
                <span class="px-3">@ucfirst(__('app.numbers_of_gallery_type'))</span>
                <span class="px-3">{{ $gallery_type }}</span>
            </a>
        </div>
        <div class="bg-rose-500 text-white p-2 rounded">
            <a href="{{ route('front.place.index', ['type' => 'art-center']) }}" class="flex flex-grow justify-between">
                <span class="px-3">@ucfirst(__('app.numbers_of_artcenter_type'))</span>
                <span class="px-3">{{ $artcenter_type }}</span>
            </a>
        </div>
        <div class="bg-rose-500 text-white p-2 rounded">
            <a href="{{ route('front.place.index', ['type' => 'art-fair']) }}" class="flex flex-grow justify-between">
                <span class="px-3">@ucfirst(__('app.numbers_of_artfair_type'))</span>
                <span class="px-3">{{ $artfair_type }}</span>
            </a>
        </div>
        <div class="bg-rose-500 text-white p-2 rounded">
            <a href="{{ route('front.place.index', ['type' => 'library']) }}" class="flex flex-grow justify-between">
                <span class="px-3">@ucfirst(__('app.numbers_of_library_type'))</span>
                <span class="px-3">{{ $library_type }}</span>
            </a>
        </div>
        <div class="bg-rose-500 text-white p-2 rounded">
            <a href="{{ route('front.place.index', ['type' => 'foundation']) }}" class="flex flex-grow justify-between">
                <span class="px-3">@ucfirst(__('app.numbers_of_foundation_type'))</span>
                <span class="px-3">{{ $foundation_type }}</span>
            </a>
        </div>
        <div class="bg-rose-500 text-white p-2 rounded">
            <a href="{{ route('front.place.index', ['type' => 'other']) }}" class="flex flex-grow justify-between">
                <span class="px-3">@ucfirst(__('app.numbers_of_other_type'))</span>
                <span class="px-3">{{ $other_type }}</span>
            </a>
        </div>
    </div>
</div>
