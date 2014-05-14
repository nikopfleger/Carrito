<?php
include "../Model/usuarios.php";
include "../Model/carrito.php";


		
		
		$nombre=$_REQUEST["usuario"];
		$pass=$_REQUEST["contraseña"];
		
		$usuarioDao = new UsuarioDAO();

		$potencialUsuario = new Usuario($nombre,$pass);
		if($usuarioDao->existeUsuario($potencialUsuario)){

			session_start();
			$_SESSION["carrito"] = new Carrito();
			$articuloDAO = new ArticuloDAO();
			$_SESSION["articuloDAO"] = $articuloDAO;
			$_SESSION["user"] = $nombre;
			//$listadoActual = $_SESSION["carrito"]->__get("listadoArticulos");
			include "../View/home.php";
		}
	else {
			echo "Los datos son incorrectos";
			include "../View/index.php";
		}

		
		

?>