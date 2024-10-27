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
                if (responseData.redirect) {
                    window.location.href = responseData.redirect;
                } else {
                    console.error(responseData.message);
                }
                return;
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

fetchData();