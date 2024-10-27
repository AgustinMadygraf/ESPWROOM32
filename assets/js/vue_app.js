// assets/js/vue_app.js
import { createApp } from 'vue';

const app = createApp({
    data() {
        return {
            message: "Hello Vue with Symfony!"
        };
    }
});

app.mount('#app');
