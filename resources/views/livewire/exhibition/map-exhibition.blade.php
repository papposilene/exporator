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
    var with_past_exhibition = L.layerGroup();
    var pastMarker = L.ExtraMarkers.icon({
        icon: 'fa-landmark',
        markerColor: 'red',
        shape: 'square',
        prefix: 'fas'
    });

    var with_current_exhibition = L.layerGroup();
    var currentMarker = L.ExtraMarkers.icon({
        icon: 'fa-landmark',
        markerColor: 'green',
        shape: 'square',
        prefix: 'fas'
    });

    var with_future_exhibition = L.layerGroup();
    var futureMarker = L.ExtraMarkers.icon({
        icon: 'fa-landmark',
        markerColor: 'blue',
        shape: 'square',
        prefix: 'fas'
    });

    var without_exhibition = L.layerGroup();
    var withoutMarker = L.ExtraMarkers.icon({
        icon: 'fa-landmark',
        markerColor: 'black',
        shape: 'square',
        prefix: 'fas'
    });

    var overlayMaps = {
        "@ucfirst(__('app.with_past_exhibition'))": with_past_exhibition,
        "@ucfirst(__('app.with_current_exhibition'))": with_current_exhibition,
        "@ucfirst(__('app.with_future_exhibition'))": with_future_exhibition,
        "@ucfirst(__('app.without_exhibition'))": without_exhibition
    };

    var leafletMap = L.map('leaflet-map', {
        center: [48.8635, 2.354],
        zoom: 2.5,
        layers: [
            with_past_exhibition,
            with_current_exhibition,
            with_future_exhibition,
            without_exhibition
        ]
    });

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(leafletMap);

    axios.get("{{ route('api.museum.geojson') }}")
        .then(response => {
            geoJson = { ...response.data.features };
            for (let feature in geoJson) {
                const museum = geoJson[feature];
                const lat = museum.geometry.coordinates[1];
                const lng = museum.geometry.coordinates[0];
                const name = museum.properties.name;
                const address = museum.properties.address;
                const popupContent = `<h5 class="font-medium text-lg">${name}</h5><br />
                          ${address}`;
                const exhibition_past = museum.properties.exhibitions.past;
                const exhibition_current = museum.properties.exhibitions.present;
                const exhibition_future = museum.properties.exhibitions.future;
                if (exhibition_current > 0) {
                    L.marker([lat, lng], {icon: currentMarker})
                        .bindPopup(popupContent)
                        .addTo(with_current_exhibition);
                }
                if (exhibition_past > 0) {
                    L.marker([lat, lng], {icon: pastMarker})
                        .bindPopup(popupContent)
                        .addTo(with_past_exhibition);
                }
                if (exhibition_future > 0) {
                    L.marker([lat, lng], {icon: futureMarker})
                        .bindPopup(popupContent)
                        .addTo(with_future_exhibition);
                }
            }
        })
        .catch(error => {
            console.log(error)
            this.errored = true
        })
        .finally(() => this.loading = false);

    L.control.layers(null, overlayMaps, { collapsed: false }).addTo(leafletMap);
    L.control.locate({
        flyTo: true,
        icon: 'fas fa-map-marker',
        iconLoading: 'fas fa-spinner fa-spin',
        strings: {
            title: "@ucfirst(__('app.geolocate'))"
        }
    }).addTo(leafletMap);
})
</script>
