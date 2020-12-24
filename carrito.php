<?php
include('header.php');

// AGREGAR PRODUCTOS AL CARRITO
if (isset($_GET['accion']) && $_GET['accion'] == 'agregar') {

	$id = $_GET['id'];

	if ( !isset( $_SESSION['carrito'][$id]) ){

		$_SESSION['carrito'][$id] = 1; // si no existe la sesion carrito de ese id la creamos con valor 1
	}
	else {
		$_SESSION['carrito'][$id] ++;	//el elemento ya estaba en el carrito y le sumamos 1
	}
}

// ELIMINAR PRODUCTOS
if (isset($_GET['accion']) && $_GET['accion'] == 'eliminar') {

	$id = $_GET['id'];

	unset ($_SESSION['carrito'][$id]);
	
}

// VACIAR CARRITO
if (isset($_GET['accion']) && $_GET['accion'] == 'vaciar') {
	unset ($_SESSION['carrito']);
}

// CAMBIAR CANTIDAD
if (isset($_GET['accion']) && $_GET['accion'] == 'sumar') {

	$id = $_GET['id'];
	$_SESSION['carrito'][$id] ++;
}
if (isset($_GET['accion']) && $_GET['accion'] == 'restar') {

	$id = $_GET['id'];
	$_SESSION['carrito'][$id] --;

	if ($_SESSION['carrito'][$id] == 0) {
		unset ($_SESSION['carrito'][$id]);
	}
}

// INICIALIZACIÓN DE VARIABLES
$productos = array();
$subtotal=0; 
$total=0; 

// MOSTRAR PRODUCTOS AL CARRITO
if ( isset ($_SESSION['carrito']) ) {

	$productos = seleccionar_productos_carrito($conexion, $_SESSION['carrito']);

	if (count ($_SESSION['carrito']) > 0) {

		$subtotal = calcular_subtotal_carrito( $conexion, $_SESSION['carrito']);

		$total = $subtotal + ENVIO;

	}
} 

?>

        	<div class="row">
            
            	<div class="span9">
                
                	<table class="table table-bordered carrito">
                		
						<tr>
							
							<th class="cod">Código</th>
							<th class="prod">Producto</th>
							<th class="pre">Precio</th>
							<th class="cant">Cantidad</th>
							<th class="acc">Eliminar</th>
							
						</tr>
						
						<?php if (count ($productos) == 0) : ?>	

						 <tr><td colspan="5"><h5 class="muted">El carrito está vacío</h5></td></tr> 

						<?php else : 
							foreach ($productos as $producto) : ?>	

								<tr>
									<td><?php echo $producto['id']; ?></td>
									<td><a href="detalle_producto.php?id=<?php echo $producto['id']; ?>"><?php echo $producto['marca'] . ' ' . $producto['modelo'];  ?>
										</a>
									</td>
									<td><?php echo number_format( $producto['precio'], 2); ?></td>
									<td>
										<a href="carrito.php?accion=restar&id=<?php echo $producto['id']; ?>"><i class="icon-minus"></i></a>
										<span class="muted"><?php echo $producto['cantidad']; ?></span>
										<a href="carrito.php?accion=sumar&id=<?php echo $producto['id']; ?>"><i class="icon-plus"></i></a>
									</td>
									<td><a href="carrito.php?accion=eliminar&id=<?php echo $producto['id']; ?>"><i class="icon-remove"></i></a></td>
								</tr>
								
							<?php endforeach; ?>	
						<?php endif; ?>

					</table>
					
					<a href="index.php" class="btn btn-info"><i class="icon-arrow-left icon-white"></i> Seguir comprando</a>
					<a href="pedido.php" class="btn btn-success"><i class="icon-ok icon-white"></i> Finalizar compra</a>

					<a href="carrito.php?accion=vaciar" class="btn btn-danger">Vaciar Carrito</a>
                
                </div>
                
                <div class="span3">
                
                	<div class="well">
                    
                    	<h5><i class="icon-shopping-cart"></i> Tu compra</h5>
                        
                        <hr />
                        
                        <table class="totales pull-right">
                        
                        	<tr>
                            
                            	<td>Subtotal:</td>
                                <td><?php echo number_format($subtotal, 2); ?> &euro;</td>
                            
                            </tr>
							
                            <tr>
                            
                            	<td>Envío:</td>
                                <td><?php echo number_format(ENVIO, 2); ?> &euro;</td>
                            
                            </tr>
                            
                            <tr>
                            
                            	<td><h4>Total:</h4></td>
                                <td><h4 class="text-error"><?php echo number_format($total, 2); ?> &euro;</h4></td>
                            
                            </tr>
                        
                        </table>
                        
                        <div class="clearfix"></div>
                        
                    </div>
                
                </div>
            
            </div>
 

</script>

<?php include('footer.php');?>