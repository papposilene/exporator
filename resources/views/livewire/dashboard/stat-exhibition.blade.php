<div class="flex-grow bg-sky-300 p-5 shadow w-full">
    <h3 class="font-bold text-2xl mb-5">@ucfirst(__('app.exhibitions'))</h3>
    <h4 class="font-bold text-1xl mb-2">@ucfirst(__('app.statistics'))</h4>
    <ol class="list-inside list-disc">
        <li>@ucfirst(__('app.numbers_of_exhibitions', ['count' => $exhibitions]))</li>
        <li>@ucfirst(__('app.numbers_of_today_exhibitions', ['count' => $exhibitions_today]))</li>
        <li>@ucfirst(__('app.numbers_of_next_exhibitions', ['count' => $exhibitions_nextmonth]))</li>
        <li>@ucfirst(__('app.numbers_of_finaldays_exhibitions', ['count' => $exhibitions_finaldays]))</li>
    </ol>
    <!--h4 class="font-bold text-1xl mt-5 mb-2">@ucfirst(__('app.final_days'))</h4>
    <ol class="list-inside list-disc">
        @if(count($exhibitions_finaldays) > 0)
        @foreach($exhibitions_finaldays as $finalday)
        <li>
            <a href="{{ route('admin.museum.show', ['slug' => $exhibition->inMuseum->slug]) }}">
                {{ $exhibition->inMuseum->name }}
            </a> : {{ $exhibition->title }}.
        </li>
        @endforeach
        @else
        <li>
            @ucfirst(__('app.nothing')).
        </li>
        @endif
    </ol-->
</div>
