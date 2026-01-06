<?php
// Incluir archivo de conexión
include '../config/conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener la dirección IP a desbloquear
    $ip_address = $_POST['ip_address'];

    // Consulta para eliminar la IP de la blacklist
    $sql = "DELETE FROM blacklist WHERE ip_address = ?";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $ip_address);
    
    if ($stmt->execute()) {
        // Si la IP se desbloqueó correctamente, redirigir al panel de control
        header("Location: ../panel/panel_control.php");
        exit();
    } else {
        // Si hay un error, redirigir con un mensaje de error
        header("Location: ../panel/panel_control.php" . urlencode($stmt->error));
        exit();
    }

    // Cerrar la declaración y la conexión
    $stmt->close();
}

$conn->close();
?>
