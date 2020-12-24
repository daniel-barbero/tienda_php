<?php

	include( 'cabecera.php' );
	
	if ( isset( $_GET['id'] ) && !empty( $_GET['id'] ) ) {
		
		$cliente = seleccionar_registro( $conexion, 'clientes', $_GET['id'] );
		
	}

?>
<div class="row">
    
    <div class="span3">
        
        <?php include( 'menu.php' ); ?>
        
    </div>
    
    <div class="span9">
        
        <dl class="dl-horizontal">
            
            <dt>id:</dt>
            <dd><?php echo $cliente['id']; ?></dd>
            
            <dt>Nombre completo:</dt>
            <dd><?php echo $cliente['nombre']; ?></dd>
            
            <dt>Email:</dt>
            <dd><?php echo $cliente['email']; ?></dd>
            
            <dt>Teléfono móvil:</dt>
            <dd><?php echo $cliente['movil']; ?></dd>
            
            <hr />
            
            <dt>Dirección:</dt>
            <dd><?php echo $cliente['direccion']; ?></dd>
            
            <dt>Ciudad:</dt>
            <dd><?php echo $cliente['ciudad']; ?></dd>
            
            <dt>Provincia:</dt>
            <dd><?php echo $cliente['provincia']; ?></dd>
            
            <dt>Código Postal:</dt>
            <dd><?php echo $cliente['cp']; ?></dd>
            
        </dl>
        
        <a href="clientes.php" class="btn btn-info"><i class="icon-arrow-left icon-white"></i> Regresar</a>
        
    </div>
    
</div>
<?php

	include( 'pie.php' );

?>