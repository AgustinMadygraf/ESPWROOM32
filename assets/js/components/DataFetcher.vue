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
        console.log("DataFetcher component mounted");
        const balanza = ref("Cargando...");
        const contador = ref("Cargando...");
        const errorMessage = ref(null);
        let intervalId = null;

        const fetchData = () => {
            console.log("Ejecutando fetchData"); // Confirmación de ejecución

            fetch('/automatizacion/get_data')
                .then(response => {
                    console.log("Respuesta recibida:", response); // Ver el estado de la respuesta
                    if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);
                    return response.json();
                })
                .then(responseData => {
                    console.log("Datos recibidos:", responseData); // Mostrar los datos recibidos

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
                })
                .catch(error => {
                    console.error("Error capturado en fetchData:", error.message);
                    balanza.value = "Error de conexión";
                    contador.value = "Error de conexión";
                    errorMessage.value = error.message;
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