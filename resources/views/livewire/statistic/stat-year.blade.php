<div class="bg-bluegray-300 mt-2 lg:mt-0 p-5 rounded shadow w-full">
    <h3 class="font-bold text-2xl mb-5">
        <a href="{{ route('front.exhibition.index') }}">
            @ucfirst(__('app.statistics'))
        </a>
    </h3>

    <div class="flex flex-row flex-grow flex-wrap w-full">
        Lorem ipsum description : {{ $year }}.
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
            <div class="">
                <canvas id="chartGenders" width="400" height="400"></canvas>
            </div>
            <div class="">
                <canvas id="chartContinents" width="400" height="400"></canvas>
            </div>
        </div>
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
