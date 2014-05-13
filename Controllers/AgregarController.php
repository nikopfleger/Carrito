<?php
include "../Model/carrito.php";

	$idArt = $_REQUEST["id"];
	$cantArt = $_REQUEST["cantidad"];
	session_start();
	$artDAO = new ArticuloDAO();
	$articuloAEnviar = new Articulo(
			$idArt,
			$artDAO->getArticuloByID($idArt)->__get("nombre"),
			$artDAO->getArticuloByID($idArt)->__get("precioUnitario"),
			$cantArt);
	$listadoActual = $_SESSION["carrito"]->agregarArticulo($articuloAEnviar);
	$nuevoTotal = $_SESSION["carrito"]->calcularTotal();
	echo json_encode($articuloAEnviar->toJason($nuevoTotal));
// 	include "../View/confirmarCantidad.php";			

?>