<?php
// automatizacion/app/models/db.php

require_once '../../vendor/autoload.php';

use Dotenv\Dotenv;

try {
    // Ruta al archivo .env
    $dotenvPath = realpath(__DIR__ . '/../../');
    $expectedEnvPath = $dotenvPath . '/.env';

    if ($dotenvPath === false || !file_exists($expectedEnvPath)) {
        throw new Exception("Error: El archivo de configuración .env no se encuentra en la ruta esperada: {$expectedEnvPath}. Asegúrate de que el archivo .env esté ubicado en la raíz del proyecto.");
    }

    // Cargar el archivo .env
    $dotenv = Dotenv::createImmutable($dotenvPath);
    $dotenv->load();

    // Verificar que las variables de entorno necesarias están definidas
    $requiredVars = ['DB_HOST', 'DB_USERNAME', 'DB_PASSWORD', 'DB_DATABASE'];
    foreach ($requiredVars as $var) {
        if (!isset($_ENV[$var]) || empty($_ENV[$var])) {
            throw new Exception("Error: La variable de entorno {$var} no está definida o está vacía en el archivo .env. Revisa que todas las variables necesarias estén correctamente configuradas.");
        }
    }

    // Conexión a la base de datos MySQL usando las variables de entorno
    $servername = $_ENV['DB_HOST'];
    $username = $_ENV['DB_USERNAME'];
    $password = $_ENV['DB_PASSWORD'];
    $database = $_ENV['DB_DATABASE'];

    $conn = new mysqli($servername, $username, $password, $database);

    // Verificar conexión
    if ($conn->connect_error) {
        throw new Exception("Conexión fallida a la base de datos: " . $conn->connect_error . ". Verifica que las credenciales en .env son correctas y que el servidor de base de datos está accesible.");
    }

} catch (Exception $e) {
    // Mostrar un mensaje de error detallado en JSON para facilitar la depuración
    header('Content-Type: application/json');
    echo json_encode([
        'error' => true,
        'message' => 'Error al conectar con la base de datos.',
        'details' => $e->getMessage()
    ]);
    exit();
}
