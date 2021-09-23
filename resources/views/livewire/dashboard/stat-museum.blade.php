<div class="bg-purple-100 m-5 p-5 w-1/4">
    <h3 class="font-bold text-2xl mb-5">@ucfirst(__('app.museums'))</h3>
    <h4 class="font-bold text-1xl mb-2">@ucfirst(__('app.statistics'))</h4>
    <ol class="list-inside list-disc">
        <li>@ucfirst(__('app.numbers_of_museums', ['count' => $museums]))</li>
        @isset ($top1_of_museums)
        <li>@ucfirst(__('app.top1_of_museums', ['name' => $top1_of_museums->name]))</li>
        @endisset
    </ol>
    <h4 class="font-bold text-1xl mt-5 mb-2">@ucfirst(__('app.no_exhibition'))</h4>
    <ol class="list-inside list-disc">
        @if(count($open_museums_without_exhibition) > 0)
        @foreach($open_museums_without_exhibition->where('has_exhibitions_count', 0) as $no_exhibition)
        <li>
            <a href="{{ route('admin.museum.show', ['slug' => $no_exhibition->slug]) }}">
                {{ $no_exhibition->name }}
            </a>
        </li>
        @endforeach
        @else
        <li>
            @ucfirst(__('app.nothing')).
        </li>
        @endif
    </ol>
</div>
