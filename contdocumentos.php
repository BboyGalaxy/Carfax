<?php 
	session_start();
	include('Libreria\funciones.php');
	$conexion = db_conectar();



	$Cmd = "select ISNULL(MAX(documento),0) + 1 as documento from documentos";
	$resultado = Ejecutar_query($Cmd, $conexion);
	$row = Traer_fila($resultado);
	$documento = $row[0];
	$documento_afectado = $_REQUEST['vehiculo'];
	$tipo_documento = $_REQUEST['tipo_documento'];

	//Cmd = "select descripcion from tipos_documentos where tipo_documento  = $tipo_documento";
	//$resultado = Ejecutar_query($Cmd, $conexion);
	//$row = Traer_fila($resultado);
	//$detalle = $row[0];
	$detalle = $_REQUEST['detalle'];
	$fecha = date("Y/m/d");
	$valor = $_REQUEST['kilometraje'];
	$monto = $_REQUEST['monto'];
	$hora = date("h:i");
	$usuario_secundario = $_POST['usuariosecundario'];
	$cometario = $_REQUEST['comentario'];
	$referencia = $_REQUEST['referencia'];

	$Cmd = "insert into documentos(documento,detalle,tipo_documento,fecha,codigo_usuario,fecha_registro,documento_afectado,valor,monto,hora,codigo_usuario_secundario,estado,comentario,referencia,foto)
	values($documento,'$detalle',$tipodocumento,'$fecha',$codigo_usuario,'$fecha',$vehiculo,$valor,$monto,'$hora',$usuario_secundario,1,'$comentario','$referencia','')";
	//echo $Cmd;
	//die();
	Ejecutar_query($Cmd,$conexion);

	$Cmd = "update documentos set valor = $valor where documento = $vehiculo";
	Ejecutar_query($Cmd,$conexion);

	header("Location:documentos.php");





?>