<div class="flex-grow bg-indigo-200 p-5 rounded shadow w-full">
    <h3 class="font-bold text-2xl mb-5">
        <a href="{{ route('front.tag.index') }}">
            @ucfirst(__('app.tags'))
        </a>
    </h3>
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-4">
        <div class="">
            <h4 class="font-bold text-xl">
                @ucfirst(__('chart.tags_by_genders'))
            </h4>
            <canvas id="chartGenders" width="400" height="400"></canvas>
        </div>
        <div class="">
            <h4 class="font-bold text-xl">
                @ucfirst(__('chart.tags_by_continents'))
            </h4>
            <canvas id="chartContinents" width="400" height="400"></canvas>
        </div>
        <div class="">
            <h4 class="font-bold text-xl">
                @ucfirst(__('chart.tags_by_techniques'))
            </h4>
            <canvas id="chartTechniques" width="400" height="400"></canvas>
        </div>
        <div class="">
            <h4 class="font-bold text-xl">
                @ucfirst(__('chart.tags_by_genders'))
            </h4>
            <canvas id="chartGenders" width="400" height="400"></canvas>
        </div>
    </div>

</div>

<script>
document.addEventListener('livewire:load', function () {
    // Tags : chart for genders
    const chartGendersError = null;
    const chartGendersErrored = false;
    const chartGendersLoading = true;
    axios.get("{{ route('api.tag.stat_type', ['slug' => 'gender']) }}")
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

    // Tags : chart for continents
    const chartContinentsError = null;
    const chartContinentsErrored = false;
    const chartContinentsLoading = true;
    axios.get("{{ route('api.tag.stat_type', ['slug' => 'continent']) }}")
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

    // Tags : chart for techniques
    const chartTechniquesError = null;
    const chartTechniquesErrored = false;
    const chartTechniquesLoading = true;
    axios.get("{{ route('api.tag.stat_type', ['slug' => 'technique']) }}")
        .then(response => {
            new Chart(document.getElementById('chartTechniques').getContext('2d'), {
                type: 'doughnut',
                data: response.data.chart,
                options: response.data.options,
            });
            this.chartTechniquesLoading = false
        })
        .catch(error => {
            this.chartTechniquesErrored = true
            this.chartTechniquesError = error.response.data.message || error.message
        })
        .finally(() => this.chartTechniquesLoading = false);

})
</script>
