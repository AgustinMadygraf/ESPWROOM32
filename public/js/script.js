// automatizacion/public/js/script.js (rama sympony)

let intervalId;

function fetchData() {
    fetch('/automatizacion/get_data')
        .then(response => {
            if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);
            return response.json();
        })
        .then(responseData => {
            if (responseData.error) {
                if (responseData.details && responseData.details.includes(".env")) {
                    console.log("Redireccionando a setup/install.php debido a falta de .env");
                    window.location.href = '/automatizacion/setup/install.php';
                    return;
                }
                throw new Error(`Error fetching data: ${responseData.message}`);
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
