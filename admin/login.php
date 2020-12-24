<?php

include('funciones.php');

$conexion = conectar();

$mensaje='';
$usr='';
$pwd='';

if ($_POST) {

	$usr = $_POST['usr'];
	$pwd = $_POST['pwd'];

	if (empty($usr) || empty($pwd) ){

		$mensaje = '<h5 class="text-error">Debes escribir tu nombre de usuario y contraseña</h5>';
	} else {

		if ( !login($conexion, $usr, $pwd) ){
			
			$mensaje = '<h5 class="text-error">El usuario y/o contraseña no coinciden</h5>';

		} else {

			session_start();

			$_SESSION['usuario'] = $usr;

			header('Location:index.php');		}
	}

}

?>

<!DOCTYPE html>
<html lang="es">

	<head>
    
    	<meta charset="utf-8" />
    
		<title>Inicio de sesión</title>
		
        <!-- Bootstrap -->
		<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
        
        <link href="css/estilos.css" rel="stylesheet" media="screen">
	
    </head>
    
	<body class="gris">
		
		<div class="container login">
			
			<form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
				
				<h2>Inicio de sesión</h2>
				
				<p>
					<input type="text" name="usr" class="input-block-level" placeholder="Nombre de usuario" value="<?php echo $usr; ?>">
				</p>
				
				<p>
					<input type="password" name="pwd" class="input-block-level" placeholder="Contraseña" value="<?php echo $pwd; ?>">
				</p>
				
				<button class="btn btn-primary">Iniciar sesión</button>
				
			</form>
			<?php echo $mensaje; ?>

		</div>
        
  		<script src="http://code.jquery.com/jquery-latest.js"></script>
		<script src="js/bootstrap.min.js"></script>
	
    </body>
    
</html>