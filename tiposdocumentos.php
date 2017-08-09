<?php
	include("Libreria/funciones.php");
	$conexion = db_conectar();
?>
<!Doctype html>
<html>
	<HEAD>
		<TITLE>Tipos de Documentos</TITLE>
		<link rel="stylesheet" type="text/css" href="style.css">
	</HEAD>
	<body>
		<header>
			Carfax
		</header>
		<?php
			$Cmd = "select descripcion from tipos_documentos where tipo_documento =0$id";
			$resultado=ejecutar_query($Cmd,$conexion);
			$row=traer_fila($resultado);
		?>
		<form action="conttiposdocumentos.php" method="Post">
			<label for="descripcion">Descripcion</label>
			<input type="text" name="descripcion" value="<?php $row[0]; ?>">
			<br>
			<br>
			<input type="submit" value="Guardar" name="guardar">
		</form>
		<?php
		$id = $_GET['id'];
		$Cmd = "select tipo_documento,descripcion from tipos_documentos order by 1 desc";
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
				<td><a href="Ciudades.php?id=<?php echo $row[0]; ?>">Editar</a></td>
			<?php } ?>
			</tr>
		</table>
		<footer>
			<div class="footer">
				<p>CopyRight "CARFAX"</p>
			</div>
		</footer>
	</body>
</html>