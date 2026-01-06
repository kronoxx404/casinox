<?php
// Incluir archivo de conexión
include '../config/conexion.php';

header('Content-Type: application/json');

// Consulta para obtener las IPs bloqueadas
$sql = "SELECT ip_address FROM blacklist";
$result = $conn->query($sql);

$blocked_ips = [];

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $blocked_ips[] = $row['ip_address'];
    }
}

// Devolver las IPs en formato JSON
echo json_encode($blocked_ips);

// Cerrar la conexión
$conn->close();
?>
