<html>

	<head>
	
	<?php include "header.php";?>
	<title>Bienvenido a su carrito</title>
	
	</head>
	<body>
	
	<script type="text/javascript">
		$(document).ready(function() {
 //VERIFICA CAMPOS EN BLANCO

			$("#btnConfirmar").click(function(e) {
				if ( ($("#user").val() == "") && ($("#pass").val() == "") )
				{
					alert("Ingrese usuario y contraseña");
					return false;
				}
				else if ($("#user").val() == "")
				{				
					alert("Ingrese usuario");
					return false;
				}
				else if ($("#pass").val() == "")
				{
					alert("Ingrese contraseña");
					return false;
				}
 //VERIFICA SI EL PASSWORD ES CORRECTO
			/*	else
				{
					e.preventDefault();
					$.post("../Controllers/LoginController.php",{usuario: $("#user").val(),pass:$("#pass").val()})
					.done(function(result) {
						
					})
					.fail(function(result) {

						alert("Error en el servidor");
						return false;
					});			
					
					
					
				}
				*/
		} );
	} );
	</script>
<!-- 	<form action= "../Controllers/LoginController.php">		 -->
<!-- 		Usuario: <input type= "text" name="usuario" id="user"><br> -->
<!-- 		Contraseña: <input type= "password" name="contraseña" id="pass"><br> -->
<!-- 	 	<input type="submit" name="Enviar" id="btnConfirmar"> -->
	 	
<!-- 	</form> -->

	<br>
	<h2 style="text-align:center">Bienvenido</h2>
	<br>
	<form class="form-inline" action="../Controllers/LoginController.php" method="POST" style="text-align:center">
  <div class="form-group">
    <label class="sr-only" for="exampleInputEmail2">Email address</label>
    <input type="text" class="form-control" id="user" name="usuario" placeholder="Ingresar usuario.">
  </div>
  <br><br>
  <div class="form-group">
    <label class="sr-only" for="exampleInputPassword2">Password</label>
    <input type="password" class="form-control" id="pass" name="contraseña" placeholder="Ingresar clave.">
  </div>
  <br><br>
  <button type="submit" class="btn btn-primary" id="btnConfirmar">Ingresar</button>
</form>


	</body>
	

</html>


