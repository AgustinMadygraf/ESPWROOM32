// assets/app.js
import 'bootstrap';
import './css/global.scss'; // Importa el archivo global de estilos
import './js/vue_app.js'; // Importa tu aplicación Vue
import { createApp } from 'vue';
import DataFetcher from './components/DataFetcher.vue';

createApp({
    components: {
        DataFetcher
    }
}).mount('#app');