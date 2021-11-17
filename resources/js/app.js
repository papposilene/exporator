require('./bootstrap');

/* AlpineJS */
import Alpine from 'alpinejs';

/* FontAwesome */
import '@fortawesome/fontawesome-free/js/fontawesome';
import '@fortawesome/fontawesome-free/js/solid';
import '@fortawesome/fontawesome-free/js/regular';
import '@fortawesome/fontawesome-free/js/brands';

/* ChartJS */
import 'chart.js/dist/chart.js';

/* Leaflet */
import 'leaflet/dist/leaflet-src.js';
import 'leaflet-ajax/dist/leaflet.ajax.js';
import 'leaflet-extra-markers/dist/js/leaflet.extra-markers.js';
import 'leaflet.locatecontrol/dist/L.Control.Locate.min.js';

// Datepicker
import '@themesberg/flowbite/dist/datepicker.bundle.js';
import '@themesberg/tailwind-datepicker';

window.Alpine = Alpine;
Alpine.start();
