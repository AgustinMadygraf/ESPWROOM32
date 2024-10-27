<!-- automatizacion/assets/js/components/DataFetcher.vue -->
<template>
    <div>
        <p id="balanza-value">{{ balanza }} kg</p>
        <p id="contador-value">{{ contador }}</p>
        <p v-if="errorMessage">{{ errorMessage }}</p>
    </div>
</template>

<script>
import { ref, onMounted, onBeforeUnmount } from 'vue';

export default {
    name: 'DataFetcher',
    setup() {
        const balanza = ref("Cargando...");
        const contador = ref("Cargando...");
        const errorMessage = ref(null);
        let intervalId = null;

        const fetchData = () => {
            fetch('/automatizacion/get_data')
                .then(response => {
                    if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);
                    return response.json();
                })
                .then(responseData => {
                    if (responseData.error) {
                        if (responseData.redirect) {
                            window.location.href = responseData.redirect;
                        } else {
                            errorMessage.value = responseData.message;
                        }
                        return;
                    }

                    balanza.value = `${parseFloat(responseData.data.balanza).toFixed(2)} kg`;
                    contador.value = responseData.data.contador;

                    if (!intervalId) {
                        intervalId = setInterval(fetchData, 1000);
                    }
                })
                .catch(error => {
                    console.error("Error capturado:", error.message);
                    balanza.value = "Error de conexión";
                    contador.value = "Error de conexión";
                    errorMessage.value = error.message;

                    if (intervalId) {
                        clearInterval(intervalId);
                        intervalId = null;
                    }
                });
        };

        onMounted(fetchData);
        onBeforeUnmount(() => {
            if (intervalId) clearInterval(intervalId);
        });

        return {
            balanza,
            contador,
            errorMessage
        };
    }
};
</script>

<style scoped>
/* Añadir estilos personalizados aquí */
</style>