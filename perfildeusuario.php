<?php
	include('Libreria\funciones.php');
	$conexion = db_conectar();
	session_start();
?>
<!Doctype html>
<html lang="es">
	<HEAD>
		<meta charset="utf-8">
		<title>
			Carfax
		</title>
		<link rel="stylesheet" type="text/css" href="main.css">
		<link rel="icon" href="Imagenes/vehiculo.ico">
		<!--<meta charset="UTF-8">-->
	</HEAD>
	<header>
		<section id="logo"><a href="inicio.php?usuario=<?php echo $nombre ?>">Carfax</a></section>
		
		<section id="usuario"><a href="perfildeusuario.php"><?php echo $nombre; ?> </a></section>
		<section id="fotousuario"><img src="Imagenes\181501-interface\181501-interface\png\user-3.png"> </section>
		
	</header>
	<body>
		<main>
			<aside id="menu">
				<nav>
					<ul>
						<li><a href="documentos.php"><img src="Imagenes\181501-interface\181501-interface\png\document-3.png" width="30" height="30">Documentos</a></li>
						<li><a href="vehiculos.php"><img src="Imagenes\181501-interface\181501-interface\png\airplane.png" width="30" height="30">Vehiculos</a></li>
						<li><a href="consulta.php"><img src="Imagenes\181501-interface\181501-interface\png\internet.png" width="30" height="30">Consulta General</a></li>
						<li><a href="gastos.php"><img src="Imagenes\181501-interface\181501-interface\png\document-1.png" width="30" height="30">Gastos</a></li>
						<li><a href="inicio.php?vSalir=1"><img src="Imagenes\181501-interface\181501-interface\png\padlock.png" width="30" height="30"> Cerrar Sesion</a></li>
					</ul>
				</nav>
		</aside>
		<section id="documentos">
			<form action="contusuarios.php" method="post">
				<h2>Perfil de usuario</h2>
				<br>
				<?php
					$Cmd = "select us.nombre,us.fecha_nacimiento,us.sexo,us.direccion,ub.descripcion,us.telefono,us.identidad,us.clave,tu.descripcion,us.correos,us.facebook,us.twitter,us.instagram,us.whatsapp,us.youtube,us.[google+] from usuarios as us
					inner join ubicaciones as ub on us.codigo_ubicacion = ub.codigo_ubicacion
					inner join tipos_usuarios as tu on us.tipo_usuario = tu.tipo_usuario
					where us.codigo_usuario = $codigo_usuario";
					$resultado = Ejecutar_query($Cmd,$conexion);
					$row = traer_fila($resultado);
					//echo $row[0];
					//die();
				?>
				<label for="nombre">Nombre</label>
			<input type="text" name="nombre" value ="<?php echo $row[0]; ?>"  required>
			<br>
				<label for="fechanacimiento">Fecha de nacimiento</label>
				<input type="date" name="fechanacimiento" value="<?php echo $row[1]; ?>" required>
				<br>
				<label for="sexo">Sexo</label>
				<select name="sexo" value="">
						<?php if($row[2] == "M"): ?>
							<option value="M" selected>Masculino</option>
							<option value="F">Femenino</option>
						<?php else: ?>
							<option value="M" >Masculino</option>
							<option value="F" selected>Femenino</option>
						<?php endif; ?>
				</select>
				<br>
				<label for="direccion">Direccion</label>
				<input type="text" name="direccion" value="<?php echo $row[3]; ?>" required>
				<br>
			<?php
				$Cmd = "select * from ubicaciones";
				$listado = Ejecutar_query($Cmd,$conexion);
			?>
			
				<label for="ubicaion">Ubicacion</label>
				<select name="ubicacion" >
					<?php for($i=11; $ub=traer_fila($listado);$i++){ ?>
						<option value="<?php echo $ub[0]; ?>"><?php echo $ub[1]; ?></option>
					<?php } ?>
				</select>
				<br>
				<label for="telefono">Telefono</label>
				<input type="text" name="telefono" value = "<?php echo $row[5]; ?>" required>
				<br>
				<label for="usuario">Nombre de usuario</label>
				<input type="text" name="usuario" value = "<?php echo $row[6]; ?>" required>
				<br>
				<label for="clave">Password</label>
				<td><input type="password" name="clave" value = "<?php echo $row[7]; ?>" required>
			<?php
				$Cmd = "select * from tipos_usuarios";
				$listado = Ejecutar_query($Cmd,$conexion);
			?>
			<br>
			<label for="tipousuario">Tipo de usuario</label>
			<select name="tipousuario" value = "<?php echo $row[8]; ?>">
				<?php for($i=11; $tu=traer_fila($listado);$i++){ ?>
					<option value="<?php echo $tu[0]; ?>"><?php echo $tu[1]; ?></option>
				<?php } ?>
			</select>
			<br>
			<label for="correo">Email</label>
			<input type="text" name="correo" placeholder="Ejemplo@Ejemplo.com" value = "<?php echo $row[9]; ?>" required>
			<br>
			</section>
			<div class="redes">
				<fieldset>
					<legend>Redes</legend>
					
					<label for="facebook">Facebook</label>
					<input type="text" name="facebook" value = "<?php echo $row[10]; ?>">
					<br>
					<label for="twitter">Twitter</label>
					<input type="text" name="twitter" value = "<?php echo $row[11]; ?>">
					<br>
					<label for="instagram">Instagram</label>
					<input type="text" name="instagram" value = "<?php echo $row[12]; ?>">
					<br>
					<label for="whatsapp">Whatsapp</label>
					<input type="text" name="whatsapp" value = "<?php echo $row[13]; ?>">
					<br>
					<label for="youtube">Youtube</label>
					<input type="text" name="youtube" value = "<?php echo $row[14]; ?>">
					<br>
					<label for="google+">Google+</label>
					<input type="text" name="google+" value = "<?php echo $row[15]; ?>">
					
				</fieldset>
			</div>
			<br>
			<input type="submit" value="Guardar" name="guardar">
			</form>
		</section>
	</main>
		<footer>
			<div class="footer">
				<p>Carfax® All rigth reserved.</p>
			</div>
		</footer>
	</body>
</html>