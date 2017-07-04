<?php
	include("Libreria/funciones.php");
	$conexion = db_conectar();
	// var_dump("hey");
	// die();
	$descripcion = $_POST['descripcion'];
	//$id = $_GET['id'];
	$Cmd = "select isnull(count(descripcion),0) as cantidad from ciudades where  codigo_ciudad =0$id";
	$resultado=ejecutar_query($Cmd,$conexion);
	$row=traer_fila($resultado);
	$num=$row[0];

	if($num > 0){
		$Cmd = "update ciudades set descripcion = '$descripcion' where codigo_ciudad =$id";

	}
	else{
		$Cmd = "insert into ciudades values('$descripcion')";
	}
	//echo $Cmd;
	//die();
	
	ejecutar_query($Cmd,$conexion);
	header("Location:ciudades.php");
?>