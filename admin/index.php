<?php

	include( 'cabecera.php' );

?>
<div class="row">
    
    <div class="span3">
        
        <?php include( 'menu.php' ); ?>
        
    </div>
    
    <div class="span9">
        
        <ul class="thumbnails">
            
            <li class="span3">
                
                <div class="thumbnail">
                    
                    <h2><?php echo contar_registros( $conexion, 'productos' ); ?></h2>
                    <h5>Productos</h5>
                    
                </div>
            
            </li>
            
            <li class="span3">
                
                <div class="thumbnail">
                    
                    <h2><?php echo contar_registros( $conexion, 'pedidos' ); ?></h2>
                    <h5>Pedidos</h5>
                    
                </div>
                
            </li>
            
            <li class="span3">
                
                <div class="thumbnail">
                    
                    <h2><?php echo contar_registros( $conexion, 'usuarios' ); ?></h2>
                    <h5>Usuarios</h5>
                    
                </div>
            
            </li>
            
        </ul>
        
    </div>
    
</div>
<?php

	include( 'pie.php' );

?>