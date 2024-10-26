// automatizacion/public/js/script.js
function fetchData() {
    fetch('/automatizacion/app/controllers/get_data.php')
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            if (data.error) {
                console.error('Error fetching data:', data.message);
                // Opcional: mostrar el error en la interfaz de usuario
                document.getElementById('balanza-value').innerText = "Error al cargar";
                document.getElementById('contador-value').innerText = "Error al cargar";
                
                // Mostrar detalles del error en la consola para depuración
                if (data.details) {
                    console.error('Detalles del error:', data.details);
                }
                return;
            }
            
            // Si no hay errores, muestra los datos
            document.getElementById('balanza-value').innerText = `${parseFloat(data.balanza).toFixed(2)} kg`;
            document.getElementById('contador-value').innerText = data.contador;
        })
        .catch(error => {
            console.error('Error fetching data:', error);
            // Mostrar un mensaje de error en la interfaz de usuario si la conexión falla
            document.getElementById('balanza-value').innerText = "Error de conexión";
            document.getElementById('contador-value').innerText = "Error de conexión";
        });
}

// Llama a fetchData cada segundo
setInterval(fetchData, 1000);

// Llama a fetchData inmediatamente para cargar los datos al inicio
fetchData();
