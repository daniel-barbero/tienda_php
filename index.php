<?php
include('header.php');

$productos = seleccionar_todo ($conexion, 'productos');

?>

    <div class="row">
                
        <div class="span12">
                    
            <ul class="thumbnails" id="productos">
    			<?php while ( $producto = mysqli_fetch_assoc ($productos) ) : ?>

                <li class="span4"><!-- producto -->
    	                        
                    <div class="thumbnail">
    	                            
                        <div class="caption">

                            <h5><span><?php echo $producto['marca']; ?></span><br />
                              <a href="detalle_producto.php?id=<?php echo $producto['id']; ?>">
  								<?php echo $producto['modelo']; ?>
                              </a>
                            </h5>
    		                <!-- abrimos la pagina detalle_producto.php, pasandole la variable id del articulo seleccionado -->                        
                            <a href="detalle_producto.php?id=<?php echo $producto['id']; ?>">
                            	<img src="img/productos/<?php echo $producto['imagen']; ?>" 
                                	 alt="<?php echo $producto['marca'] . $producto['modelo']; ?>" />
                            </a>
                                                                                
                            <h4 class="text-error pull-right precio"><?php echo number_format($producto['precio'], 2, ',', '.'); ?></h4>
    		               <!--En el enlace carrito envio dos variables:
                           La variable accion (con valor 'agregar'), y la variable id
                            -->              
    	                    <a href="carrito.php?accion=agregar&id=<?php echo $producto['id']; ?>" class="btn btn-success pull-left">
                            	<i class="icon-shopping-cart icon-white"></i> Comprar
                            </a>
    	                                
                            <div class="clearfix"></div>
                                        
                        </div>
    	                            
                    </div>
    	                        
                </li><!-- /producto -->
    						
                <?php endwhile; ?>          
                        
            </ul>
               
    </div>        
</div>
            
 <?php include('footer.php'); ?>