<div class="bg-purple-100 m-5 p-5 w-1/4">
    <h3 class="font-bold text-2xl mb-5">@ucfirst(__('app.museums'))</h3>
    <h4 class="font-bold text-1xl my-5">@ucfirst(__('app.statistics'))</h4>
    <ol class="list-inside list-disc">
        <li>@ucfirst(__('app.numbers_of_museums', ['count' => $museums]))</li>
        @isset ($top1_of_museums)
        <li>@ucfirst(__('app.top1_of_museums', ['name' => $top1_of_museums->name]))</li>
        @endisset
    </ol>
</div>
