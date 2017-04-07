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

	$sql  = "select * from users_entidades ";
	$sql .= "where nombre='" . $_POST['usuario'] . "' ";
	$sql .= " and clave='" . $_POST['password'] . "' ";


	$encontrado = false;
	$res = mysql_query($sql);
	if (mysql_num_rows($res) > 0) {
		$encontrado = true;
		$nombre = mysql_result($res,0,'nombre');
		$cuit = mysql_result($res,0,'cuit');
		$id = mysql_result($res,0,'id');
		$email = mysql_result($res,0,'email');
		$codigo = mysql_result($res,0,'codigo');
	
		session_start();

		unset($_SESSION['nombre']);
		$_SESSION['usuario']=$_POST['usuario'];
		$_SESSION['codigo'] = $codigo;
		$_SESSION['idUsuario']=$id;
		$_SESSION['email']=$email;
		$_SESSION['start'] = time();
		$minutos = 60;
		$_SESSION['expire'] = $_SESSION['start'] + ($minutos * 60);

		//header("location: menu.php");
	}
	mysql_free_result($res);
	
if (!$encontrado)	{

	?><META HTTP-EQUIV="Refresh" CONTENT="0; URL=<?=LOGIN_PAGE?>"><?
	return;
}




?>
<META HTTP-EQUIV="Refresh" CONTENT="0; URL=<?=MAIN_PAGE?>">
<?

?>
