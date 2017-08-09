<?php 
include('libreria/funciones.php');
$link=db_conectar();
session_start();
if (session_is_registered("inicio")==false){
		$sql="select identidad,nombre,codigo_usuario from usuarios where identidad='$usuario' and clave='$password'";
		 //echo $sql;
		 //die();	
		$res=ejecutar_query($sql,$link);
		
		if(mssql_num_rows($res)){		
			$row=traer_fila($res);
			session_register("inicio");
			$_SESSION['inicio'] = '1';
			session_register("usuario");			
			$usuario=$row[0];
			session_register("nombre");
			$nombre=$row[1];
			session_register("codigo_usuario");
			$codigo_usuario= $row[2];

			
		}else
		{
			session_destroy();
			header("Location: index.php?usuario=$usuario");
			exit;
		}
}
if(isset($_REQUEST['vSalir'])){

	session_destroy();
			header("Location: index.php");
	exit;
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
						<li><a href="gastos.php"><img src="Imagenes\181501-interface\181501-interface\png\document-1.png" width="30" height="30">Gastos</a></li>
						<li><a href="inicio.php?vSalir=1"><img src="Imagenes\181501-interface\181501-interface\png\padlock.png" width="30" height="30"> Cerrar Sesion</a></li>
					</ul>
				</nav>
		</aside>
		<section id="documentos">
			<h2>Vehiculos</h2>

			<table style="width:100%">
				<tr>
					<th>Vehiculo</th>
					<th>Detalle</th>
					<th>Kilometraje</th>
					<th>Gasto</th>

				<tr>
				<p><font color="#FF0000" size="5" face="Arial, Helvetica, sans-serif">
				<?php
					$Cmd="select t1.foto, t1.detalle, t1.valor,isnull(t2.gasto,0) as gasto from documentos as t1
					left join (select documento_afectado,SUM(monto) as gasto from documentos where tipo_documento <> 32 group by documento_afectado) as t2 on  t1.documento = t2.documento_afectado
					where t1.tipo_documento = 1 and codigo_usuario = $codigo_usuario";
					$listado = ejecutar_query($Cmd,$link);
					if(mssql_num_rows($listado)==0){
						echo "No posee vehiculos";
					}
				?>
				</font> </p>
				<?php for($i=1;$row=traer_fila($listado);$i++){ ?>
					<tr>
						<td heigth="50"><?php echo '<img src="'.$row[0].'" width="75" height="50"'; ?></td>
						<td><?php echo $row[1]; ?></td>
						<td><?php echo number_format($row[2])." KM"; ?></td>
						<td><a href="consulta.php?vehiculo=<?php echo $row[0]?>"><?php echo "$".number_format($row[3]); ?></a></td>
						
					<tr>
				<?php } ?>
			</table>
		</section>
		<article id="anuncios">
			<h2>Anuncios</h2>
			<?php 
				$Cmd = "select top(3) doc.documento,td.descripcion, veh.detalle,doc.monto  from documentos as doc
				left join tipos_documentos as td on td.tipo_documento = doc.tipo_documento
				left join (select documento,detalle from documentos where tipo_documento = 1) as veh on veh.documento = doc.documento_afectado
				where doc.tipo_documento = 32 or doc.tipo_documento = 33 and estado = 1 order by 1 desc";

				$anuncios = ejecutar_query($Cmd,$link);
			?>
			<table id="tanuncios">
				<th>Tipo</th>
				<th>Vehiculo</th>
				<th>Monto</th>
				<?php for($i=1;$row=traer_fila($anuncios);$i++){ ?>
					<tr>
						<td><?php echo $row[1]; ?></td>
						<td><?php echo $row[2]; ?></td>
						<td><?php echo "$".number_format($row[3]); ?></td>						
					<tr>
				<?php } ?>

			</table>
		</article>
		</main>


		<footer>
			<div class="footer">
				<p>Carfax® All rigth reserved. </p>
			</div>
		</footer>
	</body>
</html>