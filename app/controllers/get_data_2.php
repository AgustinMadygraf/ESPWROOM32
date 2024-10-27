<?php
// automatizacion/app/controllers/get_data_2.php

// Habilitar la captura de todos los errores durante el desarrollo
error_reporting(E_ALL);
ob_start(); // Captura toda la salida, incluyendo advertencias y errores

// Autoload de Composer y archivos necesarios
require_once '../../vendor/autoload.php';
include '../services/DatabaseConnection.php';
include '../services/ConfigChecker.php';
include '../services/DataFetcher.php';

// Configuración de registro de errores
ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '/../../logs/error_log.txt'); // Ruta para el log de errores
ini_set('display_errors', 1); // Muestra errores en pantalla para desarrollo
ini_set('display_startup_errors', 1);

header('Content-Type: application/json'); // Formato JSON para la salida

try {
    // Verificar existencia del archivo .env
    $configChecker = new ConfigChecker('../../.env');
    if (!$configChecker->check()) {
        // Si no se encuentra el archivo .env, devolver un mensaje de error claro
        respondWithError(
            'Falta el archivo de configuración',
            'El archivo .env no se encuentra en la ruta esperada. Redirigiendo a la instalación.'
        );
    }

    // Conectar a la base de datos
    $dbConnection = new DatabaseConnection();
    $conn = $dbConnection->getConnection();

    // Obtener los datos necesarios usando DataFetcher
    $dataFetcher = new DataFetcher($conn);
    $data = $dataFetcher->fetchLatestData();

    // Cerrar la conexión de base de datos
    $dbConnection->close();

    // Limpiar el buffer y responder con los datos en formato JSON
    ob_end_clean();
    echo json_encode(['error' => false, 'data' => $data]);

} catch (Exception $e) {
    // En caso de error, responder con un mensaje detallado
    ob_end_clean();
    error_log("Error en get_data_2.php: " . $e->getMessage());
    respondWithError('Se ha producido un error al obtener los datos.', [
        'errorMessage' => $e->getMessage(),
        'trace' => $e->getTraceAsString()
    ]);
}

/**
 * Función auxiliar para responder con un mensaje de error en formato JSON.
 *
 * @param string $message Mensaje de error simple.
 * @param mixed $details Información adicional sobre el error (opcional).
 */
function respondWithError($message, $details = null)
{
    echo json_encode([
        'error' => true,
        'message' => $message,
        'details' => $details
    ]);
    exit();
}
