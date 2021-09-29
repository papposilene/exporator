require('./bootstrap');

/* AlpineJS */
import Alpine from 'alpinejs';

/* amCharts */
import am4core from '@amcharts/amcharts4/core.js';
import am4charts from '@amcharts/amcharts4/charts.js';
import am4plugins_timeline from '@amcharts/amcharts4/plugins/timeline.d.ts';
import am4themes_animated from '@amcharts/amcharts4/themes/animated.js';

/* Leaflet */
import 'leaflet/dist/leaflet-src.js'
import 'leaflet-ajax/dist/leaflet.ajax.js'
import 'leaflet.locatecontrol/dist/L.Control.Locate.min.js'

window.Alpine = Alpine;

Alpine.start();
