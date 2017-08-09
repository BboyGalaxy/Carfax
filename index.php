<?php
	session_start();
	if (session_is_registered("inicio")){
		header("Location: inicio.php");
	}
?>
<!Doctype html>
<html lang="es">
	<HEAD>
		<meta charset="utf-8">
		<title>
			Login
		</title>
		<link rel="stylesheet" type="text/css" href="loginn.css">
		<link rel="icon" href="Imagenes/vehiculo.ico">
		<!--<meta charset="UTF-8">-->
	</HEAD>
	<header>
		Carfax
	</header>
	<body>
		<form class="Contenedor" action="inicio.php" method="POST">
			<h1 align="center">
				Login
			</h1>
			<label for="usuario">Usuario</label>
			<br>
			<input type="text" name="usuario" id="usuario"  value="<?php echo $usuario; ?>" required autofocus>
			<br>
			<label for="password" align="center">Clave</label>
			<br>
			<input type="password" name="password" id="password" required>
			<br>
			<br>
			<div class="botones">
				<input type="submit" value="Entrar" name="entrar">
				<input type="submit" name="registrar" onClick="Registrar()" value="Registrar"/>
				<script type="text/javascript">
					function Registrar(){
						window.location="Usuarios.php";
					}
				</script>
				
			</div>
			 <p><font color="#FF0000" size="5" face="Arial, Helvetica, sans-serif">
          		<?php if (isset($usuario)){echo "USUARIO O CONTRASEÑA INCORRECTOS"; }  ?>
        	</font> </p>
		</form>
		<footer>
			<div class="footer">
				<p>Carfax® All rigth reserved.</p>
			</div>
		</footer>
	</body>
</html>