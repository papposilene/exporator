<div id="leaflet-map" class="h-96 w-full"></div>

<script>
document.addEventListener('livewire:load', function () {
    var leafletMap = L.map('leaflet-map').setView([0, 0], 13);

    L.geoJSON('//localhost/api/1.1/{{ $api }}/geojson').addTo(leafletMap);
})
</script>
