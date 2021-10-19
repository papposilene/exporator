<div>
    <div class="flex">
        <div id="leaflet-map" class="w-full shadow h-72"></div>
    </div>
</div>

<script>
document.addEventListener('livewire:load', function () {
    var leafletMap = L.map('leaflet-map', {
        center: [{{ $museum->lat }}, {{ $museum->lon }}],
        zoom: 14,
        zoomControl: false
    });

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(leafletMap);

    L.marker([{{ $museum->lat }}, {{ $museum->lon }}]).addTo(leafletMap);
})
</script>
