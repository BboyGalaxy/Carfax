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
		<section id="logo"><a href="inicio.php">Carfax</a></section>
		
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
						<li><a href="gastos.php"><img src="Imagenes\181501-interface\181501-interface\png\document-1.png" width="30" height="30">Gastos </a></li>
						<li><a href="inicio.php?vSalir=1"><img src="Imagenes\181501-interface\181501-interface\png\padlock.png" width="30" height="30"> Cerrar Sesion</a></li>
					</ul>
				</nav>
		</aside>
		<section id="documentos">
			<form action="contvehiculos.php" method="post">
				<h2>Registro de vehiculos</h2>
				<br>
				<label for="marca">Marca</label>
				<input type="text" name="marca" required autofocus>
				<br>
				<label for"modelo">Modelo</label>
				<input type="text" name="modelo" required>
				<br>
				<label for="año">Año</label>
				<input type="number" name="año" required>
				<br>
				<label for="kilometraje">Kilometraje</label>
				<input type="number" name="kilometraje" required>
				<br>
				<label for="referencia">Referencia</label>
				<input type="text" name="referencia">
				<br>
				<label for="comentario">Comentario</label>
				<input type="textarea" name="comentario">
				<br>
				<label for="foto">Foto</label>
				<input type="file" name="foto">
				<br>
				<input type="submit" name="guardar" value="Guardar">
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