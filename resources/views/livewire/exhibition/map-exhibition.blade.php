<div id="leaflet-map" class="h-screen w-full"></div>

<script>
function is_open(feature) {
    switch (feature.properties.status) {
        case 'close': return {color: "#000000"};
    }
}

function has_exhibition(feature) {
    if (feature.properties.exhibitions.present > 0) {
        return {color: "#000000"};
    }
    else {
        return {color: "#ff0000"};
    }
}

document.addEventListener('livewire:load', function () {
    var leafletMap = L.map('leaflet-map').setView([48.8635, 2.354], 2.5);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(leafletMap);

    //var geojsonLayer = new L.GeoJSON.AJAX("{{ route('api.museum.geojson') }}").addTo(leafletMap);

    L.Util.ajax("{{ route('api.museum.geojson') }}").then(function(data){
        is_open(data);
        has_exhibition(data);
    });

    L.control.locate({
        flyTo: true,
        icon: 'fas fa-map-marker',
        iconLoading: 'fas fa-spinner fa-spin',
        strings: {
            title: "@ucfirst(__('app.mapGeolocate'))"
        }
    }).addTo(leafletMap);
})
</script>
