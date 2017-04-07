<?
include ('lib.php');
include ('checks.php');


$MAX_NEWS = 2;
$accion = "LISTA";
$RED_FONT = "font-family: Arial, Helvetica, sans-serif; font-size: 11px; color: red";

if (isset($_GET['accion'])) 	{
	$accion=$_GET['accion'];
}


if (($accion != 'LISTA') )	{
	?><META HTTP-EQUIV="Refresh" CONTENT="0; URL=<?=MAIN_PAGE?>"><?
	return;
	}

include ('conect.php');


$TABLA = DB_PREFIX . "telefonos_utiles" ;


//////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////

if ($accion == "LISTA")	{

	$listHeaders = Array(
					Array("titulo" => "Titulo", "campo" => "titulo", "celdas" => "1"),
					Array("titulo" => "Telefono", "campo" => "telefono", "celdas" => "1"),
					Array("titulo" => "Direccion", "campo" => "direccion", "celdas" => "1"),
					Array("titulo" => "E-Mail", "campo" => "mail", "celdas" => "1"),
					Array("titulo" => "Observacion", "campo" => "observacion", "celdas" => "1"),
					Array("titulo" => "Activo", "campo" => "activo", "celdas" => "1"),
					);
	
	$filtro_orderby = "1";	// titulo
	if ((isset($_GET['orderby'])) && (is_numeric($_GET['orderby'])))
	{
		$orderby = $_GET['orderby'];
		if (($orderby >= 0) && ($orderby < sizeof($listHeaders)))
			$filtro_orderby = $orderby;
	}
	$filtro_order = "0";	//ASC
	if ((isset($_GET['order'])) && (is_numeric($_GET['order'])))
	{
		$order = $_GET['order'];
		if (($order == 0) || ($order == 1))
			$filtro_order = $order;
	}


?>

<html>
<head>
<title>Listado de Telefonos Utiles</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="styles.css" type="text/css">
</head>

<body bgcolor="#EBEBEB" link="#153579" vlink="#153579" alink="#153579" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
  <? include ('header2.php');?>

<p align=center><b><font face="Arial, Helvetica, sans-serif" size="3">Listado de Telefonos Utiles</b></p>

<p align=center>
	<input type="button" name="boton2" value="Menú" onclick="location='<?=MAIN_PAGE?>';" style="width:150px"/>
</p>


<table width="80%" border="0" cellspacing="0" cellpadding="0" align="center">

		<tr bgcolor="#BCCCCC" height="25px">
		
		</tr>

		<tr>
		    <td bgcolor="#CCCCCC" colspan="20" height="1"></td>
		</tr>

<?
	
	$sql = "SELECT * FROM $TABLA WHERE activo ='S' ";
//	$sql.= " ORDER BY fecha, id";

	$sql.= " ORDER BY " . $listHeaders[$filtro_orderby]["campo"] . ( ($filtro_order == 0)? " ASC" : " DESC" );

	/*
	if ($filtro_orderby != '')
	{
		$sql .= "ORDER BY " . $filtro_orderby . " " . (($filtro_order == '1') ? "ASC" : "DESC");
	}
	else
		$sql.= "ORDER BY id";
	*/

	//print $sql;

	$res = mysql_query($sql);
	$total = mysql_num_rows($res);

	$idx = 0;
	while ($idx < $total)	{
	
	$id = mysql_result($res, $idx,'id');
	$titulo = mysql_result($res, $idx,'titulo');
	$telefono = mysql_result($res, $idx,'telefono');
	$direccion = mysql_result($res, $idx,'direccion');
	$mail = mysql_result($res, $idx,'mail');
	$observacion = mysql_result($res, $idx,'observacion');
	$activo = mysql_result($res, $idx,'activo');
		
?>
		<tr height="25">
		    <td class="txt_abm">&nbsp;</td>
		    <td class="txt_abm">&nbsp;&nbsp;&nbsp;</td>
		    
		   
		    <td class="txt_abm" width="20%">
		    	<font face="Arial, Helvetica, sans-serif" size="3"><?=$titulo?></font></bold>
		    	</br><?=stripslashes($direccion)?>
				</br><?=$observacion?>
		    </td>

		    <td class="txt_abm">&nbsp;&nbsp;</td>
		    <td class="txt_abm" width="20%">
		    	<?=$telefono?>
		    </td>
		     
		   <td class="txt_abm">&nbsp;&nbsp;</td>

 			<td class="txt_abm" width=20%">
		    	<?=stripslashes($mail)?>
		    </td>
		    <td class="txt_abm">&nbsp;&nbsp;</td>
	</tr>
		<tr>
		    <td bgcolor="#CCCCCC" colspan="20" height="1"></td>
		</tr>
<?
		$idx++;
	}
	mysql_free_result($res);
?>

</table>



<script language="Javascript">
	function ordenarCampo(param)
	{
		window.location = "telefonosUtiles.php?orderby=" + param + "&rnd=" + Math.random();
	}
	function ordenar(param)
	{
		window.location = "telefonosUtiles.php?orderby=<?=$filtro_orderby?>&order=" + param + "&rnd=" + Math.random();
	}
	function borrar(id)	{
		var conf = confirm("¿Está seguro que desea eliminar el telefono?");
		if (conf)	{
			window.location="telefonosUtiles.php?accion=BAJA&id="+id;
		}
	}
</script>

<br>
<br>
<p align=center>
	<input type="button" name="boton2" value="Menú" onclick="location='<?=MAIN_PAGE?>';" style="width:150px"/>
</p>
<br>
</body>
</html>
<?
}

////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////

?>


