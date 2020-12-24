<?php

	session_start();

	if (!isset ($_SESSION['usuario'] ) ) header('Location:login.php');

	include( 'funciones.php' );
	
	$conexion = conectar();

?>
<!DOCTYPE html>
<html lang="es">

	<head>
    
		<meta charset="utf-8" />
		<title>Panel de control</title>
        
		<!-- Bootstrap -->
		<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">

        <!-- Estilos -->
		<link href="css/estilos.css" rel="stylesheet" media="screen">
        
	</head>
    
	<body>
    
    	<div class="navbar navbar-static-top navbar-inverse">
    		
			<div class="navbar-inner">
				
				<div class="container">
					
					<a href="index.php" class="brand">Panel de control</a>
					
                	<ul class="nav pull-right">
                
                    	<li><a href="editar_usuario.php?id=<?php echo id_usuario($conexion, $_SESSION['usuario']); ?>"><i class="icon-user icon-white"></i><?php echo $_SESSION['usuario']; ?></a></li>
                              
                        <li><a href="logout.php"><i class="icon-off icon-white"></i> Cerrar sesión</a></li>
                    
                    </ul>
					
				</div>
				
			</div>
			
    	</div>
    
		<div class="container"><!-- /cabecera -->