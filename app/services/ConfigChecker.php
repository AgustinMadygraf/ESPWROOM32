<?php
// automatizacion/app/services/ConfigChecker.php

class ConfigChecker
{
    private $envPath;

    public function __construct($envPath)
    {
        $this->envPath = $envPath;
    }

    /**
     * Verifica la existencia del archivo .env.
     *
     * @return bool Devuelve true si el archivo existe, false si no.
     */
    public function check(): bool
    {
        return file_exists($this->envPath);
    }
}
