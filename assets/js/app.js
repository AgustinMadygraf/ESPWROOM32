// assets/js/app.js
import { createApp } from 'vue';

const app = createApp({
    data() {
        return {
            message: 'Hello from Vue!'
        };
    },
    mounted() {
        console.log('Vue app mounted!');
    }
});

app.mount('#app');
