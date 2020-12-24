<?php

	include( 'funciones.php' );
	
	$conexion = conectar();
	
	if ( isset( $_GET['id'] ) && !empty( $_GET['id'] ) ) {
		
		eliminar_registro( $conexion, 'usuarios', $_GET['id'] );
		
	}
	
	header( 'Location: usuarios.php' );

?>