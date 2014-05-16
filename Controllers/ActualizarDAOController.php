<?php
	include "../Model/articulos.php";
	session_start();
	$articulo = new Articulo(
			$_REQUEST["id"],
			$_REQUEST["nombre"],
			$_REQUEST["precio"],
			$_REQUEST["cantidad"]
			);
	
	echo json_encode($_SESSION["articuloDAO"]->actualizarDAO($articulo));
?>