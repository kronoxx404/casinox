<?php
// Configuración de la base de datos
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'u450055868_goleodegoleo');
define('DB_PASSWORD', 'Jeyco420');
define('DB_DATABASE', 'u450055868_goleodegoleo');

// Conexión a la base de datos
require_once __DIR__ . '/DbAdapter.php';
$conn = new DbAdapter(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>