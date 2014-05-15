<?php

 include "../Model/articulos.php";
 $id= $_REQUEST["id"];
 $rownum= $_REQUEST["rownum"];
 session_start();
 $_SESSION["articuloDAO"]->eliminarByID($id);
 echo "";
?>
 