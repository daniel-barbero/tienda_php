<?php

	include( 'cabecera.php' );
	
	// bucle para ordenar el listado
    if ( isset($_GET) && !empty($_GET) ) {

        $productos = seleccionar_todos($conexion, 'productos', $_GET['order']);

    } else {

    $productos = seleccionar_todos($conexion, 'productos');  

    }
?>
<div class="row">
        		
    <div class="span3">
        
        <?php include( 'menu.php' ); ?>
        
    </div>
    
    <div class="span9">
        <p>Ordenar por: <a href="productos.php?order=precio">precio |</a>
                        <a href="productos.php?order=marca"> marca |</a>
                        <a href="productos.php"> id </a>
        </p>
        <table class="table table-hover">
        
            <thead>
            
                <tr>
            
                    <th>id</th>
                    <th>Marca</th>
                    <th>Modelo</th>
                    <th>Precio</th>
                    <th>Acción</th>
                
                </tr>
            
            </thead>
            
            <tbody>
            
                <?php while( $producto = mysqli_fetch_assoc( $productos ) ) : ?>
                
	                <tr>
	                
	                    <td><?php echo $producto['id']; ?></td>
	                    <td><a href="editar_producto.php?id=<?php echo $producto['id']; ?>"><?php echo $producto['marca']; ?></a></td>
	                    <td><?php echo $producto['modelo']; ?></td>
	                    <td><?php echo number_format( $producto['precio'], 2, ',', '.' ); ?> &euro;</td>
	                    <td><a href="editar_producto.php?id=<?php echo $producto['id']; ?>"><i class="icon-edit"></i></a>&nbsp;&nbsp;<a href="eliminar_producto.php?id=<?php echo $producto['id']; ?>" onclick="return confirm( '¿Realmente deseas eliminar este producto?' );"><i class="icon-remove"></i></a></td>
	                
	                </tr>
                
                <?php  endwhile; ?>
            
            </tbody>
        
        </table>
        
    </div>
    
</div>
<?php

	include( 'pie.php' );

?>