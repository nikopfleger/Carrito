<?php
include "articulos.php";

class Carrito{
	//private $usuario;
	private $listadoArticulos;

	public function __construct(){
		//$this->usuario = $user->__get("nombre");
		$this->listadoArticulos = array();
	}

	public function __get($value){
		return $this->$value;
	}

	
	public function __set($param,$value){
		$this->$param = $value;
	}
	
	public function agregarArticulo($articulo){
		array_push($this->listadoArticulos,$articulo);
	}
	public function eliminarArticuloByIDCompra($index) {
		//array_splice($this->listadoArticulos,$index,1);
		//$this->listadoArticulos = array_splice($this->listadoArticulos,$index,1);
		$i=0;
		foreach ($this->listadoArticulos as $articuloCarrito) 
		{
			if ($articuloCarrito->__get("idCompra") == $index)
			{
				array_splice($this->listadoArticulos,$i,1);
				break;
			}
			$i++;
		}
		return $this->listadoArticulos;
	    
	}
	
	public function calcularTotal() {
		$total = 0;
		foreach($this->listadoArticulos as $articulo)
			$total += $articulo->__get("cantidad") * $articulo->__get("precioUnitario");
		return $total;
	}
}

?>