<?php
// automatizacion/app/controllers/get_data.php

require_once '../../vendor/autoload.php';
include '../models/db.php';

header('Content-Type: application/json'); // Aseguramos que la salida será JSON

try {
    // Verificar si el archivo .env existe
    $envPath = '../../.env';
    if (!file_exists($envPath)) {
        // Enviar un mensaje de error específico cuando falta el archivo .env
        echo json_encode([
            'error' => true,
            'message' => 'Falta el archivo de configuración',
            'details' => 'El archivo .env no se encuentra en la ruta esperada. Redirigiendo a la instalación.'
        ]);
        exit();
    }

    // Conexión a la base de datos realizada en db.php
    if ($conn->connect_error) {
        throw new Exception("Conexión fallida a la base de datos: " . $conn->connect_error);
    }

    // Consultar el último valor de la balanza y el contador
    $sql = "SELECT balanza, contador FROM measurements ORDER BY id DESC LIMIT 1";
    $result = $conn->query($sql);

    if ($result === false) {
        throw new Exception("Error en la consulta SQL: " . $conn->error);
    }

    // Comprobar si hay resultados y devolver datos o mensaje de vacío
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $data = [
            'balanza' => (float) $row['balanza'],
            'contador' => (int) $row['contador']
        ];
    } else {
        $data = [
            'balanza' => 0.0,
            'contador' => 0
        ];
    }

    $result->free();
    $conn->close();

    echo json_encode(['error' => false, 'data' => $data]);

} catch (Exception $e) {
    echo json_encode([
        'error' => true,
        'message' => 'Se ha producido un error al obtener los datos.',
        'details' => $e->getMessage()
    ]);
    exit();
}
