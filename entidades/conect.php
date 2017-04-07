<?php
function crearConexion() {
	$config = parse_ini_file("database.ini");
	$con = new mysqli ($config['SERVER'],$config['USER'],$config['PASSWORD'],$config['NAMEBDD']);
	if ($con->connect_errno > 0){
	die ( "Error en la conexión" );}
	return $con;
};
 ?>