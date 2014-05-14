<html>
<head>
<?php include "header.php";?>
	<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    	 <div class="container-fluid">
     		<div class="navbar-header">
     
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a href="#">Catalogo</a></li>
        <li class="active"><a href="#">ABM</a></li>
        </ul>
    </div>
  </div>
  </div> 
  </nav>
	

</head>
<body>
<div class="formulario">
<input type="text" class="form-control" id="nombreArticulo" placeholder="Ingresar articulo."><br>
<input type="number" class="form-control"  id="precioArticulo" placeholder="Ingresar precio." min=0><br>
<input type="number" class="form-control"  id="cantidad" placeholder="Ingresar cantidad." min=0><br>
<button type="submit" class="btn btn-success" id="btnNuevo">Nuevo articulo</button>
<button type="submit" class="btn btn-success" id="btnGuardar">Guardar</button>
</div>



</body>
</html>