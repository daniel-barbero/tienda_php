<?php

	include( 'funciones.php' );
	
	$conexion = conectar();
	
	if ( isset( $_GET['id'] ) && !empty( $_GET['id'] ) ) {
		
		eliminar_pedido( $conexion, $_GET['id'] );
		
	}
	
	header( 'Location: pedidos.php' );

?>