<?php
// automatizacion/app/controllers/get_data.php

require_once '../../vendor/autoload.php';
include '../models/db.php';

header('Content-Type: application/json'); // Aseguramos que la salida será JSON

try {
    // Conexión a la base de datos realizada en db.php
    // Verificar conexión global desde db.php
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
            'balanza' => (float) $row['balanza'], // Aseguramos el tipo de datos
            'contador' => (int) $row['contador']
        ];
    } else {
        // Si no hay datos, devolver valores predeterminados
        $data = [
            'balanza' => 0.0,
            'contador' => 0
        ];
    }

    // Liberar el resultado y cerrar la conexión
    $result->free();
    $conn->close();

    // Devolver los datos en formato JSON
    echo json_encode(['error' => false, 'data' => $data]);

} catch (Exception $e) {
    // Manejo de errores y devolución en JSON
    echo json_encode([
        'error' => true,
        'message' => 'Se ha producido un error al obtener los datos.',
        'details' => $e->getMessage()
    ]);
    exit();
}
