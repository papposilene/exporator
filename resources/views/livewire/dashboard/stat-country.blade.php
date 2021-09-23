<div class="bg-indigo-100 m-5 p-5 w-1/4">
    <h3 class="font-bold text-2xl mb-5">@ucfirst(__('app.countries'))</h3>
    <h4 class="font-bold text-1xl mb-2">@ucfirst(__('app.statistics'))</h4>
    <ol class="list-inside list-disc">
        <li>@ucfirst(__('app.numbers_of_countries', ['count' => $countries]))</li>
        <li>@ucfirst(__('app.top1_of_countries', ['name' => $top1_of_countries->name_common_fra]))</li>
    </ol>
</div>
