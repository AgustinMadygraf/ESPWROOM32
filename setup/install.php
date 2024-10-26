<?php
// setup/install.php

require_once '../vendor/autoload.php';

use Dotenv\Dotenv;

$dotenvPath = dirname(__DIR__);

// Verificar si el archivo .env ya existe
$envFilePath = $dotenvPath . '/.env';
if (file_exists($envFilePath)) {
    echo "El archivo .env ya existe. Si deseas volver a configurarlo, elimina o renombra el archivo actual.";
    exit();
}

// Verificar si el formulario fue enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recoger datos del formulario
    $dbHost = $_POST['DB_HOST'] ?? 'localhost';
    $dbUsername = $_POST['DB_USERNAME'] ?? '';
    $dbPassword = $_POST['DB_PASSWORD'] ?? '';
    $dbDatabase = $_POST['DB_DATABASE'] ?? '';

    // Validar que todos los campos estén completos
    if (empty($dbHost) || empty($dbUsername) || empty($dbDatabase)) {
        echo "Por favor, completa todos los campos requeridos.";
        exit();
    }

    // Crear el contenido del archivo .env
    $envContent = "DB_HOST={$dbHost}\nDB_USERNAME={$dbUsername}\nDB_PASSWORD={$dbPassword}\nDB_DATABASE={$dbDatabase}\n";

    // Guardar el archivo .env
    file_put_contents($envFilePath, $envContent);
    echo "Archivo .env creado exitosamente.<br>";

    // Intentar conexión y crear la base de datos
    try {
        $conn = new mysqli($dbHost, $dbUsername, $dbPassword);
        if ($conn->connect_error) {
            throw new Exception("Conexión fallida: " . $conn->connect_error);
        }

        // Crear la base de datos si no existe
        $query = "CREATE DATABASE IF NOT EXISTS `{$dbDatabase}`";
        if ($conn->query($query) === TRUE) {
            echo "Base de datos '{$dbDatabase}' creada exitosamente o ya existente.<br>";
        } else {
            throw new Exception("Error al crear la base de datos: " . $conn->error);
        }

        // Seleccionar la base de datos
        $conn->select_db($dbDatabase);

        // Crear la tabla measurements si no existe
        $createTableQuery = "
        CREATE TABLE IF NOT EXISTS `measurements` (
          `id` int(11) NOT NULL AUTO_INCREMENT,
          `balanza` float NOT NULL,
          `contador` int(11) NOT NULL,
          `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
          PRIMARY KEY (`id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
        ";

        if ($conn->query($createTableQuery) === TRUE) {
            echo "Tabla 'measurements' creada exitosamente o ya existente.<br>";
        } else {
            throw new Exception("Error al crear la tabla 'measurements': " . $conn->error);
        }

        // Insertar un registro inicial con la hora actual
        $insertInitialRecordQuery = "
        INSERT INTO `measurements` (`balanza`, `contador`, `timestamp`) VALUES (0, 0, NOW());
        ";

        if ($conn->query($insertInitialRecordQuery) === TRUE) {
            echo "Registro inicial insertado exitosamente en 'measurements' con la hora actual.<br>";
        } else {
            throw new Exception("Error al insertar el registro inicial en 'measurements': " . $conn->error);
        }

        $conn->close();
        echo "Configuración completada con éxito. Elimina este archivo por seguridad.";
        header("refresh:5;url=../index.php");
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
        exit();
    }

    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instalación del Sistema</title>
</head>
<body>
    <h1>Instalación del Sistema</h1>
    <form method="POST" action="">
        <label for="DB_HOST">DB_HOST:</label>
        <input type="text" name="DB_HOST" value="localhost" required><br><br>

        <label for="DB_USERNAME">DB_USERNAME:</label>
        <input type="text" name="DB_USERNAME" required><br><br>

        <label for="DB_PASSWORD">DB_PASSWORD:</label>
        <input type="password" name="DB_PASSWORD"><br><br>

        <label for="DB_DATABASE">DB_DATABASE:</label>
        <input type="text" name="DB_DATABASE" required><br><br>

        <input type="submit" value="Instalar">
    </form>
</body>
</html>
