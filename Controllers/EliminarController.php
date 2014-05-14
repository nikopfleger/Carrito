<?php
	include "../Model/carrito.php";
	$index = $_REQUEST["index"];
	session_start();
	$articuloDAO = new ArticuloDAO();
	$listadoActual = $_SESSION["carrito"]->eliminarArticuloByIDCompra($index);
	$nuevoTotal = $_SESSION["carrito"]->calcularTotal();
	echo json_encode(array("index" => $index, "total" => $nuevoTotal));

?>