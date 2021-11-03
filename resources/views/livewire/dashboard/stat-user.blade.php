<div class="flex-grow bg-blue-100 p-5 w-full">
    <h3 class="font-bold text-2xl mb-5">@ucfirst(__('app.tagcloud'))</h3>
    <div class="grid grid-cols-1 lg:grid-cols-3 sm:gap-2 lg:gap-4">
        <div class="bg-yellow-300 hover:bg-white m-2 p-2 rounded" title="@ucfirst(__('app.user_following_places', ['count' => $user->followedPlaces()->count()]))">
            <a href="{{ route('front.place.index', ['filter' => 'followed']) }}" class="flex flex-grow justify-center text-center">
                @ucfirst(__('app.places')) : {{ $user->followedPlaces()->count() }}.
            </a>
        </div>
        <div class="bg-yellow-300 hover:bg-white m-2 p-2 rounded" title="@ucfirst(__('app.user_following_exhibitions', ['count' => $user->followedExhibitions()->count()]))">
            <a href="{{ route('front.place.index', ['filter' => 'followed']) }}" class="flex flex-grow justify-center text-center">
                @ucfirst(__('app.user_following_exhibitions')) : {{ $user->followedExhibitions()->count()  }}.
            </a>
        </div>
        <div class="bg-yellow-300 hover:bg-white m-2 p-2 rounded" title="@ucfirst(__('app.user_following_tags', ['count' => $user->followedTags()->count()]))">
            <a href="{{ route('front.place.index', ['filter' => 'followed']) }}" class="flex flex-grow justify-center text-center">
                @ucfirst(__('app.user_following_tags')) : {{ $user->followedTags()->count() }}.
            </a>
        </div>
    </div>
    <div class="flex w-full">
        <div>
            @for ($ii = 0; $since < $ii; $ii++)
            {{ $user->followedExhibitions()->whereYear('created_at', $year)->count() }}
            {{ $user->followedExhibitions()->whereYear('created_at', $year)->pluck('price') }}
            @endfor
        </div>
    </div>
</div>
