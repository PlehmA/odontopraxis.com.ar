<?
include ('lib.inc');
include ('checks.inc');


$MAX_NEWS = 2;
$accion = "LISTA";
$RED_FONT = "font-family: Arial, Helvetica, sans-serif; font-size: 11px; color: red";
$here = "abmLinks.php";

if (isset($_GET['accion'])) 	{
	$accion=$_GET['accion'];
}


if (($accion != 'LISTA') &&
	($accion != 'ALTA') &&
	($accion != 'BAJA') &&
	($accion != 'MOD') &&
	($accion != 'ALTA_UPD') &&
	($accion != 'MOD_UPD') &&
	($accion != 'PUBLICADOSI') &&
	($accion != 'PUBLICADONO')
	)	{
	?><META HTTP-EQUIV="Refresh" CONTENT="0; URL=<?=MAIN_PAGE?>"><?
	return;
	}

include ('conect.inc');


$TABLA = DB_PREFIX . "links" ;


//////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////


?>

<?

///////////////////////////////////////////////
// Alta de registro
if ($accion == 'ALTA_UPD')	{


	$titulo = addSlashes($_POST['titulo']);
	$link = addSlashes($_POST['link']);
	$activo = 'N';
	
	
	//////////////////////////////////////////////////////////
	$sql = "SELECT MAX(id)+1 AS indexId FROM $TABLA";
	$res = mysql_query($sql);
	$indexId = mysql_result($res,0,'indexId');
	if($indexId == null){
		$indexId = 1;
	}
	mysql_free_result($res);
	
	//////////////////////////////////////////////////////////
	
	$sql = "INSERT INTO $TABLA (id, titulo, ";
	$sql.= 						" link, activo)";
	$sql.= 				"VALUES ('$indexId', '$titulo', ";
	$sql.= 						"'$link', '$activo')";
	//print $sql;
	mysql_query($sql);
	
	
	?><META HTTP-EQUIV="Refresh" CONTENT="0; URL=<?=$here?>"><?
	return;
}

///////////////////////////////////////////////
// Actualizaci�n de registro
if ($accion == 'MOD_UPD')	{

	
	$id=$_GET['id'];

	$titulo = addSlashes($_POST['titulo']);
	$link = addSlashes($_POST['link']);
	$activo = addSlashes($_POST['activo']);
		
	//////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////

	$sql = "UPDATE $TABLA SET ";
	$sql.=			" titulo='$titulo', link='$link', activo='$activo' ";
	$sql.= " WHERE id='$id'";
	//print "sql: $sql<br>";
	mysql_query($sql);
	
	/////////////////////////////
	?><META HTTP-EQUIV="Refresh" CONTENT="0; URL=<?=$here?>"><?
	return;
}


///////////////////////////////////////////////
// Setear publicado -> S
if ($accion == 'PUBLICADOSI')	{
	$id=$_GET['id'];
	$sql = "UPDATE $TABLA SET activo='S' WHERE id='$id'";
	mysql_query($sql);
	?>
<META HTTP-EQUIV="Refresh" CONTENT="0; URL=<?=$here?>">
<?
	return;
}

///////////////////////////////////////////////
// Setear publicado -> N
if ($accion == 'PUBLICADONO')	{
	$id=$_GET['id'];
	$sql = "UPDATE $TABLA SET activo='N' WHERE id='$id'";
	mysql_query($sql);
	?>
<META HTTP-EQUIV="Refresh" CONTENT="0; URL=<?=$here?>">
<?
	return;
}



///////////////////////////////////////////////
// Actualizaci�n de registro
if (($accion == 'MOD') || ($accion == 'ALTA'))	{
	
	$id = "";
	$targetAction = "ALTA_UPD";
	$page_title = "Alta de Links";
	$err = "";

	$titulo = "";
	$direccion = "";
	$telefono = "";
	$mail = "";
	$observacion = "";
	$activo = "";
	
	$backpage = $here;
	
	if ($accion == 'MOD')	{
		
		$id = $_GET['id'];
		$targetAction = "MOD_UPD";

		$sql="SELECT * FROM $TABLA WHERE id='$id'";
		$res = mysql_query($sql);
		if (mysql_num_rows($res) < 1) {
			mysql_free_result($res);
			?><META HTTP-EQUIV="Refresh" CONTENT="0; URL=<?=$here?>"><?
			return;	
		}
		$page_title = "Edición de Links";
		$backpage = $here;

		$titulo = mysql_result($res,0,'titulo');
		$link = mysql_result($res,0,'link');
		$activo = mysql_result($res,0,'activo');
		
		mysql_free_result($res);
	}
	else if ($accion == 'ALTA')
	{
		$fecha_reg = date("d-m-Y  H:m:s");
		
		if (isset($_POST['err']))
		{
			$err = $_POST['err'];
			$titulo = $_POST['titulo'];
			$link = $_POST['link'];
			$activo = $_POST['activo'];
		}
	}
	else	{
		
	}
	
?>

<html>
<head>

<title><?=$page_title?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="styles.css" type="text/css">
<script src="util/validations.js"></script>
</head>

<body bgcolor="#EBEBEB" link="#153579" vlink="#153579" alink="#153579" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
  <? include ('header.php');?>
<p align=center><b><font face="Arial, Helvetica, sans-serif" size="3"><?=$page_title?></b></p>


<br>
<?if ($err != ''){?><p align="center" class="menu2_abm"><font color="red">Error: <b><?=$err?></b></font></p><?}?>


 <form method="post" action="<?=$here?>?accion=<?=$targetAction?>&id=<?=$id?>" name="data" enctype="multipart/form-data">
 <input type="hidden" name="id" value="<?=$id?>">


   <table border="0" cellspacing="0" cellpadding="0" align="center">

      <tr> 
        <td valign="middle" align="right" class="menu2_abm">Titulo&nbsp;&nbsp;</td>
       <td valign="top" > 
          <input type="text" class="menu2_abm" name="titulo" size="30" maxlength="25" value="" >
        </td>
     
      </tr>
      <tr><td height="5"></td></tr>
      <tr> 
        <td valign="middle" align="right" class="menu2_abm">Link http://&nbsp;&nbsp;</td>
        <td valign="top" > 
          <input type="text" class="menu2_abm" name="link" size="90" maxlength="90" value="">
        </td>
      </tr>
      <tr><td height="10"></td></tr>
      <input type="hidden" name="activo" value="<?=$id?>">
	  <tr bgcolor="#BCCCCC"><td colspan="3"></td></tr>
   
   </table>
 
  </form>
<br>
<p align=center>
	<input type="button" name="boton" value="Volver" onclick="location='<?=$backpage?>';" style="width:100px"/>
	&nbsp;&nbsp;&nbsp;
	<input type="button" name="boton2" value="Guardar" onclick="return verificar()" style="width:100px"/>
</p>


<br>
<br>

<script language="JavaScript">

	function verificar()	{

	//	alert("validando");
		
		var form = document.forms['data'];
		
		if (form.elements['titulo'].value == "")	{
			form.elements['titulo'].focus();
			alert("Debe ingresar el titulo.");
			return false;
		}
		if (form.elements['link'].value == "")	{
			form.elements['link'].focus();
			alert("Debe ingresar la url del link.");
			return false;
		}
				
		//alert("todo bien");
		form.submit();
		return true;
	}
	
	// s�lo en el caso de caracteres especiales
	document.forms['data'].elements['titulo'].value = "<?=$titulo?>";
	document.forms['data'].elements['link'].value = "<?=$link?>";
	document.forms['data'].elements['activo'].value = "<?=$activo?>";

</script>

</body>
</html>

<?}?>





<?
if ($accion == "LISTA")	{

	$listHeaders = Array(
					Array("titulo" => "Titulo", "campo" => "titulo", "celdas" => "1"),
					Array("titulo" => "link", "campo" => "link", "celdas" => "1"),
					);
	//$orderby = (isset($_GET['orderby'])) ? $_GET['orderby'] : "nombre";
	//$order = (isset($_GET['order'])) ? $_GET['order'] : "0";


	$filtro_orderby = "1";	// Usuario
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
<title>Listado de Links</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="styles.css" type="text/css">
</head>

<body bgcolor="#EBEBEB" link="#153579" vlink="#153579" alink="#153579" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
  <? include ('header.php');?>

<p align=center><b><font face="Arial, Helvetica, sans-serif" size="3">Listado de Links</b></p>

<p align=center>
	<input type="button" name="boton" value="Nuevo Link" onclick="location='<?=$here?>?accion=ALTA';" style="width:150px"/>
	&nbsp;&nbsp;&nbsp;
	<input type="button" name="boton2" value="Men&uacute;" onclick="location='<?=MAIN_PAGE?>';" style="width:150px"/>
</p>


<table width="80%" border="0" cellspacing="0" cellpadding="0" align="center">

		<tr bgcolor="#BCCCCC" height="25px">
		<?
			echo "<td></td>";
			echo "<td></td>";
			echo "<td></td>";
				for($i = 0; $i < sizeof($listHeaders); $i++)
			{
				echo "<td class=\"txt2_abm\"";
				echo " colspan=\"" . $listHeaders[$i]["celdas"] . "\"";
				if ($filtro_orderby == $i) echo " bgcolor=\"#5ecccc\"";
				echo " nowrap>";
				
				if ($filtro_orderby == $i)
				{
					echo "<table width=\"100%\"><tr>";
						echo "<td class=\"txt2_abm\" width=\"90%\" nowrap>";
						echo $listHeaders[$i]["titulo"];
						echo "</td>";
						
						echo "<td>";
						echo "&nbsp";
						if ($filtro_order == 0)	// ASC
							echo "<a href=\"javascript:ordenar('1')\" title=\"Ordenar descendente esta columna\"><img src=\"img/sort_dn.gif\"/ border=\"0\"></a>";
						else	// DESC
							echo "<a href=\"javascript:ordenar('0')\" title=\"Ordenar ascendente esta columna\"><img src=\"img/sort_up.gif\"/ border=\"0\"></a>";
						echo "</td>";
						
					echo "</tr></table>";
				}
				else
				{
					echo "<a href=\"javascript:ordenarCampo('" . $i . "')\" title=\"Ordenar por esta columna\">";
					echo $listHeaders[$i]["titulo"];
					echo "</a";
				}
				echo "</td>";
				echo "<td></td>";
			}
			?>

		<td>&nbsp;</td>
	    <td class="txt2_abm" nowrap colspan="2" align="center">&iquest;Activo?</td>
	    <td>&nbsp;</td>
	    <td class="txt2_abm" nowrap align="center">Activar</td>
	    <td>&nbsp;</td>	
		</tr>

		<tr>
		    <td bgcolor="#CCCCCC" colspan="20" height="1"></td>
		</tr>

<?
	
$sql = "SELECT * FROM $TABLA ";
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

//	print $sql;	

	$res = mysql_query($sql);
	if($res){
		$total = mysql_num_rows($res);

		$idx = 0;
		while ($idx < $total)	{
		
		$id = mysql_result($res, $idx,'id');
		$titulo = mysql_result($res, $idx,'titulo');
		$link = mysql_result($res, $idx,'link');
		$activo = mysql_result($res, $idx,'activo');
		
?>
		<tr height="25">
		    <td class="txt_abm">&nbsp;</td>
		    <td nowrap>
		    	<img src="img/edit_icon.gif" style="cursor:hand" onclick="javascript:location='<?=$here?>?accion=MOD&id=<?=$id?>'" alt="Editar">
		    </td>
		      <td class="txt_abm">&nbsp;&nbsp;&nbsp;</td>
		    
		   
		    <td class="txt_abm" width="20%">
		    	<?=$titulo?>
		    </td>
		    <td class="txt_abm">&nbsp;&nbsp;</td>
		    <td class="txt_abm" width="20%">
		    	<?=$link?>
		    </td>
		    <td class="txt_abm">&nbsp;&nbsp;</td>
		    <td class="txt_abm">&nbsp;&nbsp;</td>
		    <td class="txt_abm" align="center">
		    	<?if ($activo == 'S') {?>S&iacute;<?}else{?>No<?}?>
		    </td>
		    <td class="txt_abm">&nbsp;&nbsp;</td>
		    <td class="txt_abm">&nbsp;&nbsp;</td>
		    <td class="txt_abm" align="center">
		    	&nbsp;&nbsp;
		    	<?if ($activo == 'S') {?>
		    		<input type="button" class="boton" name="pub1" value="No Publicar" onclick="location='<?=$here?>?accion=PUBLICADONO&id=<?=$id?>'" style="height:17px">
		    	<?}else{?>
		    		<input type="button" class="boton" name="pub2" value="Publicar"  onclick="location='<?=$here?>?accion=PUBLICADOSI&id=<?=$id?>'" style="height:17px">
		    	<?}?>
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
}
?>

</table>



<script language="Javascript">
	function ordenarCampo(param)
	{
		window.location = "?=$here?>?orderby=" + param + "&rnd=" + Math.random();
	}
	function ordenar(param)
	{
		window.location = "?=$here?>?orderby=<?=$filtro_orderby?>&order=" + param + "&rnd=" + Math.random();
	}
	
</script>

<br>
<br>
<p align=center>
	<input type="button" name="boton" value="Nuevo Link" onclick="location='<?=$here?>?accion=ALTA';" style="width:150px"/>
	&nbsp;&nbsp;&nbsp;
	<input type="button" name="boton2" value="Men&uacute;" onclick="location='<?=MAIN_PAGE?>';" style="width:150px"/>
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


