<head>
	<meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/png" href="monitor.png">
	<title>Sistema De Monitoreo</title>
	<link href="css/styles.css" rel="stylesheet">	
	<script type="text/javascript" src="js/jquery-3.6.0.min.js"></script>

	<style type="text/css">
			body {
  			background: #131315;
  			font-family: var(--font-style);
		}
		
		:root {
			--font-style: "Nunito Sans", sans-serif;}

		.titulo{
			color: #fff;
			text-align: center;
			font-size: 20px;
		}
		.login{
			position: absolute;
  			top: 50%;
  			left: 50%;
  			width: 400px;
  			padding: 40px;
  			transform: translate(-50%, -50%);
  			background: #242026;
  			box-shadow: 0 15px 25px rgba(143, 124, 236, 0.7);
  			border-radius: 10px;
		}
		.entradas{
			position: relative;
			width: 100%;
			padding: 10px 0;
			font-size: 16px;
			color: #fff;
			margin-bottom: 30px;
			border: none;
  			border-bottom-color: currentcolor;
  			border-bottom-style: none;
  			border-bottom-width: medium;
			border-bottom: 1px solid #fff;
			outline: none;
			background: transparent;
		}
		.etiquetas{
			color: 	#fff;
			
		}
		.mensaje{
			color: #fff;
			display: none;
		}

	</style>

</head>
<body>
<br><br>
<h2 class="titulo">SISTEMA DE MONTOREO WEB</h2>
<br><br><br>
<div style="text-align: center;">	
	<div class="login">
		<form>
			<span class="etiquetas">Usuario:</span><br>
			<input type="text" name="txtUsuario" id="txtUsuario" autocomplete="off" class="entradas">
			<br><br>
			<span class="etiquetas">Contraseña:</span><br>
			<input type="password" name="txtPass" id="txtPass" autocomplete="off" class="entradas">
			<br><br>	
			<input type="button" id="btnLogin" name="btnLogin" value="Ingresar" class="btn" style="padding: 8px 12px;margin-bottom: 10px;">		
			<br>
			<span class="mensaje">Usuario no registrado</span>			
		</form>
	</div>
</div>
</body>
<script type="text/javascript">
	$(document).ready(function(){
		$("#btnLogin").click(function(evento){		
			if ($("#txtUsuario").val().length > 0) {
				if ($("#txtPass").val().length > 0) {
					$.post( "sesion.php",{ usr: $("#txtUsuario").val(), pass: $("#txtPass").val() }, function( data ) {						
						if (data == "OK") {
							window.location.href = "admin";
						}else{
							if (data == "NO") {
								$(".mensaje").show();
								$(".mensaje").html("Usuario no Registrado");
								$("#txtUsuario").focus();
							}else{
								if (data == "ERR") {
									$(".mensaje").show();
									$(".mensaje").html("Problemas de conexión");
									$("#txtUsuario").focus();
								}	
							}							
						}
					});
				}else{
					$(".mensaje").show();
					$(".mensaje").html("Ingrese su Contraseña");
					$("#txtPass").focus();
				}
			}else{
				$(".mensaje").show();
				$(".mensaje").html("Ingrese su Usuario");
				$("#txtUsuario").focus();
			}	
		});

		$("#txtUsuario").keyup(function(e) {	
			$(".mensaje").hide();				
		});

		$("#txtPass").keyup(function(e) {	
			$(".mensaje").hide();				
		});
	});
</script>