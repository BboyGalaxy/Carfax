<?php
	include('Libreria\funciones.php');
	$conexion = db_conectar();
	session_start();

	if(isset($buscar)){
		$opcion = $_POST['opcion'];
		switch ($opcion) {
			case 1:
				$Cmd = "select doc.detalle,COUNT(doc.detalle) as cantidad, SUM(det.monto) as total from documentos as doc
				inner join (select documento_afectado,monto from documentos where tipo_documento <> 32  )as det on det.documento_afectado = doc.documento
				where doc.codigo_usuario = $codigo_usuario 
				group by doc.detalle";
				break;
			
			case 2:
				$Cmd ="select us.nombre,count(doc.documento) as cantidad, SUM(doc.monto) as monto from documentos as doc
						inner join usuarios as us on doc.codigo_usuario_secundario = us.codigo_usuario
						group by doc.codigo_usuario,us.nombre 
						having doc.codigo_usuario =$codigo_usuario";
				break;
			case 3:
				$Cmd = "select td.descripcion,COUNT(documento) as cantidad,SUM(monto) as total from documentos as doc
						left join tipos_documentos as td on doc.tipo_documento = td.tipo_documento
						where codigo_usuario = $codigo_usuario and doc.tipo_documento <> 1 and doc.tipo_documento <> 32
						group by td.descripcion";
				break;
			case 4:
				$Cmd="select MONTH(fecha) as mes,COUNT(documento) as cantidad, SUM(monto)	as total from documentos
				where codigo_usuario = $codigo_usuario and tipo_documento <> 1 and tipo_documento <> 32
				group by MONTH(fecha)";
				break;
		}
		$listado = Ejecutar_query($Cmd, $conexion);
	}

	
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
			<form action="gastos.php" method="post">
				<h2>Gastos resumidos</h2>
				<br>
				<label for="opcion">Gastos por:</label>
				<select name="opcion">
					<?php switch($opcion){
						case 1: ?>
						<option value="1" selected>Vehiculos</option>
						<option value="2">Usuario secundario</option>
						<option value="3">Tipos de documentos</option>
						<option value="4">Mes</option>
					<?php break; 
					case 2:?>
						<option value="1" >Vehiculos</option>
						<option value="2" selected>Usuario secundario</option>
						<option value="3">Tipos de documentos</option>
						<option value="4">Mes</option>
					<?php break; 
					case 3:?>
						<option value="1" >Vehiculos</option>
						<option value="2">Usuario secundario</option>
						<option value="3" selected>Tipos de documentos</option>
						<option value="4">Mes</option>
					<?php break; 
					case 4:?>
						<option value="1" >Vehiculos</option>
						<option value="2">Usuario secundario</option>
						<option value="3">Tipos de documentos</option>
						<option value="4" selected>Mes</option>
					<?php break; 
						default:?>
							<option value="1" >Vehiculos</option>
							<option value="2">Usuario secundario</option>
							<option value="3">Tipos de documentos</option>
							<option value="4" >Mes</option>
					<?php break; } ?>

				</select>
				<br>
				<input type="submit" name="buscar" value="Buscar">
				<?php
					switch ($opcion) {
						case 1:
							echo "<br><h2>Gastos por Vehiculos</h2>";
							break;
						
						case 2:
							echo "<br><h2>Gastos por Usuarios secundarios</h2>";
							break;
						case 3:
							echo "<br><h2>Gastos por Tipos de documentos</h2>";
							break;
						case 4:
							echo "<br><h2>Gastos por Mes</h2>";
							break;

					}					
				?>
				<p><font color="#FF0000" size="5" face="Arial, Helvetica, sans-serif">
				<?php
				if(isset($listado))
					if(mssql_num_rows($listado)==0):
						echo "No hay datos";
				?>
				</font></p>
				<?php
					else:
				?>
				<table style="width:100%">
					<?php switch($opcion){ 
						case 1: ?>
						<th>Vehiculo</th>
					<?php break;
						case 2 : ?>
						<th>Usuario secundario</th>
					<?php break;
						case 3: ?>
						<th>Tipo de documento</th>
					<?php break;
						case 4: ?>
						<th>Mes</th>
					<?php break; } ?>

					<th>Cantidad</th>
					<th>Total</th>
					
					<?php for($i=1;$doc=traer_fila($listado);$i++){ ?>
						<tr>
							<td><?php echo $doc[0] ?></td>
							<td><?php echo $doc[1] ?></td>
							<td><?php echo "$".number_format($doc[2]) ?></td>
						</tr>
					<?php }	?>
				</table>
				<?php endif; ?>
	</main>
		<footer>
			<div class="footer">
				<p>Carfax® All rigth reserved.</p>
			</div>
		</footer>
	</body>
</html>