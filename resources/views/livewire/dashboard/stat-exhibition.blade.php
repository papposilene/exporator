<div class="bg-pink-100 m-5 p-5 w-1/4">
    <h3 class="font-bold text-2xl mb-5">@ucfirst(__('app.exhibitions'))</h3>
    <h4 class="font-bold text-1xl my-5">@ucfirst(__('app.statistics'))</h4>
    <ol class="list-inside list-disc">
        <li>@ucfirst(__('app.numbers_of_exhibitions', ['count' => $exhibitions]))</li>
        <li>@ucfirst(__('app.numbers_of_today_exhibitions', ['count' => $exhibitions_today]))</li>
    </ol>
    <h4 class="font-bold text-1xl my-5">@ucfirst(__('app.final_days'))</h4>
    <ol class="list-inside list-disc">
        @foreach($exhibitions_finaldays as $finalday)
        <li>
            {{ $exhibition->title }}
        </li>
        @endforeach
    </ol>
</div>
