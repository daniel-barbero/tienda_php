<?php

	include( 'funciones.php' );
	
	$conexion = conectar();
	
	if ( isset( $_GET['id'] ) && !empty( $_GET['id'] ) ) {
		
		eliminar_registro( $conexion, 'clientes', $_GET['id'] );
		
	}
	
	header( 'Location: clientes.php' );

?>