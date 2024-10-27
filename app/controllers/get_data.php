<?php
// automatizacion/app/controllers/get_data.php

// Establece un nivel de error que solo reporta errores críticos
error_reporting(E_ERROR | E_PARSE);
ob_start(); // Captura toda la salida, incluso advertencias

require_once '../../vendor/autoload.php';
include '../services/DatabaseConnection.php';
include '../services/ConfigChecker.php';
include '../services/DataFetcher.php';

// Configuración para registrar errores en un archivo de log
ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '/../../logs/error_log.txt'); // Ruta del log (asegúrate de que 'logs' tenga permisos de escritura)

// Configuración temporal para mostrar errores en pantalla (solo para desarrollo)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

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

    // Crear una instancia de DataFetcher y obtener los datos
    $dataFetcher = new DataFetcher($conn);
    $data = $dataFetcher->fetchLatestData();

    $dbConnection->close(); // Cierra la conexión usando el método close()

    ob_end_clean(); // Limpiar el buffer antes de la salida JSON
    echo json_encode(['error' => false, 'data' => $data]);

} catch (Exception $e) {
    ob_end_clean(); // Limpiar el buffer si ocurre un error

    // Registrar el mensaje detallado del error en el archivo de log
    error_log("Error en get_data.php: " . $e->getMessage());

    // Enviar detalles del error en la respuesta JSON (para desarrollo)
    echo json_encode([
        'error' => true,
        'message' => 'Se ha producido un error al obtener los datos.',
        'details' => [
            'errorMessage' => $e->getMessage(),
            'trace' => $e->getTraceAsString() // Agrega el stack trace para mayor contexto
        ]
    ]);
    exit();
}
