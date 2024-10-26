<?php
// automatizacion/app/models/db.php

require_once '../../vendor/autoload.php';

use Dotenv\Dotenv;

try {
    // Ruta correcta a la raíz del proyecto
    $dotenvPath = dirname(__DIR__, 2); // Esto apunta a la raíz "C:\AppServ\www\automatizacion"
    $expectedEnvPath = $dotenvPath . '/.env';

    if (!file_exists($expectedEnvPath)) {
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

    // Probar conexión inicial al servidor MySQL sin especificar base de datos para verificar credenciales
    $conn = new mysqli($servername, $username, $password);
    if ($conn->connect_error) {
        throw new Exception("Conexión fallida al servidor MySQL: " . $conn->connect_error . ". Verifica que el host, usuario y contraseña en .env son correctos.");
    }

    // Verificar si la base de datos existe
    $db_selected = $conn->select_db($database);
    if (!$db_selected) {
        throw new Exception("La base de datos '{$database}' no existe o no es accesible. Verifica que el nombre de la base de datos en .env sea correcto y que tengas permisos para acceder a ella.");
    }

    // Cerrar y abrir nuevamente la conexión, ahora especificando la base de datos
    $conn->close();
    $conn = new mysqli($servername, $username, $password, $database);

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
