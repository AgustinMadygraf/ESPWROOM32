<?php
// automatizacion/includes/header.php

$paginaActual = basename($_SERVER['PHP_SELF']);
$claseActiva = "class='active'";

$navItems = [
    'app/views/index.php' => 'Inicio',
    'app/views/mantenimiento.php' => 'Mantenimiento',
    'app/views/electronica.php' => 'Electrónica',
    'app/views/sustentabilidad.php' => 'Sustentabilidad',
    'app/views/oee.php' => 'OEE',
    'app/views/manualoperacion.php' => 'Manual de Operación',
    'app/views/computerVision.php' => 'Visión Artificial',
    '../phpMyAdmin/' => 'PHP MyAdmin'
];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="../../public/css/header.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <link rel="icon" href="/imagenes/favicon.ico" type="image/x-icon">
</head>
<body>
<header>
    <br><br><br>
    <div class='topnav'>
        <ul>
            <?php foreach ($navItems as $fileName => $title): ?>
                <li>
                    <a href="/automatizacion/<?= $fileName ?>" <?= ($paginaActual == "automatizacion/$fileName") ? $claseActiva : "" ?> <?= ($fileName == '../phpMyAdmin/') ? 'target="_blank"' : '' ?>>
                        <?= $title ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</header>
</body>
</html>