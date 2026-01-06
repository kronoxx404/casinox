<?php
session_start();
include '../config/conexion.php';

// Verificar si se ha pasado un ID por la URL
if (isset($_GET['id'])) {
    $cliente_id = $_GET['id'];

    // Preparar y ejecutar la consulta para obtener el estado del cliente
    $sql = "SELECT estado FROM data WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $cliente_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Verificar si se encontró el cliente
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $estado = $row['estado'];

        // Devolver el estado en formato JSON
        header('Content-Type: application/json');
        echo json_encode(['estado' => $estado]);
    } else {
        // Manejar el caso donde no se encuentra el cliente
        header('Content-Type: application/json');
        echo json_encode(['estado' => null]);
    }
} else {
    // Manejar el caso donde no se pasa un ID
    header('Content-Type: application/json');
    echo json_encode(['estado' => null]);
}

// Cerrar la conexión a la base de datos
$conn->close();
?>
