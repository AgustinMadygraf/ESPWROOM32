<?php
//procesar.php
$servername = "localhost"; // Cambia esto si tu servidor MySQL está en otro host
$username = "root"; // Cambia esto por tu usuario de MySQL
$password = "12345678"; // Cambia esto por tu contraseña de MySQL
$dbname = "esp32"; // Nombre de la base de datos

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Verificar si los parámetros están presentes
if (isset($_GET['balanza']) && isset($_GET['contador'])) {
    $balanza = $_GET['balanza'];
    $contador = $_GET['contador'];

    // Preparar y ejecutar la consulta SQL
    $sql = "INSERT INTO measurements (balanza, contador) VALUES ('$balanza', '$contador')";

    if ($conn->query($sql) === TRUE) {
        echo "Datos insertados correctamente";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "Faltan parámetros";
}

// Cerrar conexión
$conn->close();
?>