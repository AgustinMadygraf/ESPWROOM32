// automatizacion/public/js/script.js
function fetchData() {
    fetch('/automatizacion/app/controllers/get_data.php')
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return response.text().then(text => {
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
            if (responseData.error) {
                throw new Error(`Error fetching data: ${responseData.message} - Detalles: ${responseData.details || "No hay detalles adicionales"}`);
            }

            // Acceso correcto a los datos anidados
            const data = responseData.data;
            document.getElementById('balanza-value').innerText = `${parseFloat(data.balanza).toFixed(2)} kg`;
            document.getElementById('contador-value').innerText = data.contador;
        })
        .catch(error => {
            // Unificar mensajes de error en una sola salida
            console.error(error.message);
            document.getElementById('balanza-value').innerText = "Error de conexión";
            document.getElementById('contador-value').innerText = "Error de conexión";
        });
}

// Llama a fetchData cada segundo
setInterval(fetchData, 1000);

// Llama a fetchData inmediatamente para cargar los datos al inicio
fetchData();
