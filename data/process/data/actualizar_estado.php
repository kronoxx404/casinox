<?php
session_start();

// Verificar si el administrador ha iniciado sesión
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

// Incluir el archivo de conexión a la base de datos
include '../config/conexion.php';

// Verificar si se han enviado los datos correctamente
if (isset($_GET['id']) && isset($_GET['estado'])) {
    $id = intval($_GET['id']); // Validar el ID
    $estado = intval($_GET['estado']); // Validar el estado

    // Actualizar el estado en la base de datos
    $sql = "UPDATE data SET estado = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $estado, $id);

    if ($stmt->execute()) {
        echo "El estado del cliente con ID $id ha sido actualizado a $estado.";
    } else {
        echo "Error al actualizar el estado: " . $conn->error;
    }
    $stmt->close();
} else {
    echo "Datos inválidos.";
}

$conn->close();
?>
