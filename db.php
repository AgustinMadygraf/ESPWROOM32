<?php
// db.php
$servername = "localhost";
$username = "root"; // Cambia esto por tu usuario de MySQL
$password = "12345678"; // Cambia esto por tu contraseña de MySQL
$dbname = "esp32"; // Nombre de la base de datos

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>