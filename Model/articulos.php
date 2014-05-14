<?php

class ArticuloCarrito extends Articulo {
	private $idCompra;

	public function __construct($id,$nombreArticulo,$precioUnitario,$cantidad,$idCompra){
		$this->id = $id;
		$this->nombre = $nombreArticulo;
		$this->precioUnitario = $precioUnitario;
		$this->cantidad = $cantidad;
		$this->idCompra = $idCompra;
	}
	public function toJason($nuevoTotal) {
		return array(
				"id" => $this->idCompra,
				"nombre" => $this->nombre,
				"precio" => $this->precioUnitario,
				"cantidad" => $this->cantidad,
				"total" => $nuevoTotal
		);
	}
	public function __get($value){
		return $this->$value;
	}
	
	public function __set($param,$value){
		$this->$param = $value;
	}
	
}

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
	

	
}


class ArticuloDAO{
	
	private $listadoArticulos;
	private $articulosXPagina;
	
	public function __construct(){	
		
		$art1= new Articulo(1,"Galletitas",22,10);		
		$art2= new Articulo(2,"Pan",10,20);	
		$art3= new Articulo(3,"DVDVirgen",5,100);
		$art4= new Articulo(4,"Lapicera",2,50);
		$art5= new Articulo(5,"Cuaderno",10,90);
		$art6= new Articulo(6,"Chicle",1,500);
		$art7= new Articulo(7,"Marlboro Box", 30, 1000);
		$art8= new Articulo(8,"Queso",22,10);
		$art9= new Articulo(9,"Jamon",10,20);
		$art10= new Articulo(10,"Lechuga",22,10);
		$this->articulosXPagina = 3;
		$this->listadoArticulos= array($art1,$art2,$art3,$art4,$art5,$art6,$art7,$art8,$art9,$art10);
				
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
	
	public function obtenerArrayArticulos($nroPagina) {
		$indiceInicial = $this->articulosXPagina * ($nroPagina - 1);
		//nombre, precioUnitario, id
		$array = array();
		for ($i = $indiceInicial;$i < $indiceInicial + $this->articulosXPagina; $i++)
		{
			
				if ($i < count($this->listadoArticulos) )
				{
					$articulo = $this->listadoArticulos[$i];
					$array[$i - $indiceInicial] =
					array(
							"nombre" => $articulo->__get("nombre"),
							"precioUnitario" => $articulo->__get("precioUnitario"),
							"id" => $articulo->__get("id")
					);
				}
				else
					break;
			
		}		
		return array("articulos" => $array);
	}
	
	public function numeroPaginas() {
		return ceil((float) (sizeof($this->listadoArticulos) / ($this->articulosXPagina)));
	}
	
	public function __get($value){
		return $this->$value;
	}
	
	public function __set($param,$value){
		$this->$param = $value;
	}
	
}
?>