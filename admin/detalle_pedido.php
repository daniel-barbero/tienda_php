<?php

	include( 'cabecera.php' );
	
	if ( isset( $_GET['id'] ) && !empty( $_GET['id'] ) ) {
		
		$productos = seleccionar_productos_pedido( $conexion, $_GET['id'] );
		
	}

?>
<div class="row">
    
    <div class="span3">
        
        <?php include( 'menu.php' ); ?>
        
    </div>
    
    <div class="span9">
        
        <table class="table table-bordered">
        
            <thead>
            
                <tr>
            
                    <th>id</th>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio</th>
                
                </tr>
            
            </thead>
            
            <tbody>
            
                <?php while ( $producto = mysqli_fetch_assoc( $productos ) ) : ?>
                
	                <tr>
	                
	                    <td><?php echo $producto['id']; ?></td>
	                    <td><?php echo $producto['marca'] . ' ' . $producto['modelo']; ?></td>
	                    <td><?php echo $producto['cantidad']; ?></td>
	                    <td><?php echo number_format( $producto['precio'], 2, ',', '.' ); ?> &euro;</td>
	                
	                </tr>
                
                <?php endwhile; ?>
            
            </tbody>
        
        </table>
        
        <a href="pedidos.php" class="btn btn-info"><i class="icon-arrow-left icon-white"></i> Regresar</a>
        
    </div>
    
</div>
<?php

	include( 'pie.php' );

?>