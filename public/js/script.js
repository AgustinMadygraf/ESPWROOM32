// automatizacion/public/js/script.js

let intervalId;

function fetchData() {
    fetch('/automatizacion/app/controllers/get_data_2.php')
        .then(response => {
            const status = response.status;
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${status}`);
            }
            return response.text().then(text => {
                if (text === "") {
                    throw new Error("La respuesta está vacía.");
                }
                try {
                    const data = JSON.parse(text);
                    // Unificar todos los mensajes en un solo log
                    console.log(`Respuesta completa:
                        Estado: ${status},
                        Texto de respuesta: ${text},
                        Datos recibidos:`, data);
                    return data;
                } catch (e) {
                    throw new Error("Error de formato JSON en la respuesta.");
                }
            });
        })
        .then(responseData => {
            if (responseData.error) {
                if (responseData.details && responseData.details.includes(".env")) {
                    console.log("Redireccionando a setup/install.php debido a falta de .env");
                    window.location.href = '/automatizacion/setup/install.php';
                    return;
                }
                throw new Error(`Error fetching data: ${responseData.message} - Detalles: ${responseData.details || "No hay detalles adicionales"}`);
            }

            const data = responseData.data;
            document.getElementById('balanza-value').innerText = `${parseFloat(data.balanza).toFixed(2)} kg`;
            document.getElementById('contador-value').innerText = data.contador;

            if (!intervalId) {
                intervalId = setInterval(fetchData, 1000);
            }
        })
        .catch(error => {
            console.error("Error capturado:", error.message);
            document.getElementById('balanza-value').innerText = "Error de conexión";
            document.getElementById('contador-value').innerText = "Error de conexión";

            if (intervalId) {
                clearInterval(intervalId);
                intervalId = null;
            }
        });
}

// Llama a fetchData inmediatamente para cargar los datos al inicio
fetchData();
