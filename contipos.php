<?php
    include("Libreria/funciones.php");
    $conexion = db_conectar();
	
		$descripcion = $_REQUEST['descripcion'];
		$Cmd = "select isnull(count(descripcion),0) from tipos_usuarios where tipo_usuario=0$id";
		$resultado = ejecutar_query($Cmd,$conexion);
		$row=traer_fila($resultado);
		$num = $row[0];

		if($num > 0){
			$Cmd = "update tipos_usuarios set descripcion = '$descripcion' where tipo_usuario =$id ";
		}
		else{
			$Cmd = "insert into tipos_usuarios(descripcion) values('$descripcion')";
		}
		
		ejecutar_query($Cmd,$conexion);
		header("Location: tiposusuarios.php");
	


?>