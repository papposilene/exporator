require('./bootstrap');

/* AlpineJS */
import Alpine from 'alpinejs';

/* FontAwesome */
import '@fortawesome/fontawesome-free/js/fontawesome'
import '@fortawesome/fontawesome-free/js/solid'
import '@fortawesome/fontawesome-free/js/regular'
import '@fortawesome/fontawesome-free/js/brands'

import ApexCharts from 'apexcharts'

/* Calendar */
import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import timeGridPlugin from '@fullcalendar/timegrid';
import listPlugin from '@fullcalendar/list';

/* Leaflet */
import 'leaflet/dist/leaflet-src.js'
import 'leaflet-ajax/dist/leaflet.ajax.js'
import 'leaflet-extra-markers/dist/js/leaflet.extra-markers.js'
import 'leaflet.locatecontrol/dist/L.Control.Locate.min.js'

window.Alpine = Alpine;
Alpine.start();
