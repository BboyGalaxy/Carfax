<?php 
function db_conectar()
{
	$link=mssql_connect('ADELSON', 'webmaster', 'atiradeonhd23') or die ('no se ha podido conectar con la base de datos:' .mssql_error());
	mssql_select_db("carfax");
	return $link;
}


function buscame($sql,$link){
$res=ejecutar_query($sql,$link);
$row=traer_fila($res);
return $row[0];
}

function buscame_fila($sql,$link){
$res=ejecutar_query($sql,$link);
$row=traer_fila($res);
return $row;
} 

function traer_fila($resultado){
$fila=mssql_fetch_row($resultado);
return $fila;
} 


function ejecutar_query($sql,$link){
$resultado=mssql_query($sql,$link);
return $resultado;
}





?>