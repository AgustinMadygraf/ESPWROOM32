<?php
// automatizacion/app/services/DatabaseConnection.php

require_once '../../vendor/autoload.php';

use Dotenv\Dotenv;

class DatabaseConnection
{
    private $connection;

    public function __construct()
    {
        // Cargar variables de entorno desde el archivo .env
        $dotenv = Dotenv::createImmutable(__DIR__ . '/../../');
        $dotenv->load();

        // Configuración de conexión con variables de entorno
        $host = $_ENV['DB_HOST'];
        $username = $_ENV['DB_USERNAME'];
        $password = $_ENV['DB_PASSWORD'];
        $database = $_ENV['DB_DATABASE'];

        // Establecer conexión con la base de datos
        $this->connection = new mysqli($host, $username, $password, $database);

        // Verificar si hubo un error de conexión
        if ($this->connection->connect_error) {
            throw new Exception("Conexión fallida a la base de datos: " . $this->connection->connect_error);
        }
    }

    /**
     * Devuelve la conexión de base de datos.
     *
     * @return mysqli La conexión activa.
     */
    public function getConnection(): mysqli
    {
        return $this->connection;
    }

    /**
     * Cierra la conexión de base de datos.
     */
    public function close()
    {
        if ($this->connection) {
            $this->connection->close();
        }
    }
}
