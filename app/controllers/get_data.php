<?php
// automatizacion/get_data.php
require '../../../vendor/autoload.php'; // Cargar Composer y phpdotenv
include '../models/db.php';

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