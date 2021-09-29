require('./bootstrap');

/* AlpineJS */
import Alpine from 'alpinejs';

/* amCharts */
import * as am4core from '@amcharts/amcharts4/core';
import * as am4charts from '@amcharts/amcharts4/charts';
import * as am4plugins_timeline from '@amcharts/amcharts4/plugins/timeline';

/* Leaflet */
import 'leaflet/dist/leaflet-src.js'
import 'leaflet-ajax/dist/leaflet.ajax.js'
import 'leaflet.locatecontrol/dist/L.Control.Locate.min.js'

window.Alpine = Alpine;

Alpine.start();
