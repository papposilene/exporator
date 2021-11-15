<div class="flex-grow bg-sky-200 p-5 rounded shadow w-full">
    <h3 class="font-bold text-2xl mb-5">
        <a href="{{ route('front.exhibition.index') }}">
            @ucfirst(__('app.exhibitions'))
        </a>
    </h3>
    <div class="grid grid-cols-1 gap-4">
        <div class="">
            <h4 class="font-bold text-xl">
                @ucfirst(__('chart.exhibitions_by_years'))
            </h4>
            <canvas id="chartExhibitions" width="400" height="400"></canvas>
        </div>
    </div>

</div>

<script>
document.addEventListener('livewire:load', function () {
    // Exhibitions : chart by year
    const chartExhibitionsError = null;
    const chartExhibitionsErrored = false;
    const chartExhibitionsLoading = true;
    axios.get("{{ route('api.exhibition.stat_year') }}")
        .then(response => {
            new Chart(document.getElementById('chartExhibitions').getContext('2d'), {
                type: 'bar',
                data: response.data.chart,
                options: response.data.options,
            });
            this.chartExhibitionsLoading = false
        })
        .catch(error => {
            this.chartExhibitionsErrored = true
            this.chartExhibitionsError = error.response.data.message || error.message
        })
        .finally(() => this.chartExhibitionsLoading = false);

})
</script>
