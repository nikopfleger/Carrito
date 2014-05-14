<html>
<head>

  <?php include "header.php";?>
   <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    	 <div class="container-fluid">
     		<div class="navbar-header">
     
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a href="../Controllers/cargarCatalogoController.php">Catalogo</a></li>
        <li class="active"><a href="#">ABM</a></li>
        </ul>
    </div>
  </div>
  </div> 
  </nav>

	

</head>
<body>


<script type="text/javascript">

	$(document).ready(function() {
	  $("#abmCatalogo").dataTable( {
	  	  "bSort": true,
	  	"bAutoWidth":false,
	  	"bInfo":false,
	  	"bJQueryUI": true,
	  	"bPaginate": true,
	  	"bLengthChange": false, 
	  	"iDisplayLength": 4,
	  	"oSearch": {"sSearch": ""},
	  	"sPaginationType": "full_numbers",
	  } );
	  oTable.$('td').hover( function() {
	        var iCol = $('td', this.parentNode).index(this) % 5;
	        $('td:nth-child('+(iCol+1)+')', oTable.$('tr')).addClass( 'highlighted' );
	    }, function() {
	        oTable.$('td.highlighted').removeClass('highlighted');
	    } );
	});






		
</script>


<div class="formulario">
<input type="text" class="form-control" id="nombreArticulo" placeholder="Ingresar articulo."><br>
<input type="number" class="form-control"  id="precioArticulo" placeholder="Ingresar precio." min=0><br>
<input type="number" class="form-control"  id="cantidad" placeholder="Ingresar cantidad." min=0><br>
<button type="submit" class="btn btn-success" id="btnNuevo">Nuevo articulo</button>
<button type="submit" class="btn btn-success" id="btnGuardar">Guardar</button>
</div>

<div class="divABM">
<table id="abmCatalogo" class="tablaABM">
<thead>
<tr>
<th>Nombre</th>
<th>Precio</th>
<th>Cantidad</th>
<th>Acciones</th>
</tr>
</thead>
<tbody>


<?php
	foreach($articuloDAO->__get("listadoArticulos") as $articulo)
	{
		 echo "<tr name='id' value='" . $articulo->__get("id") . "'>".
		 "<td>".$articulo->__get("nombre")."</td>".
		 "<td>".$articulo->__get("precioUnitario")."</td>".
		 "<td>".$articulo->__get("cantidad")."</td>".
		 "<td><a href='#' class='editar'>Editar</a><br><a href='#' class='eliminar'>Eliminar</a> 
		 </td></tr>";		
	}

?>
</tbody>
</table>
</div>



</body>
</html>