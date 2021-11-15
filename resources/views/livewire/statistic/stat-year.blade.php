<div class="bg-bluegray-300 mt-2 lg:mt-0 p-5 rounded shadow w-full">
    <h3 class="font-bold text-2xl mb-5">
        <a href="{{ route('front.exhibition.index') }}">
            @ucfirst(__('app.statistics'))
        </a>
    </h3>

    <div x-data="{ tab: '{{ date('Y') }}' }" id="tab_wrapper"
        class="flex flex-col flex-grow flex-wrap bg-bluegray-300 w-full">
        <nav class="flex flex-row flex-grow flex-wrap w-full">
            @foreach (array_keys($years) as $year)
            <a @click.prevent="tab = '{{ $year }}'" href="#"
                class="text-white mr-2 p-2 rounded shadow { tab === '{{ $year }}' ? 'bg-red-500' : 'bg-bluegray-500' }">
                {{ $year }}
            </a>
            @endforeach
        </nav>

        @foreach (array_keys($years) as $year)
        <div x-show="tab === '{{ $year }}'"
            class="flex flex-row flex-grow flex-wrap bg-bluegray-400 mt-5 p-2 rounded w-full">
            Lorem ipsum description : {{ $year }}.
        </div>
        @endforeach
    </div>
</div>

<script>
document.addEventListener('livewire:load', function () {
    @foreach (array_keys($years) as $year)
    // Exhibitions : chart by year {{ $year }}
    const chartExhibitionsError = null;
    const chartExhibitionsErrored = false;
    const chartExhibitionsLoading = true;
    axios.get("{{ route('api.exhibition.stat_year', ['year' => $year]) }}")
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
    @endforeach
})
</script>
