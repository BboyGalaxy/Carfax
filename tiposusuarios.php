<!Doctype html>
<html>
	<HEAD>
		<title>
			Tipos de usuarios
		</title>
		<link rel="stylesheet" type="text/css" href="estiloss.css">
		<!--<meta charset="UTF-8">-->
	</HEAD>
	<header>
		Carfax
	</header>
	<body>
		<?php
			include("Libreria/funciones.php");
			$conexion = db_conectar();

			$id = $_GET['id'];
			$Cmd = "select * from tipos_usuarios order by 1 desc";
			$listado = ejecutar_query($Cmd,$conexion);

			$Cmd = "select descripcion from tipos_usuarios where tipo_usuario=0$id";
			$resultado=ejecutar_query($Cmd,$conexion);
			$row=traer_fila($resultado);
		?>
		
		<form class="Contenedor" action="contipos.php?id=<?php echo $id; ?>" method="POST" align="center">
			<label for="descripcion">Descripcion</label>
			<input type="text" name="descripcion" value="<?php echo $row[0]; ?>" required>
			<br>
			<br>
			<input type="submit" name="guardar" value="Guardar">
			<br>
			<br>
		</form>
		<table align="center" border="1">
			<tr>
				<th>Codigo</th>
				<th>Descripcion</th>
				<th>Opcion</th>
			</tr>
			<?php for($i=1;$row=traer_fila($listado);$i++){ ?>
			<tr>
				<td><?php echo $row[0]; ?></td>
				<td><?php echo $row[1]; ?></td>
				<td><a href="tiposusuarios.php?id=<?php echo $row[0]; ?>">Editar</td>
			</tr>
			<?php } ?>
		</table>
		<footer>
			<div class="footer">
				<p>CopyRigth "CARFAX" </p>
			</div>
		</footer>	
	</body>
</html>