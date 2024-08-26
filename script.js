function fetchData() {
    fetch('get_data.php')
        .then(response => response.json())
        .then(data => {
            document.getElementById('balanza-value').innerText = `${parseFloat(data.balanza).toFixed(2)} kg`;
            document.getElementById('contador-value').innerText = data.contador;
        })
        .catch(error => console.error('Error fetching data:', error));
}

// Llama a fetchData cada segundo
setInterval(fetchData, 1000);

// Llama a fetchData inmediatamente para cargar los datos al inicio
fetchData();