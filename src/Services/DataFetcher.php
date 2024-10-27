<?php
// src/Services/DataFetcher.php

namespace App\Services;

use App\Services\DatabaseConnection;
use PDO;
use Exception;

class DataFetcher
{
    private DatabaseConnection $dbConnection;

    public function __construct(DatabaseConnection $dbConnection)
    {
        $this->dbConnection = $dbConnection;
    }

    /**
     * Fetches the latest data from the database.
     *
     * @return array The latest data including `balanza` and `contador` values.
     */
    public function fetchLatestData(): array
    {
        try {
            // Obtener la conexión a la base de datos
            $conn = $this->dbConnection->getConnection();

            // Consulta para obtener los datos (modifica según tu esquema)
            $query = "SELECT balanza, contador FROM datos ORDER BY id DESC LIMIT 1";
            $stmt = $conn->prepare($query);
            $stmt->execute();

            // Fetch data as an associative array
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            // Cerrar la conexión
            $this->dbConnection->close();

            return $result ?: ['balanza' => 0, 'contador' => 0]; // Valores predeterminados si no hay resultados
        } catch (Exception $e) {
            throw new Exception("Error al obtener los datos: " . $e->getMessage());
        }
    }
}
