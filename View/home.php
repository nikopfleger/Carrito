<html>
	<head>
	<title>Pagina principal</title>

	<?php include "header.php";?>
	

	<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation" id="navBarHome">
    	 <div class="container-fluid">
     		<div class="navbar-header">
     
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="active"><a href="#">Catalogo</a></li>
        <li><a href="../Controllers/cargarABMController.php" id="accesoABM">ABM</a></li>
        </ul>
    </div>
  </div>
  </div>
  </nav>
	

</head>
<body id="bodyHome">
	<div class="bordeCarrito">
		<i class="fa fa-shopping-cart"></i> Carrito de <?php echo $nombre;?>
		<table id="Carrito" class="elCarrito table table-hover table-condensed">
		<thead>
			<tr>
			<th>Artiulo</th>
			<th>Cantidad</th>
			<th>Precio</th>
			<th>Total</th> <!--link-->
		 	</tr>
		</thead>
		 <?php 
// 		 		$idCompra=0;
		 		$total = 0;
// 		 		foreach($listadoActual as $articulo){
// 		 			$precioASumar = $articulo->__get("cantidad")*$articulo->__get("precioUnitario");
// 		 			echo
// 		 			"<tr><td>".$articulo->__get("nombre"). "</td>".
// 		 			"<td>".$articulo->__get("cantidad")."</td>".
// 		 			"<td>".$precioASumar."</td>".
// 		 			"<td><input type='hidden' name='indexCompra' value='".$idCompra."'><a style='color: black' href='#' class='eliminar'>Eliminar</a></td></tr>";
// 		 			$idCompra++;
// 		 			$total += $precioASumar;
// 	 			}		 	 		
				echo "<td class='total' colspan='4'>". $total . "</tr>";
		 ?>
		 </table>
		 
		 </div>
		 	<br>
			<br>
			<div class="catalogo">
			<div style="text-align:left; font-size:18"> CATALOGO</div> 
		<table id="Catalogo" class="table table-hover table-condensed">
		<thead>
			<tr>
			<th>Nombre</th>
			<th>Precio</th>
		 <!--link-->
			</tr>
		</thead>
		<?php		
			//SIRVE COMO CANTIDAD DE ARTICULOS
			for ($i=0; $i < $articuloDAO->__get("articulosXPagina"); $i++)
			{
				if ($i < count($articuloDAO->getArticulos()))
				{
					$articulo = $articuloDAO->getArticulos()[$i];	
					echo "<tr>".
							"<td>".$articulo->__get("nombre")."</td>".
							"<td>".$articulo->__get("precioUnitario")."</td>".
							"<td><a href='#' class='agregar'>Agregar</a>
				<input type='hidden' name='id' value='" . $articulo->__get("id") . "'>
				</td></tr>";
					
				}
				else
					break;
		
			}
			?>
			</table>
			
			<ul class="pagination">
			<li><a href="#" id="primeraPagina">&laquo;</a></li>			
			<?php
			//ceil((float) (count($articuloDAO->getArticulos()) / ($articuloDAO->__get("articulosXPagina"))));
			for ($j=1; $j <= $articuloDAO->numeroPaginas(); $j++)
				echo "<li><a href='#' class='pagina' id='" . $j . "'>". $j ."</a></li>";
			$j--;
			echo "<li><a href='#' id='ultimaPagina' name='". $j ."'>&raquo;</a></li>";
			?>

  		
		</ul>
		</div>
		
		<script type="text/javascript">
		//FUNCION PARA CONVERTIR UN ARRAY DE ARTICULOS A ROWS DE UNA TABLA
		function parsearArrayArticulos(result) { 
		 var string = "";
				for (var i=0; i<result.articulos.length;i++)
				{
					string = string + "<tr><td>" +
					result.articulos[i].nombre + 
					"</td><td>" + result.articulos[i].precioUnitario +
					"</td><td><a href='#' class='agregar'>Agregar</a>" + 
					"<input type='hidden' name='id' value='" + 
					result.articulos[i].id + "'> </td></tr>";
				}
				return string;
		}
		var idCompra = 0;
			$(document).ready(function () {
				
				//EVENTOINICIO
				$("#primeraPagina").on("click",function(e) {
					e.preventDefault();
					
					//CATALOGO TBODY APPEND
					$.post("../Controllers/cargarPaginaController.php",{pagina: 1})
					.done(function(result) {
						var result = $.parseJSON(result);
						$("#Catalogo tbody tr").remove();
						$("#Catalogo tbody").append(parsearArrayArticulos(result));
					})
					.fail(function(result) {
						alert("Error en el servidor");
						return false;
					});
				});
				//EVENTOFIN
				$("#ultimaPagina").on("click",function(e) {
					e.preventDefault();
					
					//CATALOGO TBODY APPEND
					$.post("../Controllers/cargarPaginaController.php",{pagina: $(this).attr("name")})
					.done(function(result) {
						var result = $.parseJSON(result);
						$("#Catalogo tbody tr").remove();
						$("#Catalogo tbody").append(parsearArrayArticulos(result));
					})
					.fail(function(result) {
						alert("Error en el servidor");
						return false;
					});
				});

				
				//EVENTONUMEROS
				$(".pagina").on("click",function(e) {
				e.preventDefault();
				
				//CATALOGO TBODY APPEND
				$.post("../Controllers/cargarPaginaController.php",{pagina: $(this).attr("id")})
				.done(function(result) {
					var result = $.parseJSON(result);
					$("#Catalogo tbody tr").remove();
					$("#Catalogo tbody").append(parsearArrayArticulos(result));
				})
				.fail(function(result) {
					alert("Error en el servidor");
					return false;
				});

					
		});

			
// 			.agregar son los links
	
			// EVENTO PARA AGREGAR
				$("#Catalogo").on("click",".agregar", function(e) { 
				e.preventDefault();
				cantidadSolicitada = prompt("Ingrese cantidad");	
				$.post("../Controllers/AgregarController.php",{cantidad: cantidadSolicitada, id:$(this).siblings().val(), idCompra: idCompra})
				.done(function(result) {
					result = $.parseJSON(result);
					precioAgregar = result.cantidad * result.precio;
					$(".total").remove();		
					$("#Carrito tbody").append("<tr id='"+ idCompra++  +"' ><td>" + 
					result.nombre + 
					"</td><td>" + 
					result.cantidad + 
					"</td><td>" + 
					precioAgregar + 
					"</td><td>" +
					"<a href='#' class='eliminar'> Eliminar </a></td></tr>" +
					"<tr><td class='total' colspan='4'>" +
					result.total +
					"</td></tr>") ;
				})
				.fail(function(result) {
					alert("Error en el servidor");
					return false;
				});
			});
//EVENTO PARA ELIMINAR
			$("#Carrito").on("click",".eliminar", function(e) {
				e.preventDefault();
				$.post("../Controllers/EliminarController.php",{ index:$(this).parent().parent().attr("id") })
				.done(function(result) {
				var result = $.parseJSON(result);
				//if(result.total == 0)
					//$("#Carrito tbody").empty();
				$(".total").remove();
				$("#" + result.index).remove();
				$("#Carrito tbody").append(
						"<tr><td class='total' colspan='4'>" +
						result.total +
						"</tr>") ;
				})
				.fail(function(result) {
					alert("Error en el servidor");
					return false;
				});		
		});
	});
	

	</script>
</body>
</html>



					 



