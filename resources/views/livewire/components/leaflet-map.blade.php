<div id="leaflet-map" class="w-full"></div>

<script>
document.addEventListener('livewire:load', function () {
    var leafletMap = L.map('leaflet-map').setView([0, 0], 13);

    L.geoJSON().addTo(leafletMap);
})
</script>
