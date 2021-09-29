require('./bootstrap');

import Alpine from 'alpinejs';

/* Leaflet */
import 'leaflet/dist/leaflet-src.js'
import 'leaflet-ajax/dist/leaflet.ajax.js'
import 'leaflet.locatecontrol/dist/L.Control.Locate.min.js'

window.Alpine = Alpine;

Alpine.start();
