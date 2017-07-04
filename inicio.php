<?php 
include('libreria/funciones.php');
$link=db_conectar();
session_start();
if (session_is_registered("vs")==false){
		$sql="select identidad,nombre from usuarios where identidad='".$_REQUEST['usuario']."' and clave='".$_REQUEST['password']."'";
		 //echo $sql;
		 //die;	
		$res=ejecutar_query($sql,$link);
		
		if(mssql_num_rows($res)){		
			$row=traer_fila($res);
			session_register("varocu");
			$_SESSION["vs"] ='1';			
			$varocu=$row[0];
			//echo $row[1];
		}else
		{
			session_destroy();
			header("Location: index.php?usuario=$usuario");
			exit;
		}
}
if(isset($_REQUEST['vSalir'])){
	session_destroy();
			header("Location: index.php?usuario=$usuario");
	exit;
}
?>

<!Doctype html>
<html>
	<HEAD>
		<title>
			Carfax
		</title>
		<link rel="stylesheet" type="text/css" href="estilos.css">
		<!--<meta charset="UTF-8">-->
	</HEAD>
	<header>
		Carfax
	</header>
	<body>
		<nav>
			<ul>
				<li>Usuarios</li>
				<li><a href="tiposusuarios.php">Tipos de usuarios</a></li>
				<li><a href="Ciudades.php">Ciudades</a></li>
				<li><a href="inicio.php?vSalir=1">Cerrar Sesion</a></li>
			</ul>
		</nav>
	</body>
</html>