// automatizacion/assets/js/app.js
import { createApp } from 'vue';
import DataFetcher from './components/DataFetcher.vue';

const app = createApp({});
app.component('DataFetcher', DataFetcher);
app.mount('#app');