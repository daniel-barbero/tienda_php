<?php

	include( 'funciones.php' );
	
	$conexion = conectar();

	if ( isset( $_GET['id'] ) && !empty( $_GET['id'] ) ) {
		
		eliminar_imagen_producto( $conexion, $_GET['id'] );
		
		eliminar_registro( $conexion, 'productos', $_GET['id'] );
		
		header( 'Location: productos.php' );
		
	}

?>