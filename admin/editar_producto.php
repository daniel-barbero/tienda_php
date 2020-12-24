<?php

	include( 'cabecera.php' );
	
	$mensaje = '';
	
	$marca = '';
	$modelo = '';
	$precio = '';
	$descripcion = '';
	$imagen = '';
	
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
			
		} else {
			
			if ( !empty( $_FILES['imagen_producto']['name'] ) ) {
				
				$imagen = subir_imagen_producto( $_FILES['imagen_producto'] );
				
				if ( $imagen === false ) {
					
					$mensaje = '<div class="alert alert-error">
							    	<button class="close" data-dismiss="alert">&times;</button>
									Ha ocurrido un error al subir la imagen, por favor inténtalo de nuevo.
								</div>';
					
				} else {
					
					eliminar_imagen_producto( $conexion, $_GET['id'] );
					
					$_POST['imagen_producto'] = $imagen;
					
				}
				
			} else {
				
				$_POST['imagen_producto'] = $_POST['ruta_imagen'];
				
			}
			
			editar_producto( $conexion, $_POST, $_GET['id'] );
			
			$mensaje = '<div class="alert alert-success">
					    	<button class="close" data-dismiss="alert">&times;</button>
							Los cambios se han guardado con éxito.
						    </div>';
			
		}
		
	}
	
	if ( isset( $_GET['id'] ) && !empty( $_GET['id'] ) ) {
		
		$producto = seleccionar_registro( $conexion, 'productos', $_GET['id'] );
		
		$marca = $producto['marca'];
		$modelo = $producto['modelo'];
		$precio = $producto['precio'];
		$descripcion = $producto['descripcion'];
		$imagen = $producto['imagen'];
		
	}

?>
<div class="row">
    
    <div class="span3">
        
        <?php include( 'menu.php' ); ?>
        
    </div>
    
    <div class="span9">
        
       	<?php echo $mensaje; ?>
       
        <form action="<?php echo $_SERVER['PHP_SELF'] . '?id=' . $_GET['id']; ?>" method="post" enctype="multipart/form-data">
        
            <div class="well">
                
                <p>
                    <label>Imagen del producto:</label>
                    <img src="../img/productos/<?php echo $imagen; ?>" class="img-polaroid img-editar" />
                </p>
                
                <p>
                    <input type="file" name="imagen_producto" id="imagen_producto" />
                </p>
                
                <input type="hidden" name="MAX_FILE_SIZE" value="2000000" />
                
                <input type="hidden" name="ruta_imagen" value="<?php echo $imagen; ?>" />
                
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
                <input type="text" name="precio" id="precio" class="input-small" value="<?php echo number_format( $precio, 2, ',', '.' ); ?>" /><span class="help-inline">&euro;</span>
            </p>
            
            <p>
                <label for="descripcion">Descripción:</label>
                <textarea name="descripcion" id="descripcion" rows="30" class="input-block-level"><?php echo $descripcion; ?></textarea>
            </p>
            
            <div class="form-actions">
            
                <button class="btn btn-primary">Guardar cambios</button>
                <a href="productos.php" class="btn">Cancelar</a>
            
            </div>
                                    
        </form>
        
    </div>
    
</div>
<?php

	include( 'pie.php' );

?>