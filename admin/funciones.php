<?php

	function conectar() {
		
		$conexion = mysqli_connect('localhost', 'root', '','db562587516');
		
		if ( mysqli_connect_errno() ) die( 'Error: ' . mysqli_connect_error() );
		
		mysqli_query( $conexion, "SET NAMES utf8" );
		
		return $conexion;
		
	}
	
	function login( $conexion, $usr, $pwd){
		$usr = mysqli_real_escape_string( $conexion, $usr );
		$pwd = mysqli_real_escape_string( $conexion, $pwd );

		$resultado = mysqli_query ($conexion, "SELECT id FROM usuarios WHERE usuario = '$usr' AND contrasena = SHA1('$pwd') ");

		return ( mysqli_num_rows( $resultado ) != 0 ) ? true : false;
	}

	function id_usuario ($conexion, $usuario) {

		$usuario = mysqli_real_escape_string( $conexion, $usuario );

		$resultado = mysqli_query ($conexion, "SELECT id FROM usuarios WHERE usuario = '$usuario' ");

		$datos = mysqli_fetch_assoc($resultado);

		return $datos['id'];
	}

	function contar_registros( $conexion, $tabla ) {
		
		$resultado = mysqli_query( $conexion, "SELECT id FROM $tabla" );
		
		return mysqli_num_rows( $resultado );
		
	}
	
	function comprobar_usuario( $conexion, $usuario ) {
		
		$usuario = mysqli_real_escape_string( $conexion, $usuario );
		
		$resultado = mysqli_query( $conexion, "SELECT usuario FROM usuarios WHERE usuario = '$usuario'" );
		
		return ( mysqli_num_rows( $resultado ) != 0 ) ? true : false;
		
	}
	
	function agregar_usuario( $conexion, $campos ) {
		
		$usuario = mysqli_real_escape_string( $conexion, $campos['usuario'] );
		$contrasena = mysqli_real_escape_string( $conexion, $campos['contrasena'] );
		$nombre_completo = mysqli_real_escape_string( $conexion, $campos['nombre_completo'] );
		
		mysqli_query( $conexion, "INSERT INTO usuarios
								  (usuario, contrasena, nombre_completo)
								  VALUES
								  ('$usuario', SHA1('$contrasena'), '$nombre_completo')" );
		
	}
	
	function editar_usuario( $conexion, $campos, $id ) {
		
		$id = mysqli_real_escape_string( $conexion, $id );
		$nombre_completo = mysqli_real_escape_string( $conexion, $campos['nombre_completo'] );
		$contrasena = mysqli_real_escape_string( $conexion, $campos['contrasena'] );
		
		if ( empty( $contrasena ) ) {
			
			$query = "UPDATE usuarios SET nombre_completo = '$nombre_completo' WHERE id = '$id'";
			
		} else {
			
			$query = "UPDATE usuarios SET nombre_completo = '$nombre_completo', contrasena = SHA1('$contrasena') WHERE id = '$id'";
			
		}
		
		mysqli_query( $conexion, $query );
		
	}
	

	function seleccionar_todos($conexion, $tabla, $order=''){

		$resultado = mysqli_query($conexion, "SELECT * FROM $tabla");
		
		if ($order == 'precio') { $resultado = mysqli_query($conexion, "SELECT * FROM $tabla ORDER BY precio"); }
		if ($order == 'marca') { $resultado = mysqli_query($conexion, "SELECT * FROM $tabla ORDER BY marca"); }		

       return $resultado;

    }

	function seleccionar_registro( $conexion, $tabla, $id ) {
		
		$resultado = mysqli_query( $conexion, "SELECT * FROM $tabla WHERE id = '$id'" );
		
		return mysqli_fetch_assoc( $resultado );
		
	}
	
	function subir_imagen_producto( $archivo ) {
		
		$formatos = array( 'image/gif', 'image/jpeg', 'image/png' );
		
		if ( $archivo['error'] != 0 ) {
			
			return false;
			
		} else {
			
			if ( !in_array( $archivo['type'], $formatos ) || !getimagesize( $archivo['tmp_name'] ) ) {
				
				return false;
				
			} else {
				
				$destino = '../img/productos/' . uniqid() . '_' . $archivo['name'];
				
				if ( move_uploaded_file( $archivo['tmp_name'], $destino ) ) {
					
					return str_replace( '../img/productos/', '', $destino );
					// devolvemos el nombre del archivo eliminando la ruta
					
				} else {
					
					return false;
					
				}
				
			}
			
		}
		
	}
	
	function agregar_producto( $conexion, $campos ) {
		
		$marca = mysqli_real_escape_string( $conexion, $campos['marca'] );
		$modelo = mysqli_real_escape_string( $conexion, $campos['modelo'] );
		$descripcion = mysqli_real_escape_string( $conexion, $campos['descripcion'] );
		$precio = (float)mysqli_real_escape_string( $conexion, $campos['precio'] );
		$imagen = mysqli_real_escape_string( $conexion, $campos['imagen_producto'] );
		
		mysqli_query( $conexion, "INSERT INTO productos
								  (marca, modelo, precio, descripcion, imagen)
								  VALUES
								  ('$marca', '$modelo', '$precio', '$descripcion', '$imagen')" );
		
	}
	
	function editar_producto( $conexion, $campos, $id ) {
		
		$marca = mysqli_real_escape_string( $conexion, $campos['marca'] );
		$modelo = mysqli_real_escape_string( $conexion, $campos['modelo'] );
		$descripcion = mysqli_real_escape_string( $conexion, $campos['descripcion'] );
		$precio = (float)mysqli_real_escape_string( $conexion, $campos['precio'] );
		$imagen = mysqli_real_escape_string( $conexion, $campos['imagen_producto'] );
		
		mysqli_query( $conexion, "UPDATE productos SET marca = '$marca',
													   modelo = '$modelo',
													   descripcion = '$descripcion',
													   precio = '$precio',
													   imagen = '$imagen'
								  WHERE id = '$id'" );
		
	}
	
	function eliminar_imagen_producto( $conexion, $id ) {
		
		$id = mysqli_real_escape_string( $conexion, $id );
		
		$resultado = mysqli_fetch_assoc( mysqli_query( $conexion, "SELECT imagen FROM productos WHERE id = '$id'" ) );
		
		unlink( '../img/productos/' . $resultado['imagen'] );
				
	}
	
	function eliminar_registro( $conexion, $tabla, $id ) {
		
		mysqli_query( $conexion, "DELETE FROM $tabla WHERE id = '$id'" );
		
	}
	
	function seleccionar_pedidos( $conexion ) {
		
		return mysqli_query( $conexion, "SELECT pedidos.id AS id, clientes.nombre AS nombre,
										 UNIX_TIMESTAMP(pedidos.fecha) AS fecha,
										 SUM(detalle_pedidos.precio * detalle_pedidos.cantidad) AS precio
										 FROM pedidos
										 INNER JOIN clientes ON pedidos.id_cliente = clientes.id
										 INNER JOIN detalle_pedidos ON pedidos.id = detalle_pedidos.id_pedido
										 GROUP BY pedidos.id" );
		
	}
	
	function seleccionar_productos_pedido( $conexion, $id ) {
		
		$id = mysqli_real_escape_string( $conexion, $id );
		
		return mysqli_query( $conexion, "SELECT productos.id AS id, productos.marca AS marca,
										 productos.modelo AS modelo, detalle_pedidos.cantidad AS cantidad,
										 detalle_pedidos.precio AS precio
										 FROM detalle_pedidos
										 INNER JOIN productos ON detalle_pedidos.id_producto = productos.id
										 WHERE detalle_pedidos.id_pedido = '$id'" );
		
	}
	
	function eliminar_pedido( $conexion, $id ) {
		
		$id = mysqli_real_escape_string( $conexion, $id );
		
		mysqli_query( $conexion, "DELETE pedidos.*, detalle_pedidos.*
								  FROM pedidos
								  INNER JOIN detalle_pedidos ON pedidos.id = detalle_pedidos.id_pedido
								  WHERE pedidos.id = '$id'" );
		
	}

?>