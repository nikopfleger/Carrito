<?php
include "articulos.php";

class Carrito{
	private $usuario;
	private $listadoArticulos;

	public function __construct($user){
		$this->usuario = $user->__get("nombre");
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
		return $this->listadoArticulos;
	}
	public function eliminarArticuloByIDCompra($index) {
		$this->listadoArticulos = array_merge(array_slice($this->listadoArticulos,0,$index),array_slice($this->listadoArticulos,$index+1));
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