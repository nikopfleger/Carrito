<?php
//comment
include "../Model/articulos.php";
$nroPagina = $_REQUEST["pagina"];
$articuloDAO = new ArticuloDAO();
echo json_encode($articuloDAO->obtenerArrayArticulos($nroPagina));