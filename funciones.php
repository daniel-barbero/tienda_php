<?php

function conectar() {

	$conexion = mysqli_connect('localhost', 'root', '','db562587516');

	if (mysqli_connect_errno() ) die ( 'Error: ' . mysqli_connect_error() );

	mysqli_query ($conexion, "SET NAMES utf8");

	return $conexion;

}

function seleccionar_todo( $conexion, $tabla) {

	$resultado = mysqli_query ($conexion, "SELECT * FROM $tabla");
	
	return $resultado;
}

function seleccionar_registro($conexion, $tabla, $id){

	$id = mysqli_real_escape_string( $conexion, $id);
	$resultado = mysqli_query ($conexion, "SELECT * FROM $tabla WHERE id = '$id' " );

	return mysqli_fetch_assoc ($resultado);
}

function seleccionar_productos_carrito($conexion, $carrito){

	if ( count ($carrito) > 0) {

		foreach ($carrito as $id_producto => $cantidad) {

			$resultado = mysqli_query ($conexion, "SELECT id, marca, modelo, precio, $cantidad AS cantidad FROM productos WHERE id = '$id_producto' " );
			//Forzamos la introducción del valor 'cantidad', aunque en nuestra BD no existe

			$productos[] = mysqli_fetch_assoc ($resultado);
		}

		return $productos;
	}
}

function calcular_subtotal_carrito( $conexion, $carrito) {

	$subtotal = 0;
	foreach ($carrito as $producto => $cantidad) {
		$resultado = mysqli_fetch_assoc (
			mysqli_query ($conexion, "SELECT (precio * $cantidad) as subtotal FROM productos WHERE id ='$producto' ")
			);
			// hemos hecho una operacion en el SQL que hemos llamado subtotal

		$subtotal += $resultado['subtotal'];
	}
	return $subtotal;
}

function sumar_articulo ($cantidad){

	$cantidad++;
	return $cantidad;
}

function guardar_cliente($conexion, $campos){
	$nombre = mysqli_real_escape_string($conexion, $campos['nombre']);
	$email = mysqli_real_escape_string($conexion, $campos['email']);
	$movil = mysqli_real_escape_string($conexion, $campos['movil']);
	$direccion = mysqli_real_escape_string($conexion, $campos['direccion']);
	$ciudad = mysqli_real_escape_string($conexion, $campos['ciudad']);
	$provincia = mysqli_real_escape_string($conexion, $campos['provincia']);
	$cp = mysqli_real_escape_string($conexion, $campos['cp']);

	mysqli_query($conexion, "INSERT INTO clientes
	(nombre, email, movil, direccion, ciudad, provincia, cp)
	VALUES
	('$nombre', '$email','$movil','$direccion','$ciudad','$provincia','$cp')
	");
	
	//obtener el id del ultimo registro insertado
	return mysqli_insert_id($conexion);
}

function guardar_pedido($conexion, $id_cliente, $carrito) {

	mysqli_query($conexion, "INSERT INTO pedidos (id_cliente) VALUES ('$id_cliente')");

	$id_pedido = mysqli_insert_id($conexion);	

	// hay que recorrer el array carrito para extraer los datos de cada articulo seleccionado

	foreach ($carrito as $id => $cantidad) {
		$producto = mysqli_fetch_assoc( mysqli_query( $conexion, 
						"SELECT id, precio FROM productos WHERE id = '$id' ") );

		$id_producto = $producto['id'];
		$precio = $producto['precio'];
		$envio = ENVIO;

		mysqli_query( $conexion, "INSERT INTO detalle_pedidos
					( id_pedido, id_producto, cantidad, precio, envio)
					VALUES ('$id_pedido', '$id_producto', '$cantidad', '$precio', '$envio')" );
	}
}
?>