<?php
	include('Libreria\funciones.php');
	$conexion = db_conectar();
	session_start();

	$filtro = "where codigo_usuario = $codigo_usuario and tipo_documento <> 1 ";
				$vehiculo = $_POST['vehiculo'];
				$tipo_documento = $_POST['tipodocumento'];
				$desde = $_POST['desde'];
				$hasta = $_POST['hasta'];
				//echo $vehiculo." ".$tipo_documento." ".$desde." ".$hasta;
				$veh = $_GET['vehiculo'];
				if(isset($veh))
					$vehiculo = $veh;
				if(isset($vehiculo) and $vehiculo <> 0){

					$filtro = $filtro." and documento_afectado = ".$vehiculo;
			
				}

				if(isset($tipo_documento) and $tipo_documento <> 0){
					$filtro = $filtro." and tipo_documento = ".$tipo_documento;
				}

				if(isset($desde) and $desde <> ""){
					$filtro = $filtro." and fecha >= '".$desde."'";
				}

				if(isset($hasta) and $hasta <> ""){
					$filtro = $filtro." and fecha <= '".$hasta."'";
				}

				$Cmd = "select documento,detalle,fecha,monto,documento_afectado,tipo_documento from documentos ".$filtro." order by 1 desc";
				//ECHO $Cmd;

				$documentos = Ejecutar_query($Cmd,$conexion);
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
			<form action="consulta.php" method="post">
				<h2>Consulta General</h2>
				<br>
				<?php
					$Cmd = "select documento,detalle from documentos where tipo_documento = 1 and codigo_usuario = $codigo_usuario";
					$listado = Ejecutar_query($Cmd,$conexion);
				?>
				<label for="vehiculo">Vehiculo</label>
				<select name="vehiculo">
					<option value="0">       </option>
					<?php for($i=1; $vehiculos=traer_fila($listado);$i++){ ?>
						<option value="<?php echo $vehiculos[0]; ?>"><?php echo "[".$vehiculos[0]."]"."  ".$vehiculos[1]; ?></option>
					<?php } ?>
				</select>
				<br>
				<?php
					//buscar manera 
					$Cmd = "select td.tipo_documento,td.descripcion from tipos_documentos as td
					inner join documentos as doc on td.tipo_documento = doc.tipo_documento
					where td.tipo_documento <> 1 and codigo_usuario = $codigo_usuario group by td.tipo_documento,td.descripcion";

					$listado = Ejecutar_query($Cmd,$conexion);
				?>
				<label for="tipodocumento">Tipo de documento</label>
				<select name="tipodocumento">
					<option value="0">     </option>
					<?php for($i=1; $tipo=traer_fila($listado);$i++){ ?>
						<option value="<?php echo $tipo[0]; ?>"><?php echo $tipo[1]; ?></option>
					<?php } ?>
				</select>
				<br>
				<label for="desde" class="lcons" id="leftcons">Desde</label>
				<input type="date" name="desde" class="cons" value="<?php echo $desde?>">
				<label for="hasta" class="lcons" >Hasta</label>
				<input type="date" name="hasta" class="cons" value="<?php echo $hasta?>">
				<br>
				<br>
				<input type="submit" name="buscar" value="Buscar">
			</form>
			<br>
			<p><font color="#FF0000" size="5" face="Arial, Helvetica, sans-serif">
				<?php
					if(mssql_num_rows($documentos)==0):
						echo "No posee Documentos";
					
				?>
				</font> </p>
				<?php
					else:
				?>
				<table style="width:100%">
					<th>Documento</th>
					<th>Vehiculo</th>
					<th>Descripcion</th>
					<th>Fecha</th>
					<th>Monto</th>
					<?php for($i=1;$doc=traer_fila($documentos);$i++){ ?>
						<tr>
							<td><?php echo $doc[0] ?></td>
							<td><?php echo $doc[4] ?></td>
							<td><?php echo $doc[1] ?></td>
							<td><?php echo $doc[2] ?></td>
							<td><?php echo "$".number_format($doc[3]) ?></td>
						</tr>
					<?php if($doc[5] != 32){$total = $total + $doc[3];}
					}	
					?>

				</table>
				
				<section id="total">
					<section id="letrero">
						Total:
					</section>
					<section id="monto">
						<?php echo "$".number_format($total);	?>
					</section>
				</section>
				<?php endif; ?>
		</section>
	</main>
		<footer>
			<div class="footer">
				<p>Carfax® All rigth reserved.</p>
			</div>
		</footer>
	</body>
</html>