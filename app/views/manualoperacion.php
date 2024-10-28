<?php
// app/views/mantenimiento.php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require 'header.php';

// Verificar si el archivo autoload.php existe
if (!file_exists('../../vendor/autoload.php')) {
    die('Error: No se encontró el archivo autoload.php');
}

require '../../vendor/autoload.php';

$parsedown = new Parsedown();

// Verificar si el archivo mantenimiento.md existe
if (!file_exists('../../docs/ZD-FJ13+t.md')) {
    die('Error: No se encontró el archivo mantenimiento.md');
}

$markdownContent = file_get_contents('../../docs/ZD-FJ13+t.md');
$htmlContent = $parsedown->text($markdownContent);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plan de Mantenimiento</title>
    <link rel="stylesheet" href="../../public/css/mantenimiento.css">
</head>
<body>
    <header>
        <h1>Plan de Mantenimiento</h1>
    </header>
    <main>
        <?= $htmlContent ?>
    </main>
    <footer>
        <p>© 2024 madygraf</p>
    </footer>
</body>
</html>