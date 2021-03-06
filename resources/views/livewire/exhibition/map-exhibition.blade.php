@section('title', @ucfirst(__('app.map_of', ['what' => __('app.exhibitions')])))

<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-bluegray-800 dark:text-bluegray-100 leading-tight">
            <span>@ucfirst(__('app.map_of', ['what' => __('app.exhibitions')]))</span>
        </h2>
    </x-slot>

    <div>
        <!--div class="flex max-w-7xl mx-auto py-5 px-6"-->
        <div class="flex">
            <div id="leaflet-map" class="w-full shadow" style="height: 100vw; max-height: 650px; position: relative;"></div>
        </div>
    </div>
</div>

<script>
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
        "<span class='font-bold text-red-700'>@ucfirst(__('app.with_past_exhibition'))</span>": with_past_exhibition,
        "<span class='font-bold text-green-700'>@ucfirst(__('app.with_current_exhibition'))</span>": with_current_exhibition,
        "<span class='font-bold text-sky-700'>@ucfirst(__('app.with_future_exhibition'))</span>": with_future_exhibition,
        "<span class='font-bold text-black'>@ucfirst(__('app.without_exhibition'))</span>": without_exhibition
    };

    var leafletMap = L.map('leaflet-map', {
        center: [48.8635, 2.354],
        zoom: 11,
        layers: [
            with_current_exhibition
        ]
    });

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(leafletMap);

    axios.get("{{ route('api.place.geojson') }}")
        .then(response => {
            geoJson = { ...response.data.features };
            for (let feature in geoJson) {
                const place = geoJson[feature];
                const lat = place.geometry.coordinates[1];
                const lng = place.geometry.coordinates[0];
                const name = place.properties.name;
                const address = place.properties.address;
                const url = place.properties.url;
                const popupContent = `<h5 class="font-medium text-lg">${name}</h5><br />
                          ${address}<br /><br />
                          <a href="${url}" class="my-2">@ucfirst(__('app.list_of', ['what' => __('app.exhibitions')]))...</a>`;
                const exhibition_past = place.properties.exhibitions.past;
                const exhibition_current = place.properties.exhibitions.present;
                const exhibition_future = place.properties.exhibitions.future;
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
                if (exhibition_past === 0 && exhibition_current === 0 && exhibition_future === 0) {
                    L.marker([lat, lng], {icon: withoutMarker})
                        .bindPopup(popupContent)
                        .addTo(without_exhibition);
                }
            }
        })
        .catch(error => {
            console.log(error)
            this.errored = true
        })
        .finally(() => this.loading = false);

    L.control.layers(null, overlayMaps).addTo(leafletMap);
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
