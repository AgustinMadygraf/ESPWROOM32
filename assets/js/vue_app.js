// assets/js/vue_app.js
import { createApp } from 'vue';

document.addEventListener('DOMContentLoaded', () => {
    const app = createApp({
        data() {
            return {
                message: '¡Hola desde Vue en Symfony!'
            };
        },
        template: `<div>{{ message }}</div>`
    });

    app.mount('#app');
});