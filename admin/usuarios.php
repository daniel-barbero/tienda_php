<?php

	include( 'cabecera.php' );
	
	$usuarios = seleccionar_todos( $conexion, 'usuarios' );

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
                    <th>Nombre completo</th>
                    <th>Nombre de usuario</th>
                    <th>Acción</th>
                
                </tr>
            
            </thead>
            
            <tbody>
            
                <?php while ( $usuario = mysqli_fetch_assoc( $usuarios ) ) : ?>
                
	                <tr>
	                
	                    <td><?php echo $usuario['id']; ?></td>
	                    <td><a href="editar_usuario.php?id=<?php echo $usuario['id']; ?>"><?php echo $usuario['nombre_completo']; ?></a></td>
	                    <td><?php echo $usuario['usuario']; ?></td>
	                    <td><a href="editar_usuario.php?id=<?php echo $usuario['id']; ?>"><i class="icon-edit"></i></a>&nbsp;&nbsp;<a href="eliminar_usuario.php?id=<?php echo $usuario['id']; ?>" onclick="return confirm( '¿Realmente deseas eliminar el usuario?' );"><i class="icon-remove"></i></a></td>
	                
	                </tr>
                
                <?php endwhile; ?>
            
            </tbody>
        
        </table>
        
    </div>
    
</div>
<?php

	include( 'pie.php' );

?>