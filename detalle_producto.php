<?php
include('header.php');

// capturamos la id
  if (isset( $_GET['id']) && !empty( $_GET['id']) ){

  	$producto = seleccionar_registro($conexion, 'productos', $_GET['id'] );
  }

?>
 <!-- Aqui no necesitamos un while, al extraer la id de la url -->
		<div class="row">
			<div class="span7">
				<h3><?php echo $producto['marca'] . $producto['modelo']; ?></h3>
				<?php echo $producto['descripcion']; ?>
			</div>
			<div class="span5">

				<div class="thumbnail">
					<img src="img/productos/<?php echo $producto['imagen']; ?>" 
                         alt="<?php echo $producto['marca'] . $producto['modelo']; ?>" />
				</div>
				
				<h3 class="text-error"><?php echo number_format($producto['precio'], 2, ',', '.'); ?></h3>
				<a href="carrito.php?accion=agregar&id=<?php echo $producto['id']; ?>" class="btn btn-success pull-left">
					Comprar</a>
			</div>

		</div>



<?php include('footer.php'); ?>