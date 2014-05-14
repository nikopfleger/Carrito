<?php
include "../Model/carrito.php";

	$idArt = $_REQUEST["id"];
	$cantArt = $_REQUEST["cantidad"];
	$idCompra = $_REQUEST["idCompra"];
	session_start();
	$artDAO = new ArticuloDAO();
	$articuloAEnviar = new ArticuloCarrito(
			$idArt,
			$artDAO->getArticuloByID($idArt)->__get("nombre"),
			$artDAO->getArticuloByID($idArt)->__get("precioUnitario"),
			$cantArt,
			$idCompra);
	$_SESSION["carrito"]->agregarArticulo($articuloAEnviar);
	$nuevoTotal = $_SESSION["carrito"]->calcularTotal();
	echo json_encode($articuloAEnviar->toJason($nuevoTotal));
		

?>