<?php
// db.php
echo "<script>console.log('Debug Objects: " . "Cargando..." . "' );</script>";

require '../vendor/autoload.php'; // Cargar Composer y phpdotenv
// Cargar el archivo .env
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Conexión a la base de datos MySQL usando las variables de entorno
$servername = $_ENV['DB_HOST'];
echo "<script>console.log('Debug Objects: " . $servername . "' );</script>";
$username = $_ENV['DB_USERNAME'];
echo "<script>console.log('Debug Objects: " . $username . "' );</script>";
$password = $_ENV['DB_PASSWORD'];
echo "<script>console.log('Debug Objects: " . $password . "' );</script>";
$database = $_ENV['DB_DATABASE'];
echo "<script>console.log('Debug Objects: " . $database . "' );</script>";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>