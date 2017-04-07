<?
include ('lib.inc');

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


include ('conect.inc');

	$sql  = "select * from " . DB_PREFIX . "usuarios ";
	$sql .= "where nro_doc='" . $_POST['usuario'] . "' ";
	$sql .= " and clave='" . $_POST['password'] . "' ";
	$sql .= " and adm='S' and activo='S'";

	$encontrado = false;
	$res = mysql_query($sql);
	if (mysql_num_rows($res) > 0) {
		$encontrado = true;
	}
	mysql_free_result($res);


if (!$encontrado)	{

	?><META HTTP-EQUIV="Refresh" CONTENT="0; URL=<?=LOGIN_PAGE?>"><?
	return;
}


session_start();

unset($_SESSION['nombre']);
$_SESSION['usuario']=$_POST['usuario'];
//header("location: menu.php");

?>
<META HTTP-EQUIV="Refresh" CONTENT="0; URL=<?=MAIN_PAGE?>">
<?

?>
