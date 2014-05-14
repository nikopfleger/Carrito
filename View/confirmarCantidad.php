<html>
	<head>
	<title>Confirmar Cantidad</title>
	</head>
	<form action= "../Controllers/ConfirmarCantidadController.php">
		Artículo ID: <input type= "text" name="id" value="<?php echo $idArt;?>" readonly><br>
		Nombre: <input type="text" name="nombreArt" value="<?php echo $nombre;?>" readonly><br>
		Cantidad: <input type="number" name="cantidad" min=1><br>
		<input type="submit" value="Aceptar">
	</form>
</html>


<?php
