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

 var editLink = "<a href='#' class='editar'>Editar</a><br>" ;
 var deleteLink = "<a href='#' class='eliminar'>Eliminar</a>" ;
 var row = "";

	$(document).ready(function() {
	var oTable= $("#abmCatalogo").dataTable( 
	{

       //"sAjaxSource": "#### my php file path ####",
        "bJQueryUI": true,
        "bLengthChange": false, //false
        "bPaginate": true,
        "iDisplayLength": 4,
         "sPaginationType": "full_numbers",
        "aoColumns": [
        { "mData": "id" },
		{ "mData": "nombre", "sWidth": "40%",  "sClass" : "center" },
		{ "mData": "precio", "sWidth": "40%",  "sClass" : "center" },
		{ "mData": "cantidad", "sWidth": "40%",  "sClass" : "center" },
		{ 
			"mData": null, "bSortable": false, "sType": "html", "sWidth": "5%", "sClass" : "center", "mRender": function ( data, type, full )
			 { return editLink + deleteLink; }
    	}
	
        ],
		
	  	"bSort": true,
	  	"bAutoWidth":false,
	  	"bInfo":true, //false
	  	"oSearch": {"sSearch": ""},
	  	
	  	"aoColumnDefs": [
	  	               { "bSortable": false, "aTargets": [ 4 ] },
	  	               { "bSearchable": false, "aTargets": [ 4 ]},
	  	               { "bVisible": false, "aTargets":[ 0 ]}
	  	     			],
	  	 "oLanguage": {
	  	      "oPaginate": {
	  	        "sPrevious": "Anterior",
		  	    "sNext": "Siguiente",
		  	    "sFirst": "Primera",
		  	    "sLast": "Ultima"
	  	       },
	  		"sSearch": "Filtrar:"
	  	 },
	  	"aaData": <?php echo $artsTabla;?>
	 });





		 
	  $("#abmCatalogo").on("click",".editar",function(e) {
			e.preventDefault();
			row = $(this).closest("tr")[0];
			var fila = oTable.fnGetData( $(this).closest("tr") );
			$("#nombreArticulo").val(fila.nombre);
			$("#precioArticulo").val(fila.precio);
			$("#cantidad").val(fila.cantidad);
			$("#idArticulo").val(fila.id);


	  });

	  $("#abmCatalogo").on("click",".eliminar",function(e) {
			e.preventDefault();
			// $(this).closest("tr") le pasa un array de filas
			var fila = $(this).closest("tr")[0];
			var articulo = oTable.fnGetData(fila);
			var rownum = oTable.fnGetPosition(fila);
			$.post("../Controllers/EliminarDeDAOController.php",{ id: articulo.id })
			.done(function(result) {
				oTable.fnDeleteRow( rownum );				
	  		})
	  		.fail(function(result) {
				alert("Error en el servidor");
				return false;
			});
			
	  });

	  $("#btnNuevo").on("click",function(e) {
			e.preventDefault();
			$("#nombreArticulo").val("");
			$("#precioArticulo").val("");
			$("#cantidad").val("");
			$("#idArticulo").val("");
	  });

	  $("#btnGuardar").on("click",function(e) {
			e.preventDefault();
			if ($("#nombreArticulo").val() == "")
			{
				alert("Nombre en blanco por favor completelo");
				return false;		
			}
			else if ($("#precioArticulo").val() == "")
			{
				alert("Precio en blanco por favor completelo");
				return false;		
			}
			else if ($("#cantidad").val() == "")
			{
				alert("Cantidad en blanco por favor completela");
				return false;		
			}
			$.post("../Controllers/ActualizarDAOController.php",{id:$("#idArticulo").val(),nombre:$("#nombreArticulo").val(),precio:$("#precioArticulo").val(),cantidad:$("#cantidad").val()})
			.done(function(result) {
				var result = $.parseJSON(result);
				if (result.newID)
					oTable.fnAddData({id:$("#idArticulo").val(),nombre:$("#nombreArticulo").val(),precio:$("#precioArticulo").val(),cantidad:$("#cantidad").val()});
				else {
					oTable.fnUpdate({id:$("#idArticulo").val(),nombre:$("#nombreArticulo").val(),precio:$("#precioArticulo").val(),cantidad:$("#cantidad").val()},row);
				}

			})
			.fail(function(result) {
				alert("Error en el servidor");
				return false;
			});
	  });
	  
	});


	
</script>

<div class="formulario">
<input type="hidden" id="idArticulo" value="">
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
<th>id</th>
<th>Nombre</th>
<th>Precio</th>
<th>Cantidad</th>
<th>Acciones</th>
</tr>
</thead>
<tbody>


 <?php
// 	foreach($articuloDAO->__get("listadoArticulos") as $articulo)
// 	{
// 		 echo "<tr id='" . $articulo->__get("id") . "'>".
// 		 "<td>".$articulo->__get("nombre")."</td>".
// 		 "<td>".$articulo->__get("precioUnitario")."</td>".
// 		 "<td>".$articulo->__get("cantidad")."</td>".
// 		 "<td><a href='#' class='editar'>Editar</a><br><a href='#' class='eliminar'>Eliminar</a> 
// 		 </td></tr>";		
// 	}

 ?>
</tbody>

</table>
</div>



</body>
</html>