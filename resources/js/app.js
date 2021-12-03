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

// Datepicker
import '@themesberg/flowbite/dist/datepicker.bundle.js';
import '@themesberg/tailwind-datepicker';

/* Leaflet */
import 'leaflet/dist/leaflet-src.js';
import 'leaflet-ajax/dist/leaflet.ajax.js';
import 'leaflet-extra-markers/dist/js/leaflet.extra-markers.js';
import 'leaflet.locatecontrol/dist/L.Control.Locate.min.js';

// Orejime
import 'orejime/dist/orejime.js';

window.Alpine = Alpine;
Alpine.start();

var orejimeConfig = {
    elementID: "exporator-orejime",
    appElement: "#exporator",
    cookieName: "exporator-orejime",
    cookieDomain: 'lexporateur.fr',
    privacyPolicy: "",
    lang: "fr",
    logo: false,
    debug: false,
    apps: [
        {
            name: "matomo",
            title: "Matomo Analytics",
            cookies: [
                "_pk_ref",
                "_pk_cvar",
                "_pk_id",
                "_pk_ses",
                "mtm_consent",
                "mtm_consent_removed",
                "mtm_cookie_consent",
                "matomo_ignore",
                "matomo_sessid",
                "_pk_hsr",
            ],
            purposes: ["analytics"],
        }
    ],
    categories: [
        {
            name: "analytics",
            title: "Analytics",
            apps: [
                "matomo",
            ]
        }
    ]
}

Orejime.init(orejimeConfig);
