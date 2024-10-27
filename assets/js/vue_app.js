import { createApp } from 'vue';
import DataFetcher from './components/DataFetcher.vue';

document.addEventListener('DOMContentLoaded', () => {
    const appContainer = document.getElementById('app');

    // Verifica y desmonta cualquier instancia previa de Vue
    if (appContainer.__vue_app__) {
        appContainer.__vue_app__.unmount();
    }

    // Crea la aplicación Vue con el componente DataFetcher
    const app = createApp({
        components: {
            DataFetcher
        },
        template: `<DataFetcher />`
    });

    // Guarda la instancia para futuras verificaciones
    appContainer.__vue_app__ = app;
    app.mount('#app');
});
