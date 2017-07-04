<!Doctype html>
<html>
	<HEAD>
		<title>
			Login
		</title>
		<link rel="stylesheet" type="text/css" href="login.css">
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
			<input type="text" name="usuario" id="usuario"  value="<?php echo $usuario; ?>" required>
			<br>
			<label for="password" align="center">Clave</label>
			<br>
			<input type="password" name="password" id="password" required>
			<br>
			<br>
			<input type="submit" value="Entrar">
			 <p><font color="#FF0000" size="10" face="Arial, Helvetica, sans-serif">
          		<?php if (isset($usuario)){echo "USUARIO NO EXISTE"; }  ?>
        	</font> </p>
		</form>
	</body>
</html>