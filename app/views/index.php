<?php
// index.php
require 'header.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualización de Balanza y Contador Industrial</title>
    <link rel="stylesheet" href="../../public/css/styles.css">
</head>
<body>
    <div class="container">
        <h1>Visualización de Balanza y Contador Industrial</h1>
        <div class="display">
            <div class="display-item">
                <h2>Balanza</h2>
                <p id="balanza-value">Cargando...</p>
            </div>
            <div class="display-item">
                <h2>Contador Industrial</h2>
                <p id="contador-value">Cargando...</p>
            </div>
        </div>
    </div>
    <script src="../../public/js/script.js"></script>
</body>
</html>