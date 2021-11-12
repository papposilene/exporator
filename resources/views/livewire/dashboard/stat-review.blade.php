<div class="flex-grow bg-purple-300 p-5 shadow w-full">
    <h3 class="font-bold text-2xl mb-5">
        <a href="{{ route('front.exhibition.index') }}">
            @ucfirst(__('app.reviews'))
        </a>
    </h3>
    <canvas id="chartReviews" width="400" height="400"></canvas>
    <h4 class="font-bold text-1xl mb-2">@ucfirst(__('app.statistics'))</h4>
    <ol class="list-inside list-disc">
        <li>@ucfirst(__('app.numbers_of_reviews', ['count' => $reviews->count()]))</li>
    </ol>
</div>

<script>
document.addEventListener('livewire:load', function () {
    const chartError = null;
    const chartErrored = false;
    const chartLoading = true;
    const ctx = document.getElementById('chartReviews').getContext('2d');
    axios.get("{{ route('api.review.stat') }}")
        .then(response => {
            new Chart(document.getElementById('chartReviews').getContext('2d'), {
                type: 'doughnut',
                data: response.data.chart,
                options: response.data.options,
            });
            this.chartLoading = false
        })
        .catch(error => {
            this.chartErrored = true
            this.chartError = error.response.data.message || error.message
        })
        .finally(() => this.chartLoading = false);
})
</script>
