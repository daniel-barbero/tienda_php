<?php

	include( 'cabecera.php' );
	
	$pedidos = seleccionar_pedidos( $conexion );

?>
<div class="row">
    
    <div class="span3">
        
       <?php include( 'menu.php' ); ?>
        
    </div>
    
    <div class="span9">
        
        <table class="table table-hover">
        
            <thead>
            
                <tr>
            
                    <th>id</th>
                    <th>Cliente</th>
                    <th>Fecha</th>
                    <th>Total</th>
                    <th>Acción</th>
                
                </tr>
            
            </thead>
            
            <tbody>
            
                <?php while ( $pedido = mysqli_fetch_assoc( $pedidos ) ) : ?>
                
	                <tr>
	                
	                    <td><?php echo $pedido['id']; ?></td>
	                    <td><?php echo $pedido['nombre']; ?></td>
	                    <td><?php echo date( 'd/m/Y h:i:s', $pedido['fecha'] ); ?></td>
	                    <td><a href="detalle_pedido.php?id=<?php echo $pedido['id']; ?>"><?php echo number_format( $pedido['precio'], 2, ',', '.' ); ?> &euro;</a></td>
	                    <td><a href="eliminar_pedido.php?id=<?php echo $pedido['id']; ?>" onClick="return confirm( '¿Realmente deseas eliminar el pedido?' );"><i class="icon-remove"></i></a></td>
	                
	                </tr>
                
                <?php endwhile; ?>
            
            </tbody>
        
        </table>
        
    </div>
    
</div>
<?php

	include( 'pie.php' );

?>