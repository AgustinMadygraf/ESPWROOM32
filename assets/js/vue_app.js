// assets/js/vue_app.js
import { createApp } from 'vue';

document.addEventListener('DOMContentLoaded', () => {
    const appContainer = document.getElementById('app');

    // Verifica y desmonta cualquier instancia previa de Vue
    if (appContainer.__vue_app__) {
        appContainer.__vue_app__.unmount();
    }

    const app = createApp({
        data() {
            return {
                message: '¡Hola desde Vue en Symfony!'
            };
        },
        template: `<div>{{ message }}</div>`
    });

    // Guarda la instancia para futuras verificaciones
    appContainer.__vue_app__ = app;
    app.mount('#app');
});
