<?php
// automatizacion/app/controllers/get_data.php

require '../../vendor/autoload.php'; // Cargar Composer y phpdotenv

// Incluir archivo de base de datos con manejo de excepciones
try {
    // Verificar si el archivo .env existe
    $dotenvPath = __DIR__ . '/../../.env';
    if (!file_exists($dotenvPath)) {
        throw new Exception("El archivo de configuración .env no se encuentra en la ruta esperada: $dotenvPath");
    }
    
    // Cargar variables de entorno
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../../');
    $dotenv->load();
    
    // Incluir archivo de base de datos
    include '../models/db.php';
    
} catch (Exception $e) {
    // Mostrar un mensaje de error JSON amigable para el desarrollador
    header('Content-Type: application/json');
    echo json_encode([
        'error' => true,
        'message' => 'Error al cargar la configuración de la base de datos',
        'details' => $e->getMessage()
    ]);
    exit();
}

// Consultar el último valor de la balanza y el contador
$data = [];
try {
    $sql = "SELECT balanza, contador FROM measurements ORDER BY id DESC LIMIT 1";
    $result = $conn->query($sql);

    if ($result === false) {
        throw new Exception("Error en la consulta SQL: " . $conn->error);
    }

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $data['balanza'] = $row['balanza'];
        $data['contador'] = $row['contador'];
    } else {
        // Valores predeterminados si no hay resultados
        $data['balanza'] = 0;
        $data['contador'] = 0;
    }

    $conn->close();

} catch (Exception $e) {
    // Mostrar un mensaje de error JSON detallado para SQL
    header('Content-Type: application/json');
    echo json_encode([
        'error' => true,
        'message' => 'Error al realizar la consulta a la base de datos',
        'details' => $e->getMessage()
    ]);
    exit();
}

// Devolver los datos en formato JSON
header('Content-Type: application/json');
echo json_encode($data);
