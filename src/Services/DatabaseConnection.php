<?php
// src/Services/DatabaseConnection.php

namespace App\Services;

use PDO;
use PDOException;

class DatabaseConnection
{
    private $connection;

    public function __construct()
    {
        try {
            $this->connection = new PDO(
                'mysql:
                host=localhost;
                dbname=esp32',
                'root',
                '12345678',
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                ]
            );
        } catch (PDOException $e) {
            throw new \Exception("Error de conexión: " . $e->getMessage());
        }
    }

    public function getConnection(): PDO
    {
        return $this->connection;
    }

    public function close(): void
    {
        $this->connection = null;
    }
}
