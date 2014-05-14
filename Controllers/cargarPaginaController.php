<?php
//comment
include "../Model/articulos.php";
session_start();
$nroPagina = $_REQUEST["pagina"];
$articuloDAO = $_SESSION["articuloDAO"];
echo json_encode($articuloDAO->obtenerArrayArticulos($nroPagina));