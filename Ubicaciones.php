<?php
	include("Libreria/funciones.php");
	$conexion = db_conectar();
	
?>
<!Doctype Html>
<html>
	<HEAD>
		<title>Formulario de ubicaciones</title>
		<link rel="stylesheet" type="text/css" href="estiloss.css">
	</HEAD>
	<body>
		<header>
			Carfax
		</header>
		<?php
			$id = $_GET['id'];
			$Cmd = "select descripcion from ubicaciones where codigo_ubicacion =0$id";
			$resultado=ejecutar_query($Cmd,$conexion);
			$row=traer_fila($resultado);
		?>
		<form class="Contenedor" action="contubicaciones.php?id=<?php echo $id; ?>" method="post" align="center">

		<h1>Formulario de Ubicaciones</h1>
		<br>
			<label for="descripcion">Descripcion</label>
			<input type="text" name="descripcion" value="<?php echo $row[0]; ?>" required>
			<br>
			<?php 
				$Cmd = "select * from ciudades";
				$listado = Ejecutar_query($Cmd,$conexion);
			?>
			<label for="ciudad">Ciudad</label>
			<select name="ciudad">
				<?php
					for($i=1;$row=traer_fila($listado);$i++){
				?>
					<option value="<?php echo $row[0];?>"><?php echo $row[1]; ?></option>
				<?php } ?>
			</select>
			<br>
			<br>
			<input type="submit" name="guardar" value="Guardar">
		</form>
		<?php

			$Cmd = "select codigo_ubicacion,descripcion from Ubicaciones order by 1 desc";
			$listado = Ejecutar_query($Cmd,$conexion);
		?>
		<br>
		<table align="center">
			<tr>
				<th>Codigo</th>
				<th>Descripcion</th>
				<th>Opcion</th>
			</tr>
			<?php for($i=1;$row=traer_fila($listado);$i++){ ?>
			<tr>
				<td><?php echo $row[0]; ?></td>
				<td><?php echo $row[1]; ?></td>
				<td><a href="Ubicaciones.php?id=<?php echo $row[0]; ?>">Editar</a></td>
			<?php } ?>
			</tr>
		</table>
		<footer>
			<div class="footer">
				<p>CopyRigth "CARFAX" </p>
			</div>
		</footer>	
	</body>
<html>