<?php

class Articulo{
	
	private $id;
	private $nombre;
	private $precioUnitario;
	private $cantidad;
	
	public function __construct($id,$nombreArticulo,$precioUnitario,$cantidad){
		$this->id = $id;
		$this->nombre = $nombreArticulo;
		$this->precioUnitario = $precioUnitario;
		$this->cantidad = $cantidad;
	}

	public function __get($value){
		return $this->$value;
	}

	public function __set($param,$value){
		$this->$param = $value;
	}
	
	public function toJason($nuevoTotal) {
		return array(
				"id" => $this->id,
				"nombre" => $this->nombre,
				"precio" => $this->precioUnitario,
				"cantidad" => $this->cantidad,
				"total" => $nuevoTotal
		);
	}
	
}

class ArticuloDAO{
	
	private $listadoArticulos;
	
	public function __construct(){
		
		$art1= new Articulo(1,"Galletitas",22,10);		
		$art2= new Articulo(2,"Pan",10,20);		
		$this->listadoArticulos= array($art1,$art2);
				
	}
	
	public function getArticulos(){
		return $this->listadoArticulos;
	}
	
	public function getArticuloByID($id){
		foreach($this->listadoArticulos as $articulo){
			if($articulo->__get("id") == $id)
				return $articulo;
		}
	}

	
}
?>