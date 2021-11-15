<div class="flex-grow bg-sky-300 p-5 rounded shadow w-full">
    <h3 class="font-bold text-2xl mb-5">
        <a href="{{ route('front.exhibition.index') }}">
            @ucfirst(__('app.exhibitions'))
        </a>
    </h3>
    <div class="grid grid-cols-1 gap-2 lg:gap-4">
        @auth
        <div class="bg-sky-500 text-white p-2 rounded" title="@ucfirst(__('app.followed_exhibitions'))">
            <a href="{{ route('front.exhibition.index', ['filter' => 'followed']) }}" class="flex flex-grow justify-between">
                <span class="px-3">@ucfirst(__('app.followed_exhibitions'))</span>
                <span class="px-3">{{ $user->followedExhibitions()->count() }}</span>
            </a>
        </div>
        @endauth
        <div class="bg-sky-500 text-white p-2 rounded">
            <a href="{{ route('front.exhibition.index', ['filter' => 'followed']) }}" class="flex flex-grow justify-between">
                <span class="px-3">@ucfirst(__('app.numbers_of_exhibitions'))</span>
                <span class="px-3">{{ $exhibitions }}</span>
            </a>
        </div>
        <div class="bg-sky-500 text-white p-2 rounded">
            <a href="{{ route('front.exhibition.index', ['filter' => 'followed']) }}" class="flex flex-grow justify-between">
                <span class="px-3">@ucfirst(__('app.numbers_of_today_exhibitions'))</span>
                <span class="px-3">{{ $exhibitions_today }}</span>
            </a>
        </div>
        <div class="bg-sky-500 text-white p-2 rounded">
            <a href="{{ route('front.exhibition.index', ['filter' => 'followed']) }}" class="flex flex-grow justify-between">
                <span class="px-3">@ucfirst(__('app.numbers_of_next_exhibitions'))</span>
                <span class="px-3">{{ $exhibitions_nextmonth }}</span>
            </a>
        </div>
    </div>
</div>
