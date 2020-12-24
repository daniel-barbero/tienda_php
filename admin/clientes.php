<?php

	include( 'cabecera.php' );
	
	$clientes = seleccionar_todos( $conexion, 'clientes' );

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
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Acción</th>
                
                </tr>
            
            </thead>
            
            <tbody>
            
                <?php while ( $cliente = mysqli_fetch_assoc( $clientes ) ) : ?>
                
	                <tr>
	                
	                    <td><?php echo $cliente['id']; ?></td>
	                    <td><a href="detalle_cliente.php?id=<?php echo $cliente['id']; ?>"><?php echo $cliente['nombre']; ?></a></td>
	                    <td><?php echo $cliente['email']; ?></td>
	                    <td><a href="eliminar_cliente.php?id=<?php echo $cliente['id']; ?>" onclick="return confirm( '¿Realmente deseas eliminar el cliente?' );"><i class="icon-remove"></i></a></td>
	                
	                </tr>
                
                <?php endwhile; ?>
            
            </tbody>
        
        </table>
        
    </div>
    
</div>
<?php

	include( 'pie.php' );

?>