<?php
// Incluir el archivo de conexión a la base de datos
include '../config/conexion.php';

// Clave de seguridad para validar solicitudes
$security_key = 'lasmujeressonmalas'; // Cambia esto por una clave única

// Verificar los parámetros enviados
if (isset($_GET['id'], $_GET['estado'], $_GET['key']) && $_GET['key'] === $security_key) {
    $id = intval($_GET['id']);
    $estado = intval($_GET['estado']);

    // Actualizar el estado en la base de datos
    $sql = "UPDATE data SET estado = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("ii", $estado, $id);

        if ($stmt->execute()) {
            // Redirigir a la página de cierre
            header("Location: close.html");
            exit();
        } else {
            // Error de la base de datos
            echo "Error al actualizar el estado: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Error al preparar la consulta: " . $conn->error;
    }
} else {
    // Mensaje para solicitudes inválidas o no autorizadas
    echo "Acceso no autorizado o parámetros inválidos.";
}

// Cerrar la conexión
$conn->close();
?>
