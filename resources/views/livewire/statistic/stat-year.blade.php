<div class="bg-bluegray-300 mt-2 lg:mt-0 p-5 rounded shadow w-full">
    <h3 class="font-bold text-2xl mb-5">
        @ucfirst(__('app.statistics_for', ['year' => $year]))
    </h3>

    <div class="flex flex-row flex-grow flex-wrap w-full">
        <!-- Global statistics by exhibitions -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-2 w-full">
            <div class="bg-rose-400 text-black p-2 rounded shadow">
                <div class="flex flex-wrap items-stretch justify-center">
                    <span class="text-center text-xl px-3 w-full">@ucfirst(__('app.place_first', ['year' => $year]))</span>
                    <span class="font-bold text-center text-xl p-3 w-full">
                        {{ array_key_first($places) }}
                    </span>
                </div>
            </div>
            <div class="bg-sky-400 text-black p-2 rounded shadow">
                <div class="flex flex-wrap items-stretch justify-center">
                    <span class="text-center text-xl px-3 w-full">@ucfirst(__('app.exhibitions_for', ['year' => $year]))</span>
                    <span class="font-bold text-center text-xl p-3 w-full">{{ $exhibitions->count() }}</span>
                </div>
            </div>
            <div class="bg-yellow-400 text-black p-2 rounded shadow">
                <div class="flex flex-wrap items-stretch justify-center">
                    <span class="text-center text-xl px-3 w-full">@ucfirst(__('app.prices_for', ['year' => $year]))<sup>1</sup></span>
                    <span class="font-bold text-center text-xl p-3 w-full">@currency($exhibitions->sum('price'))&nbsp;&euro;</span>
                </div>
            </div>
        </div>
        <!-- End of global statistics by exhibitions -->

        <!-- Statistics by exhibitions -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-2 mt-2 w-full">
            <div class="bg-sky-400 text-black p-2 rounded shadow">
                <div class="flex flex-wrap items-stretch justify-center">
                    <span class="text-center text-xl px-3 w-full">@ucfirst(__('app.first_exhibition_for', ['year' => $year]))</span>
                    <span class="font-bold text-center text-xl p-3 w-full">
                        <a href="{{ route('front.exhibition.show', ['place' => $exhibitions->first()->inPlace->slug, 'slug' => $exhibitions->first()->slug]) }}">
                            {{ $exhibitions->first()->title }}
                        </a>
                    </span>
                </div>
            </div>
            <div class="bg-sky-400 text-black p-2 rounded shadow">
                <div class="flex flex-wrap items-stretch justify-center">
                    <span class="text-center text-xl px-3 w-full">@ucfirst(__('app.last_exhibition_for', ['year' => $year]))</span>
                    <span class="font-bold text-center text-xl p-3 w-full">
                        <a href="{{ route('front.exhibition.show', ['place' => $exhibitions->last()->inPlace->slug, 'slug' => $exhibitions->last()->slug]) }}">
                            {{ $exhibitions->last()->title }}
                        </a>
                    </span>
                </div>
            </div>
        </div>
        <!-- End of statistics by exhibitions -->

        <!-- Statistics by charts -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 bg-sky-400 my-2 p-5 rounded shadow w-full">
            <div class="">
                <h4 class="font-bold text-xl text-center mb-2">
                    @ucfirst(__('chart.genders_by_years'))
                </h4>
                <canvas id="chartGenders" width="400" height="400"></canvas>
            </div>
            <div class="">
                <h4 class="font-bold text-xl text-center mb-2">
                    @ucfirst(__('chart.continents_by_years'))
                </h4>
                <canvas id="chartContinents" width="400" height="400"></canvas>
            </div>
        </div>
        <!-- End of statistics by charts -->
    </div>
</div>

@auth
<div class="bg-bluegray-300 mt-2 p-5 rounded shadow w-full">
    <div class="flex flex-row flex-grow flex-wrap w-full">
        <!-- Statistics for user -->
        <h4 class="font-bold text-xl mb-5">
        @ucfirst(__('app.user_total_for', ['year' => $year]))
        </h4>
        <div class="grid grid-cols-1 gap-2 bg-bluegray-400 p-5 rounded shadow w-full">
            <p class="flex flex-grow bg-sky-300 justify-between p-2 rounded shadow w-full">
                <span class="px-3">@ucfirst(__('app.user_has_visited', ['year' => $year]))</span>
                <span class="px-3">
                    {{ $user->hasVisitedExhibitions()->count() }} / {{ $exhibitions->count() }}
                    ({{ round( ($user->hasVisitedExhibitions()->count() / $exhibitions->count()) * 100, 2) }}&nbsp;&percnt;)
                </span>
            </p>
            <p class="flex flex-grow bg-yellow-300 justify-between p-2 rounded shadow w-full">
                <span class="px-3">@ucfirst(__('app.user_has_paid', ['year' => $year]))<sup>1</sup></span>
                <span class="px-3">
                    @currency($user->visitedExhibitions()->sum('price'))&nbsp;&euro; / @currency($exhibitions->sum('price'))
                    ({{ round( ($user->visitedExhibitions()->sum('price') / $exhibitions->sum('price')) * 100, 2) }}&nbsp;&percnt;)
                </span>
            </p>
        </div>
        <!-- End of statistics for user -->
    </div>
</div>
@endauth

<div class="bg-bluegray-300 mt-2 p-5 rounded shadow w-full">
    <div class="flex flex-row flex-grow flex-wrap bg-bluegray-400 p-5 rounded shadow w-full">
        <!-- Notes about astatistics -->
        <div class="flex flex-col w-full">
            <p class="flex font-bold text-sm w-full">@ucfirst(__('app.informations'))</p>
            <ol class="list-inside list-decimal w-full">
                <li class="text-sm">@ucfirst(__('app.stats_info'))</li>
            </ol>
        </div>
        <!-- End of notes about astatistics -->
    </div>
</div>

<script>
document.addEventListener('livewire:load', function () {
    // Exhibitions : chart by genders
    const chartGendersError = null;
    const chartGendersErrored = false;
    const chartGendersLoading = true;
    axios.get("{{ route('api.stat.gender', ['year' => $year]) }}")
        .then(response => {
            new Chart(document.getElementById('chartGenders').getContext('2d'), {
                type: 'doughnut',
                data: response.data.chart,
                options: response.data.options,
            });
            this.chartGendersLoading = false
        })
        .catch(error => {
            this.chartGendersErrored = true
            this.chartGendersError = error.response.data.message || error.message
        })
        .finally(() => this.chartGendersLoading = false);

    // Exhibitions : chart by continents
    const chartContinentsError = null;
    const chartContinentsErrored = false;
    const chartContinentsLoading = true;
    axios.get("{{ route('api.stat.continent', ['year' => $year]) }}")
        .then(response => {
            new Chart(document.getElementById('chartContinents').getContext('2d'), {
                type: 'doughnut',
                data: response.data.chart,
                options: response.data.options,
            });
            this.chartContinentsLoading = false
        })
        .catch(error => {
            this.chartContinentsErrored = true
            this.chartContinentsError = error.response.data.message || error.message
        })
        .finally(() => this.chartContinentsLoading = false);
})
</script>
