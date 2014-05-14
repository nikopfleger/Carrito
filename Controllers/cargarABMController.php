<?php
	session_start();
	$articuloDAO = $_SESSION["articuloDAO"];
	include "../View/ABMCatalogo.php";
?>