<html>
	<head>
	<title>Página principal</title>
	<?php include "header.php";?>
	</head>
	<body>
	
		<table id="Carrito" style="width:700px">
			<tr>
			<th>Nombre Artículo</th>
			<th>Cantidad</th>
			<th>Precio</th>
			<th>Total</th> <!--link-->
		 	</tr>
		 <?php 
		 		$idCompra = 0;
		 		$total = 0;
		 		foreach($listadoActual as $articulo) {
		 			$precioASumar = $articulo->__get("cantidad")*$articulo->__get("precioUnitario");
					echo "<tr id='". $idCompra++ . "'><td>".$articulo->__get("nombre"). "</td>".
							 "<td>".$articulo->__get("cantidad")."</td>".
							 "<td>".$precioASumar."</td>".
							 "<td><a href='#' class='eliminar'>Eliminar</a></td></tr>"; 
					$total += $precioASumar;
				}
				echo "<tr><td><td><td><td class='total'>". $total . "</td></td></td></td></tr>";
		 ?>
		 </table>
		 	<br>
			<br>
		
		<table id="Catalogo" style="width:700px">
			<tr>
			<th>Nombre</th>
			<th>Precio</th>
		 <!--link-->
			</tr>
		<?php		
			foreach($articuloDAO->getArticulos() as $articulo){
				echo "<tr>".
					 "<td>".$articulo->__get("nombre")."</td>".
					 "<td>".$articulo->__get("precioUnitario")."</td>".
					 "<td><a href='#' class='agregar'>Agregar</a>
					<input type='hidden' name='id' value='" . $articulo->__get("id") . "'>
					</td></tr>";
			}
		
		?>			
		</table>
		<script type="text/javascript">
			$(document).ready(function () {
// 			.agregar son los links
			// EVENTO PARA AGREGAR
				$("#Catalogo").on("click",".agregar", function(e) { 
				e.preventDefault();
				cantidadSolicitada = prompt("Ingrese cantidad");	
				$.post("../Controllers/AgregarController.php",{cantidad: cantidadSolicitada, id:$(this).siblings().val()})
				.done(function(result) {
					result = $.parseJSON(result);
					precioAgregar = result.cantidad * result.precio;
					$(".total").remove();		
					$("#Carrito tbody").append("<tr id='"+ <?php echo $idCompra++; ?> +"' ><td>" + 
					result.nombre + 
					"</td><td>" + 
					result.cantidad + 
					"</td><td>" + 
					precioAgregar + 
					"</td><td>" +
					"<a href='#' class='eliminar'> Eliminar </a></td></tr>" +
					"<tr><td><td><td><td class='total'>" +
					result.total +
					"</td></td></td></td></tr>") ;
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
				$(".total").remove();
				$("#Carrito tr").eq(result.index).remove();
				$("#Carrito tbody").append(
						"<tr><td><td><td><td class='total'>" +
						result.total +
						"</td></td></td></td></tr>") ;
			});			
		});
	});
	

	</script>
</body>
</html>



					 



