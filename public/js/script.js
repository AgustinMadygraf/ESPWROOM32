// automatizacion/public/js/script.js

let intervalId;

function fetchData() {
    fetch('/automatizacion/app/controllers/get_data.php')
        .then(response => {
            console.log("Respuesta recibida:", response.status);
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return response.text().then(text => {
                console.log("Texto de respuesta:", text);
                if (text === "") {
                    throw new Error("La respuesta está vacía.");
                }
                try {
                    return JSON.parse(text);
                } catch (e) {
                    throw new Error("Error de formato JSON en la respuesta.");
                }
            });
        })
        .then(responseData => {
            console.log("Datos recibidos:", responseData);
            if (responseData.error) {
                // Detecta cualquier mensaje de error que mencione ".env" y redirige
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
