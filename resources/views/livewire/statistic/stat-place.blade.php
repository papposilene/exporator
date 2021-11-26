<div class="bg-rose-300 lg:m-5 mt-5 lg:mt-0 p-5 rounded shadow w-full">
    <h3 class="font-bold text-2xl mb-5">
        <a href="{{ route('front.place.index') }}">
            @ucfirst(__('app.places'))
        </a>
    </h3>
    <div class="grid grid-cols-1 gap-4">
        <div class="">
            <h4 class="font-bold text-xl">
                @ucfirst(__('chart.places_by_types'))
            </h4>
            <canvas id="chartPlaces" width="400" height="400"></canvas>
        </div>
        <div class="">
        <h4 class="font-bold text-xl">
                @ucfirst(__('chart.places_by_status'))
            </h4>
            <canvas id="chartStatus" width="400" height="400"></canvas>
        </div>
    </div>
</div>

<script>
document.addEventListener('livewire:load', function () {
    // Places : chart for total
    const chartPlacesError = null;
    const chartPlacesErrored = false;
    const chartPlacesLoading = true;
    axios.get("{{ route('api.place.stat_total') }}")
        .then(response => {
            new Chart(document.getElementById('chartPlaces').getContext('2d'), {
                type: 'doughnut',
                data: response.data.chart,
                options: response.data.options,
            });
            this.chartPlacesLoading = false
        })
        .catch(error => {
            this.chartPlacesErrored = true
            this.chartPlacesError = error.response.data.message || error.message
        })
        .finally(() => this.chartPlacesLoading = false);

    // Places : chart for status
    const chartStatusError = null;
    const chartStatusErrored = false;
    const chartStatusLoading = true;
    axios.get("{{ route('api.place.stat_status') }}")
        .then(response => {
            new Chart(document.getElementById('chartStatus').getContext('2d'), {
                type: 'doughnut',
                data: response.data.chart,
                options: response.data.options,
            });
            this.chartStatusLoading = false
        })
        .catch(error => {
            this.chartStatusErrored = true
            this.chartStatusError = error.response.data.message || error.message
        })
        .finally(() => this.chartStatusLoading = false);
})
</script>
