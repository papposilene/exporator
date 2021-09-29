<div id="leaflet-map" class="h-96 m-5 p-5 w-full"></div>

<script>
document.addEventListener('livewire:load', function () {
    var leafletMap = L.map('leaflet-map').setView([48.8635, 2.354], 2.5);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(leafletMap);

    L.geoJSON('{{ route('api.' . $api . '.geojson') }}').addTo(leafletMap);
})
</script>
