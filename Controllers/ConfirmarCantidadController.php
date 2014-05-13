<?php
include "../Model/carrito.php";

	$idArt = $_REQUEST["id"];
	$nombreArt = $_REQUEST["nombreArt"];
	$cantidadSolicitada= $_GET["cantidad"];
	
	session_start();
	
	$articuloDAO = new ArticuloDAO();
	$precioUnitarioArticuloAgregar = $articuloDAO->getArticuloByID($idArt)->__get("precioUnitario");
	$listadoActual = $_SESSION["carrito"]->agregarArticulo($idArt,
														   $nombreArt,
														   $precioUnitarioArticuloAgregar,
														   $cantidadSolicitada);
	include "../View/home.php";
?>