<?php
// automatizacion/app/services/DataFetcher.php

class DataFetcher
{
    private $connection;

    public function __construct(mysqli $connection)
    {
        $this->connection = $connection;
    }

    /**
     * Ejecuta la consulta SQL para obtener los datos más recientes de la base de datos.
     *
     * @return array Un arreglo con los datos 'balanza' y 'contador'.
     * @throws Exception Si ocurre un error en la consulta.
     */
    public function fetchLatestData(): array
    {
        $sql = "SELECT balanza, contador FROM dm_measurements ORDER BY id DESC LIMIT 1";
        $result = $this->connection->query($sql);

        if ($result === false) {
            throw new Exception("Error en la consulta SQL: " . $this->connection->error);
        }

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $data = [
                'balanza' => (float) $row['balanza'],
                'contador' => (int) $row['contador']
            ];
        } else {
            $data = [
                'balanza' => 0.0,
                'contador' => 0
            ];
        }

        $result->free();
        return $data;
    }
}
