<div id="timeline" class="h-screen w-full"></div>

<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
document.addEventListener('livewire:load', function () {
    this.isLoading = true;
    var options = {
        chart: {
            height: 450,
            type: 'rangeBar',
        },
        dataLabels: {
            enabled: false
        },
        series: [],
        noData: {
            text: "@ucfirst(__('app.loading'))"
        }
    }
    var chart = new ApexCharts(
        document.querySelector("#timeline"),
        options
    );
    chart.render();

    fetch("{{ route('api.exhibition.timeline') }}")
        .then(res => res.json())
        .then(data => {
            this.isLoading = false;
            chart.updateSeries([{
                name: "@ucfirst(__('app.exhibitions'))",
                data: data
            }])
        });

});
</script>
