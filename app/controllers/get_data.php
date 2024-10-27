<?php
// automatizacion/app/controllers/get_data.php

// Establece un nivel de error que solo reporta errores críticos
error_reporting(E_ERROR | E_PARSE);
ob_start(); // Captura toda la salida, incluso advertencias

require_once '../../vendor/autoload.php';
include '../services/DatabaseConnection.php';
include '../services/ConfigChecker.php'; // Incluir la clase ConfigChecker

header('Content-Type: application/json'); // Asegura que la salida será JSON

try {
    // Instancia de ConfigChecker para verificar la existencia del archivo .env
    $configChecker = new ConfigChecker('../../.env');
    if (!$configChecker->check()) {
        ob_end_clean(); // Limpiar el buffer antes de la respuesta
        echo json_encode([
            'error' => true,
            'message' => 'Falta el archivo de configuración',
            'details' => 'El archivo .env no se encuentra en la ruta esperada. Redirigiendo a la instalación.'
        ]);
        exit();
    }

    // Establecer conexión a la base de datos usando DatabaseConnection
    $dbConnection = new DatabaseConnection();
    $conn = $dbConnection->getConnection();

    // Ejecutar consulta SQL
    $sql = "SELECT balanza, contador FROM dm_measurements ORDER BY id DESC LIMIT 1";
    $result = $conn->query($sql);

    if ($result === false) {
        throw new Exception("Error en la consulta SQL: " . $conn->error);
    }

    // Preparar datos para la respuesta JSON
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
    $dbConnection->close(); // Cierra la conexión usando el método close()

    ob_end_clean(); // Limpiar el buffer antes de la salida JSON
    echo json_encode(['error' => false, 'data' => $data]);

} catch (Exception $e) {
    ob_end_clean(); // Limpiar el buffer si ocurre un error
    echo json_encode([
        'error' => true,
        'message' => 'Se ha producido un error al obtener los datos.',
        'details' => $e->getMessage()
    ]);
    exit();
}
