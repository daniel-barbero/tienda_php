<?php

	include( 'cabecera.php' );
	
	$mensaje = '';
	
	$usuario = '';
	$nombre_completo = '';
	
	if ( $_POST ) {
		
		$usuario = $_POST['usuario'];
		$nombre_completo = $_POST['nombre_completo'];
		$contrasena = $_POST['contrasena'];
		$repetir_contrasena = $_POST['repetir_contrasena'];
		
		if ( empty( $nombre_completo ) ) {
			
			$mensaje = '<div class="alert alert-error">
					    	<button class="close" data-dismiss="alert">&times;</button>
							El nombre completo es obligatorio.
						</div>';
			
		} else if ( !empty( $contrasena ) && $contrasena != $repetir_contrasena ) {
			
			$mensaje = '<div class="alert alert-error">
					    	<button class="close" data-dismiss="alert">&times;</button>
							Las contraseñas no coinciden.
						</div>';
			
		} else {
			
			editar_usuario( $conexion, $_POST, $_GET['id'] );
			
			$mensaje = '<div class="alert alert-success">
					    	<button class="close" data-dismiss="alert">&times;</button>
							El usuario se ha editado con éxito.
						</div>';
			
		}
		
	}
	
	if ( isset( $_GET['id'] ) && !empty( $_GET['id'] ) ) {
		
		$id = $_GET['id'];
		
		$resultado = seleccionar_registro( $conexion, 'usuarios', $id );
		
		$usuario = $resultado['usuario'];
		$nombre_completo = $resultado['nombre_completo'];
		
	}

?>
<div class="row">
    
    <div class="span3">
        
        <?php include( 'menu.php' ); ?>
        
    </div>
    
    <div class="span9">
        
        <?php echo $mensaje; ?>
        
        <form action="<?php echo $_SERVER['PHP_SELF'] . '?id=' . $id; ?>" method="post">
            
            <p>
                <label for="usuario">Nombre de usuario:</label>
                <input type="text" name="usuario" id="usuario" class="input-xlarge" value="<?php echo $usuario; ?>" readonly />
            </p>
            
            <p>
                <label for="nombre">Nombre completo:</label>
                <input type="text" name="nombre_completo" id="nombre_completo" class="input-xlarge" value="<?php echo $nombre_completo; ?>" />
            </p>
            
            <p>
                <label for="contrasena">Contraseña:</label>
                <input type="password" name="contrasena" id="contrasena"/>
            </p>
            
            <p>
                <label for="repetir_contrasena">Repetir contraseña:</label>
                <input type="password" name="repetir_contrasena" id="repetir_contrasena" />
            </p>
            
            <div class="form-actions">
            
                <button class="btn btn-primary">Guardar cambios</button>
                <a href="usuarios.php" class="btn">Cancelar</a>
            
            </div>
                                    
        </form>
        
    </div>
    
</div>
<?php

	include( 'pie.php' );

?>