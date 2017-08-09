<?php
	include("Libreria/funciones.php");
	$conexion = db_conectar();
	session_start();


	$nombre = $_REQUEST['nombre'];
	$fecha_nacimiento = $_REQUEST['fechanacimiento'];
	$fecha_registro = date("Y/m/d");
	$sexo = $_REQUEST['sexo'];
	$direccion = $_REQUEST['direccion'];
	$ubicacion = $_REQUEST['ubicacion'];
	$telefono = $_REQUEST['telefono'];
	$usuario = $_REQUEST['usuario'];
	$clave = $_REQUEST['clave'];
	$tipo_usuario = $_REQUEST['tipousuario'];
	$correo = $_REQUEST['correo'];
	$facebook = $_REQUEST['facebook'];
	$twitter = $_REQUEST['twitter'];
	$instagram == $_REQUEST['instagram'];
	$whatsapp = $_REQUEST['whatsapp'];
	$youtube = $_REQUEST['youtube'];
	$google = $_REQUEST['google+'];

	$Cmd = "select max(codigo_usuario) + 1 as codigo from usuarios";
	$resultado = Ejecutar_query($Cmd,$conexion);
	$row = traer_fila($resultado);
	$codigo = $row[0];

	if(isset($registrar)){
		$Cmd = "insert into usuarios(codigo_usuario,tipo_usuario,fecha_registro,nombre,fecha_nacimiento,clave,correos,direccion,codigo_ubicacion,sexo,identidad,telefono,facebook,twitter,instagram,whatsapp,youtube,[google+])
	 values($codigo,$tipo_usuario,'$fecha_registro','$nombre','$fecha_nacimiento','$clave','$correo','$direccion','$ubicacion','$sexo','$usuario','$telefono','$facebook','$twitter','$instagram','$whatsapp','$youtube','$google')";
	}
	else{
		if(isset($guardar)){
			$Cmd = "update usuarios set tipo_usuario = $tipo_usuario, fecha_nacimiento = '$fecha_nacimiento', nombre = '$nombre', clave = '$clave', correos = '$correo', direccion = '$direccion',
			codigo_ubicacion = $ubicacion, sexo = '$sexo', identidad = '$usuario', telefono = '$telefono', facebook = '$facebook', twitter = '$twitter', instagram = '$instagram', whatsapp = '$whatsapp', youtube = '$youtube', [google+] = '$google' where codigo_usuario = $codigo_usuario";
		}
	}


	
	 //echo $Cmd;
	 //die();
	 Ejecutar_query($Cmd,$conexion);

	 header("Location: index.php");
	

?>