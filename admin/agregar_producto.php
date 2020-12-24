<?php

	include( 'cabecera.php' );
	
	$marca = '';
	$modelo = '';
	$precio = '';
	$descripcion = '';
	
	$mensaje = '';
	
	if ( $_POST ) {
		
		$marca = $_POST['marca'];
		$modelo = $_POST['modelo'];
		$precio = $_POST['precio'];
		$descripcion = $_POST['descripcion'];
		
		if ( empty( $marca ) || empty( $modelo ) || empty( $precio ) || empty( $descripcion ) ) {
			
			$mensaje = '<div class="alert alert-error">
					    	<button class="close" data-dismiss="alert">&times;</button>
							Todos los campos son obligatorios.
						</div>';
			
		} else if ( $_FILES['imagen_producto']['error'] == 4 ) {
			
			$mensaje = '<div class="alert alert-error">
					    	<button class="close" data-dismiss="alert">&times;</button>
							Debes seleccionar una imagen.
						</div>';
			
		} else {
			
			$imagen = subir_imagen_producto( $_FILES['imagen_producto'] );
			
			if ( $imagen === false ) {
				
				$mensaje = '<div class="alert alert-error">
					    	<button class="close" data-dismiss="alert">&times;</button>
							Ha ocurrido un error al subir la imagen, por favor inténtalo de nuevo.
						    </div>';
				
			} else {
				
				$_POST['imagen_producto'] = $imagen;
				
				agregar_producto( $conexion, $_POST );
				
				$mensaje = '<div class="alert alert-success">
					    	<button class="close" data-dismiss="alert">&times;</button>
							El producto se ha agregado con éxito.
						    </div>';
				
			}
			
		}
		
	}

?>
<div class="row">
    
    <div class="span3">
        
        <?php include( 'menu.php' ); ?>
        
    </div>
    
    <div class="span9">
    
    	<?php echo $mensaje; ?>
        
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
        
            <div class="well">
                
                <p>
                    <label for="imagen_producto" class="control-label">Imagen del producto:</label>
                    <input type="file" name="imagen_producto" id="imagen_producto" />
                </p>
                
                <input type="hidden" name="MAX_FILE_SIZE" value="2000000" />
                
            </div>
            
            <p>
                <label for="marca">Marca:</label>
                <input type="text" name="marca" id="marca" class="input-block-level" value="<?php echo $marca; ?>" />
            </p>
            
            <p>
                <label for="modelo">Modelo:</label>
                <input type="text" name="modelo" id="modelo" class="input-block-level" value="<?php echo $modelo; ?>" />
            </p>
            
            <p>
                <label for="precio">Precio:</label>
                <input type="text" name="precio" id="precio" class="input-small" value="<?php echo $precio; ?>" /><span class="help-inline">&euro;</span>
            </p>
            
            <p>
                <label for="descripcion">Descripción:</label>
                <textarea name="descripcion" id="descripcion" rows="30" class="input-block-level"><?php echo $descripcion; ?></textarea>
            </p>
            
            <div class="form-actions">
            
                <button class="btn btn-primary">Guardar producto</button>
                <a href="productos.php" class="btn">Cancelar</a>
            
            </div>
                                    
        </form>
        
    </div>
    
</div>
<?php

	include( 'pie.php' );

?>