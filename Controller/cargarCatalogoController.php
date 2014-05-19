<?php
include "../Model/carrito.php";
	session_start();
	$articuloDAO = $_SESSION["articuloDAO"];
	$_SESSION["carrito"] = new Carrito();
	$nombre = $_SESSION["user"];
	//$listadoActual = $_SESSION["carrito"]->__get("listadoArticulos");
	include "../View/home.php";
?>