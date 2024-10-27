<?php
header('Content-Type: application/json');
echo json_encode([
    'status' => 'success',
    'message' => 'Respuesta desde test.php para depuración'
]);
