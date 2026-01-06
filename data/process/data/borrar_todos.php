<?php
session_start();
include '../config/conexion.php';

// Verificar si el usuario tiene permisos para borrar (opcional)
// Aquí puedes agregar la lógica de autenticación si es necesario

// Consulta para borrar todos los datos
$sql = "DELETE FROM data"; // Cambia 'data' por el nombre de tu tabla

if ($conn->query($sql) === TRUE) {
    echo json_encode(['success' => true, 'message' => 'Todos los datos han sido borrados.']);
} else {
    echo json_encode(['success' => false, 'error' => $conn->error]);
}

$conn->close();
?>
