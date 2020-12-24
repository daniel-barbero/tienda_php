<?php
session_start();
define ("ENVIO", 49.99);
include('funciones.php');

$conexion = conectar();
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