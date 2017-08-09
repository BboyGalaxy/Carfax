<?php
	session_start();
	include('Libreria/funciones.php');
	$conexion = db_conectar();

	$Cmd="select ISNULL(MAX(documento),0)+1 as documento from documentos";
	$resultado= Ejecutar_query($Cmd,$conexion);
	$row=traer_fila($resultado);
	$documento=$row[0];
	$detalle = $_POST['marca']." ".$_POST['modelo']." ".$_POST['año'];
	$valor = $_POST['kilometraje'];
	$referencia = $_POST['referencia'];
	$comentario = $_POST['comentario'];
	$fecha_registro = date("Y/m/d");

	$foto = $_POST['foto'];
    $ruta =  $_FILES['foto']['tmp_name']; 
    $destino = "Imagenes/".$foto;
    copy($ruta,$destino);

	$Cmd = "insert into documentos(documento,detalle,tipo_documento,fecha,codigo_usuario,fecha_registro,documento_afectado,valor,codigo_usuario_secundario,estado,comentario,referencia,foto)
	 values($documento,'$detalle',1,'$fecha_registro',$codigo_usuario,'$fecha_registro',0,$valor,0,1,'$comentario','$referencia','$destino')";
	 
	

	 Ejecutar_query($Cmd,$conexion);
	 header("Location: inicio.php");

?>