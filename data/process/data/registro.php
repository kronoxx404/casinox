<?php
include '../config/conexion.php'; // Asegúrate de incluir tu archivo de conexión

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario = $_POST['usuario'];
    $clave = $_POST['clave'];

    // Hashear la clave
    $clave_hashed = password_hash($clave, PASSWORD_DEFAULT);

    // Insertar en la base de datos
    $sql = "INSERT INTO admins (usuario, clave) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $usuario, $clave_hashed);

    if ($stmt->execute()) {
        echo "Administrador registrado con éxito.";
    } else {
        echo "Error al registrar el administrador: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Administrador</title>
</head>
<body>
    <h1>Registro de Administrador</h1>
    <form method="POST" action="">
        <label for="usuario">Usuario:</label>
        <input type="text" name="usuario" id="usuario" required>
        <br>
        <label for="clave">Clave:</label>
        <input type="password" name="clave" id="clave" required>
        <br>
        <button type="submit">Registrar</button>
    </form>
</body>
</html>
