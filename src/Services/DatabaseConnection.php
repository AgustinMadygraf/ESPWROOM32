<?php
// src/Services/DatabaseConnection.php

namespace App\Services;

use PDO;
use Exception;

class DatabaseConnection
{
    private ?PDO $connection = null;

    public function getConnection(): PDO
    {
        if ($this->connection === null) {
            try {
                $dsn = "mysql:host=localhost;dbname=tu_base_de_datos"; // Ajusta el DSN según tus necesidades
                $username = "tu_usuario";
                $password = "tu_contraseña";
                
                // Crear una nueva conexión PDO
                $this->connection = new PDO($dsn, $username, $password);
                $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (Exception $e) {
                throw new Exception("Error al conectar con la base de datos: " . $e->getMessage());
            }
        }

        return $this->connection;
    }

    public function close(): void
    {
        $this->connection = null;
    }
}
