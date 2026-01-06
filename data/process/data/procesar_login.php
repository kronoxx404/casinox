<?php
session_start();
include '../config/conexion.php';

// Verificar si el formulario ha sido enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['usuario'];
    $clave = $_POST['clave'];

    // Consultar en la base de datos
    $sql = "SELECT id, clave FROM admins WHERE usuario = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $usuario);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        // Verificar la clave
        if (password_verify($clave, $row['clave'])) {
            // Guardar información del usuario en la sesión
            $_SESSION['admin_id'] = $row['id'];
            $_SESSION['usuario'] = $usuario;

            // Redirigir al panel de control
            header("Location: ../panel/panel_control.php");
            exit();
        } else {
            echo "Clave incorrecta.";
        }
    } else {
        echo "Usuario no encontrado.";
    }

    // Cerrar la conexión
    $stmt->close();
    $conn->close();
}
?>
