<?php
	include "../Model/articulos.php";
	session_start();
	$articuloDAO = $_SESSION["articuloDAO"];
	$artsTabla = json_encode($articuloDAO->articulosToJson());
	include "../View/ABMCatalogo.php";
?>