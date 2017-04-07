<?
include ('lib.php');

if ( (!isset($_POST['usuario'])) || (!isset($_POST['password'])) )	{
//	header("location: index.php");
?>
<META HTTP-EQUIV="Refresh" CONTENT="0; URL=<?=LOGIN_PAGE?>">	
<?
	return;
}

if ( $_POST['usuario'] == "" )	{
	?><META HTTP-EQUIV="Refresh" CONTENT="0; URL=<?=LOGIN_PAGE?>"><?
	return;
}


include ('conect.php');

	$sql  = "select * from " . DB_PREFIX . "usuarios ";
	$sql .= "where nro_doc='" . $_POST['usuario'] . "' ";
	$sql .= " and clave='" . $_POST['password'] . "' ";
	$sql .= " and activo='S'";

	$encontrado = false;
	$res = mysql_query($sql);
	if (mysql_num_rows($res) > 0) {
		$encontrado = true;
		$nombre = mysql_result($res,0,'nombre');
		$apellido = mysql_result($res,0,'apellido');
		$id = mysql_result($res,0,'id');
		$foto = mysql_result($res,0,'foto');
		$jerarquia = mysql_result($res,0,'jerarquia');
		session_start();

		unset($_SESSION['nombre']);
		$_SESSION['usuario']=$_POST['usuario'];
		$_SESSION['nombre']=$nombre." ".$apellido;
		$_SESSION['idUsuario']=$id;
		$_SESSION['imageProfile']=$foto;
		$_SESSION['jerarquia']=$jerarquia;
		//header("location: menu.php");
		$_SESSION['evento']="N";
		mysql_free_result($res);
		$sql = "SELECT * FROM tcalendario where id_usuario = ".$id." and fecha = date(now())";
		//print($sql);
		$res = mysql_query($sql);
		if (mysql_num_rows($res) > 0) {
			$_SESSION['evento']="Y";
		}
	}
	mysql_free_result($res);

	getBirthDays();

	
if (!$encontrado)	{

	?><META HTTP-EQUIV="Refresh" CONTENT="0; URL=<?=LOGIN_PAGE?>"><?
	return;
}




?>
<META HTTP-EQUIV="Refresh" CONTENT="0; URL=<?=MAIN_PAGE?>">
<?

?>
