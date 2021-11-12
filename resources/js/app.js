require('./bootstrap');

/* AlpineJS */
import Alpine from 'alpinejs';

/* FontAwesome */
import '@fortawesome/fontawesome-free/js/fontawesome'
import '@fortawesome/fontawesome-free/js/solid'
import '@fortawesome/fontawesome-free/js/regular'
import '@fortawesome/fontawesome-free/js/brands'

/* ChartJS */
import 'chart.js/dist/chart.js';

/* Leaflet */
import 'leaflet/dist/leaflet-src.js'
import 'leaflet-ajax/dist/leaflet.ajax.js'
import 'leaflet-extra-markers/dist/js/leaflet.extra-markers.js'
import 'leaflet.locatecontrol/dist/L.Control.Locate.min.js'

// TipTap
import { Editor } from '@tiptap/core'
import StarterKit from '@tiptap/starter-kit'

window.setupEditor = function(content) {
    return {
        editor: null,
        content: content,
        updatedAt: Date.now(), // force Alpine to rerender on selection change
        init(element) {
            this.editor = new Editor({
                element: element,
                extensions: [
                    StarterKit,
                ],
                content: this.content,
                onUpdate: ({ editor }) => {
                    this.content = editor.getHTML()
                },
                onSelectionUpdate: () => {
                    this.updatedAt = Date.now()
                },
            })
        },
    }
}


window.Alpine = Alpine;
Alpine.start();
