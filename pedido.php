<?php
session_start();

include("funciones.php");
$conexion = conectar();
define ("ENVIO", 49.99);

$subtotal='0'; // si no existe la sesion carrito
$total='0';

if(isset($_SESSION['carrito']) ) {

  if ( count ($_SESSION['carrito']) > 0 ) {

	  $subtotal = calcular_subtotal_carrito( $conexion, $_SESSION['carrito']);
	  $total = $subtotal + ENVIO;
  }
}

if ( $total == 0){header('Location:carrito.php'); } 
// Con esto evitamos que el usuario entre en la página de envio sin seleccionar producto
// pero si entra colocando la direccion directamente, ya tenemos la prevision de que está a 0


// comprobamos el formulario
$mensaje='';

$nombre='';
$email='';
$movil='';
$direccion='';
$ciudad='';
$provincia='';
$cp='';

 if ($_POST) {

     $nombre=$_POST['nombre'];
     $email=$_POST['email'];
     $movil=$_POST['movil'];
     $direccion=$_POST['direccion'];
     $ciudad=$_POST['ciudad'];
     $provincia=$_POST['provincia'];
     $cp=$_POST['cp'];

     // verificamos que estan rellenos todos los campos
    foreach ($_POST as $campo => $valor){
        if (empty($valor) ){
                $mensaje ="<h5 class='text-error'> Debe rellenar todos los campos </h5>";
                break;
        }
    }
    // ejecutamos la funcion que inserta los datos del cliente en la base de datos y obtenemos
    // la id del registro
    $id_cliente = guardar_cliente($conexion, $_POST);

    guardar_pedido($conexion, $id_cliente, $_SESSION['carrito']);

    unset($_SESSION['carrito']);

    header('Location:gracias.php');
}
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Detalle de producto</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8" />
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
  </head>
  
  <body>
    <div class="container">
        
            <div class="page-header">
            
                <h2 class="pull-left">Tienda de bicis <small>Lorem ipsum</small></h2>
                
                <a href="carrito.php" class="btn btn-info pull-right" id="boton-carrito"><i class="icon-shopping-cart icon-white"></i> Ver carrito</a>
                
                <div class="clearfix"></div>
                
            </div>
        
    </div>

    <div class="container">       
        	<div class="row">
            
            	<div class="span7">
                    <?php echo $mensaje; ?>
                	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="form-horizontal">
                    
                    	<fieldset>
                        
                        	<legend>Datos de contacto</legend>
                            
                            <p>
                            	<label for="nombre">Nombre completo:</label>
                            	<input type="text" name="nombre" id="nombre" class="input-large" value="<?php echo $nombre; ?>" />
                            </p>
                            
                            <p>
                            	<label for="email">Email:</label>
                            	<input type="text" name="email" id="email" class="input-large" value="<?php echo $email; ?>"/>
                            </p>
                            
                            <p>
                            	<label for="movil">Teléfono móvil:</label>
                            	<input type="text" name="movil" id="movil" class="input-medium" value="<?php echo $movil; ?>" />
                            </p>
                        
                        </fieldset>
                        
                        <fieldset>
                        
                        	<legend>Datos de envío</legend>
                            
                            <p>
                            	<label for="direccion">Dirección:</label>
                            	<input type="text" name="direccion" id="direccion" class="input-xxlarge" value="<?php echo $direccion; ?>"/>
                            </p>
                            
                            <p>
                            	<label for="ciudad">Ciudad:</label>
                            	<input type="text" name="ciudad" id="ciudad" class="input-medium" value="<?php echo $ciudad; ?>" />
                            </p>
                            
                            <p>
                            	<label for="provincia">Provincia:</label>
                            	<input type="text" name="provincia" id="provincia" class="input-medium" value="<?php echo $provincia; ?>"/>
                            </p>
                            
                            <p>
                            	<label for="cp">Código postal:</label>
                            	<input type="text" name="cp" id="cp" class="input-mini" value="<?php echo $cp; ?>"/>
                            </p>
                        
                        </fieldset>
                    
                    	<div class="form-actions">
                        
							<a href="index.php" class="btn btn-danger"><i class="icon-ban-circle icon-white"></i> Cancelar</a>
                            <button type="submit" class="btn btn-success"><i class="icon-ok icon-white"></i> Pagar</button>
                        
                        </div>
                    
                    </form>
                
                </div>
                
                <div class="span4 offset1">
                
                	<div class="well">
                    
                    	<h5><i class="icon-shopping-cart"></i> Tu compra</h5>
                        
                        <hr />
                        
                        <table class="totales pull-right">
                        
                        	<tr>
                            
                            	<td>Subtotal:</td>
                                <td><?php echo number_format($subtotal,2); ?> &euro;</td>
                            
                            </tr>
							
                            <tr>
                            
                            	<td>Envío:</td>
                                <td><?php echo number_format(ENVIO,2); ?> &euro;</td>
                            
                            </tr>
                            
                            <tr>
                            
                            	<td><h4>Total:</h4></td>
                                <td><h4 class="text-error"><?php echo number_format($total,2); ?> &euro;</h4></td>
                            
                            </tr>
                        
                        </table>
                        
                        <div class="clearfix"></div>
                        
                    </div>
                
                </div>
            
            </div>
            
<?php include('footer.php'); ?>