<div class="flex-grow bg-bluegray-400 p-5 w-full">
    <h3 class="font-bold text-2xl mb-5">@ucfirst(__('app.welcome_to', ['name' => Auth::user()->name]))</h3>
    <div class="grid grid-cols-1 mb-4">
        <p>dsaq</p>
    </div>
    <div class="grid grid-cols-1 lg:grid-cols-3 sm:gap-2 lg:gap-4">
        <div class="bg-rose-300 hover:bg-white m-2 p-2 rounded" title="@ucfirst(__('app.user_following_places', ['count' => $user->followedPlaces()->count()]))">
            <a href="{{ route('front.place.index', ['filter' => 'followed']) }}" class="flex flex-grow justify-center text-center">
                @ucfirst(__('app.places')) : {{ $user->followedPlaces()->count() }}.
            </a>
        </div>
        <div class="bg-sky-300 hover:bg-white m-2 p-2 rounded" title="@ucfirst(__('app.user_following_exhibitions', ['count' => $user->followedExhibitions()->count()]))">
            <a href="{{ route('front.exhibition.index', ['filter' => 'followed']) }}" class="flex flex-grow justify-center text-center">
                @ucfirst(__('app.exhibitions')) : {{ $user->followedExhibitions()->count()  }}.
            </a>
        </div>
        <div class="bg-indigo-300 hover:bg-white m-2 p-2 rounded" title="@ucfirst(__('app.user_following_tags', ['count' => $user->followedTags()->count()]))">
            <a href="{{ route('front.tag.index', ['filter' => 'followed']) }}" class="flex flex-grow justify-center text-center">
                @ucfirst(__('app.tags')) : {{ $user->followedTags()->count() }}.
            </a>
        </div>
    </div>
    <div class="flex w-full">
        <div>
            @for ($ii = 0; $since < $ii; $ii++)
            @php $yearToFind = $year - $ii; @endphp
            {{ $user->followedExhibitions()->whereYear('visited_at', $yearToFind)->count() }}
            {{ $user->followedExhibitions()->whereYear('visited_at', $yearToFind)->pluck('price') }}
            @endfor
        </div>
    </div>
</div>
