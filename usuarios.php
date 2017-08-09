<?php 
	include("Libreria/funciones.php");
	$conexion = db_conectar();
?>

<!Doctype html>
<html>
	<HEAD>
		<title>Formulario de usuarios</title>
		<link rel="stylesheet" type="text/css" href="usuarios.css">
	</HEAD>
	<body>
		<header>
			<section id="logo">Carfax</section>
			
		</header>
		<form method="post" action="contusuarios.php">
			<h1>Registro de usuarios</h1>
			<section id="formulario">
			<label for="nombre">Nombre</label>
			<input type="text" name="nombre" required>
			<br>
				<label for="fechanacimiento">Fecha de nacimiento</label>
				<input type="date" name="fechanacimiento" value="<?php echo date("d/m/y"); ?>" required>
				<br>
				<label for="sexo">Sexo</label>
				<select name="sexo">
						<option value="M">Masculino</option>
						<option value="F">Femenino</option>
				</select>
				<br>
				<label for="direccion">Direccion</label>
				<input type="text" name="direccion" required>
				<br>
			<?php
				$Cmd = "select * from ubicaciones";
				$listado = Ejecutar_query($Cmd,$conexion);
			?>
			
				<label for="ubicaion">Ubicacion</label>
				<select name="ubicacion">
					<?php for($i=11; $row=traer_fila($listado);$i++){ ?>
						<option value="<?php echo $row[0]; ?>"><?php echo $row[1]; ?></option>
					<?php } ?>
				</select>
				<br>
				<label for="telefono">Telefono</label>
				<input type="text" name="telefono" required>
				<br>
				<label for="usuario">Nombre de usuario</label>
				<input type="text" name="usuario" required>
				<br>
				<label for="clave">Password</label>
				<td><input type="password" name="clave" required>
			<?php
				$Cmd = "select * from tipos_usuarios";
				$listado = Ejecutar_query($Cmd,$conexion);
			?>
			<br>
			<label for="tipousuario">Tipo de usuario</label>
			<select name="tipousuario">
				<?php for($i=11; $row=traer_fila($listado);$i++){ ?>
					<option value="<?php echo $row[0]; ?>"><?php echo $row[1]; ?></option>
				<?php } ?>
			</select>
			<br>
			<label for="correo">Email</label>
			<input type="text" name="correo" placeholder="Ejemplo@Ejemplo.com" required>
			<br>
			</section>
			<div class="redes">
				<fieldset>
					<legend>Redes</legend>
					
					<label for="facebook">Facebook</label>
					<input type="text" name="facebook" >
					<br>
					<label for="twitter">Twitter</label>
					<input type="text" name="twitter" >
					<br>
					<label for="instagram">Instagram</label>
					<input type="text" name="instagram" >
					<br>
					<label for="whatsapp">Whatsapp</label>
					<input type="text" name="whatsapp" >
					<br>
					<label for="youtube">Youtube</label>
					<input type="text" name="youtube" >
					<br>
					<label for="google+">Google+</label>
					<input type="text" name="google+" >
					
				</fieldset>
			</div>
			<br>
			<input type="submit" value="Registrar" name="registrar">
		</form>
		<footer>
			<div class="footer">
				<p>CopyRight "CARFAX"</p>
			</div>
		</footer>
	</body>
</html>