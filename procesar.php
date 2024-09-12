<?php
require '../vendor/autoload.php'; // Cargar Composer y phpdotenv
include 'app/models/db.php';
ECHO "Carga de datos<br>";
// Verificar si los parámetros están presentes
if (isset($_GET['balanza']) && isset($_GET['contador'])) {
    $balanza = $_GET['balanza'];
    $contador = $_GET['contador'];
    // Preparar y ejecutar la consulta SQL
    $sql = "INSERT INTO measurements (balanza, contador) VALUES ('$balanza', '$contador')";
    if ($conn->query($sql) === TRUE) {
        echo "Datos insertados correctamente<br>";
        echo "Balanza: $balanza<br>";
        echo "Contador: $contador";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "Faltan parámetros";
}
// Cerrar conexión
$conn->close();