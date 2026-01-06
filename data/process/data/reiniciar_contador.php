<?php
// Incluir el archivo de conexión a la base de datos
include '../config/conexion.php';

// Reiniciar el contador de visitantes a cero
$sql = "UPDATE visit SET visitor_count = 1";

if ($conn->query($sql) === TRUE) {
    // Redirigir de vuelta al panel de control
    header("Location: ../panel/panel_control.php"); // Asegúrate de que esta sea la ruta correcta
    exit();
} else {
    echo "Error al reiniciar el contador: " . $conn->error;
}

// Cerrar la conexión
$conn->close();
?>
