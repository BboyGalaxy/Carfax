<!Doctype html>
<html>
	<head>
		<title>Formulario de Ciudades</title>
		<link rel="stylesheet" type="text/css" href="style.css">
		<!--<meta charset="UTF-8">-->
	</head>
	<body>
		<HEADer>Carfax</HEADer>
	<?php
		include("Libreria/funciones.php");
		$conexion = db_conectar();
		#echo 'esta es la conexion '.$conexion;
		#echo "hola";
	?>
		<?php
		$id = $_GET['id'];
		$Cmd = "select codigo_ciudad,descripcion from ciudades order by 1 desc";
		$listado = Ejecutar_query($Cmd,$conexion);

		$Cmd = "select descripcion from ciudades where codigo_ciudad =0$id";
		$resultado=ejecutar_query($Cmd,$conexion);
		$row=traer_fila($resultado);
	?>
	<div class= "form">
		<form action = "controladores.php?id=<?php echo $id; ?>" method = "POST">
			<h1>Formulario de Ciudades</h1>
			<!--<label for = "codigo_ciudad">Codigo</label>
			<input type = "Text" id="codigo" name="codigo" placeholder="Ingrese el codigo">
			<br>
			<br>-->
			<label for = "descripcion">Descripcion</label>
			<input type = "Text" id="descripcion" name="descripcion"  value="<?php echo $row[0]; ?>" required>
			<br>
			<br>
			<input type = "submit" id= "guardar" value = "Guardar">
			
		</form>
	</div>
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