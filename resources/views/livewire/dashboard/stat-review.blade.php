<div class="flex-grow bg-sky-300 p-5 shadow w-full">
    <h3 class="font-bold text-2xl mb-5">
        <a href="{{ route('front.exhibition.index') }}">
            @ucfirst(__('app.reviews'))
        </a>
    </h3>
    <h4 class="font-bold text-1xl mb-2">@ucfirst(__('app.statistics'))</h4>
    <ol class="list-inside list-disc">
        <li>@ucfirst(__('app.numbers_of_exhibitions', ['count' => $reviews->count()]))</li>
    </ol>
</div>
