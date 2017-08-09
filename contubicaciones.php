<?php
	include("Libreria/funciones.php");
	$conexion = db_conectar();
	$id = $_GET['id'];
	$descripcion = $_REQUEST['descripcion'];
	$codigo_ciudad = $_REQUEST['ciudad'];
	
	$Cmd = "select isnull(count(descripcion),0) as cantidad from ubicaciones where codigo_ubicacion=0$id";
	$resultado = Ejecutar_Query($Cmd,$conexion);
	$row = traer_fila($resultado);
	$num =$row[0];
	if($num > 0){
		$Cmd = "update Ubicaciones set descripcion = '$descripcion' , codigo_ciudad = $codigo_ciudad where codigo_ubicacion=$id";
	}
	else{
		$Cmd = "select MAX(codigo_ubicacion)+ 1 as codigo from ubicaciones";
		$resultado = Ejecutar_Query($Cmd,$conexion);
		$row = traer_fila($resultado);
		$num =$row[0];
		$Cmd = "insert into Ubicaciones(codigo_ubicacion,descripcion,codigo_ciudad) values($num,'$descripcion',$codigo_ciudad)";
	}
	//echo $Cmd;
	//die();
	Ejecutar_Query($Cmd,$conexion);
	header("Location: Ubicaciones.php");



?>