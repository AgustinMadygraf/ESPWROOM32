<?php
// src/Services/ConfigChecker.php

namespace App\Services;

class ConfigChecker
{
    private string $path;

    public function __construct(string $path)
    {
        $this->path = $path;
    }

    public function check(): bool
    {
        return file_exists($this->path);
    }
}
