// automatizacion/public/js/script.js

let intervalId;
function fetchData() {
    fetch('/automatizacion/get_data')
        .then(response => response.json())
        .then(data => {
            if (!data.error) {
                document.getElementById('balanza-value').textContent = data.data.balanza;
                document.getElementById('contador-value').textContent = data.data.contador;
            } else {
                console.error('Error al obtener los datos:', data.message);
            }
        })
        .catch(error => console.error('Error en la solicitud:', error));
}

// Llama a fetchData inmediatamente para cargar los datos al inicio
fetchData();
intervalId = setInterval(fetchData, 5000); // Actualiza los datos cada 5 segundos