<?php
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

// Consultar el último valor de la balanza y el contador
$sql = "SELECT balanza, contador FROM measurements ORDER BY id DESC LIMIT 1";
$result = $conn->query($sql);

$data = array();
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $data['balanza'] = $row['balanza'];
    $data['contador'] = $row['contador'];
} else {
    $data['balanza'] = 0;
    $data['contador'] = 0;
}

$conn->close();

// Devolver los datos en formato JSON
header('Content-Type: application/json');
echo json_encode($data);
?>