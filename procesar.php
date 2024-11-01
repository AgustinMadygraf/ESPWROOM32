<?php
// automatizacion/procesar.php

// Ajuste de ruta para asegurar que 'autoload.php' se carga desde la raíz del proyecto
require_once __DIR__ . '/vendor/autoload.php'; 
require_once __DIR__ . '/app/models/db.php';

// Verificar si los parámetros están presentes
if (isset($_GET['balanza']) && isset($_GET['contador'])) {
    $balanza = $_GET['balanza'];
    $contador = $_GET['contador'];

    // Preparar y ejecutar la consulta SQL
    $sql = "INSERT INTO dm_measurements (balanza, contador) VALUES ('$balanza', '$contador')";
    if ($conn->query($sql) === TRUE) {
        echo "Datos insertados correctamente";

    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "Faltan parámetros";
    echo '<form method="GET" action="procesar.php">
            <table>
                <tr>
                    <td>Balanza:</td>
                    <td><input type="text" name="balanza"></td>
                </tr>
                <tr>
                    <td>Contador:</td>
                    <td><input type="text" name="contador"></td>
                </tr>
                <tr>
                    <td colspan="2"><input type="submit" value="Enviar"></td>
                </tr>
            </table>
          </form>';
}

// Cerrar conexión
$conn->close();
?>
