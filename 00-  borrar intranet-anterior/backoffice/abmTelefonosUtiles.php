<?
include ('lib.inc');
include ('checks.inc');


$MAX_NEWS = 2;
$accion = "LISTA";
$RED_FONT = "font-family: Arial, Helvetica, sans-serif; font-size: 11px; color: red";

if (isset($_GET['accion'])) 	{
	$accion=$_GET['accion'];
}


if (($accion != 'LISTA') &&
	($accion != 'ALTA') &&
	($accion != 'BAJA') &&
	($accion != 'MOD') &&
	($accion != 'ALTA_UPD') &&
	($accion != 'MOD_UPD')
	)	{
	?><META HTTP-EQUIV="Refresh" CONTENT="0; URL=<?=MAIN_PAGE?>"><?
	return;
	}

include ('conect.inc');


$TABLA = DB_PREFIX . "telefonos_utiles" ;


//////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////


?>

<?

///////////////////////////////////////////////
// Alta de registro
if ($accion == 'ALTA_UPD')	{


	$titulo = addSlashes($_POST['titulo']);
	$direccion = addSlashes($_POST['direccion']);
	$telefono = addSlashes($_POST['telefono']);
	$mail = addSlashes($_POST['mail']);
	$observacion = addSlashes($_POST['observacion']);
	$activo = addSlashes($_POST['activo']);
	
	
	//////////////////////////////////////////////////////////
	$sql = "SELECT MAX(id)+1 AS indexId FROM $TABLA";
	$res = mysql_query($sql);
	$indexId = mysql_result($res,0,'indexId');
	mysql_free_result($res);
	
	//////////////////////////////////////////////////////////
	
	$sql = "INSERT INTO $TABLA (id, titulo, ";
	$sql.= 						" direccion, telefono, ";
	$sql.= 						" mail, observacion, activo)";
	$sql.= 				"VALUES ($indexId, '$titulo', ";
	$sql.= 						"'$direccion', '$telefono', '$mail', ";
	$sql.= 						"'$observacion', '$activo')";
	
	mysql_query($sql);
	
	
	?><META HTTP-EQUIV="Refresh" CONTENT="0; URL=abmTelefonosUtiles.php"><?
	return;
}

///////////////////////////////////////////////
// Actualizaci�n de registro
if ($accion == 'MOD_UPD')	{

	
	$id=$_GET['id'];

	$titulo = addSlashes($_POST['titulo']);
	$direccion = addSlashes($_POST['direccion']);
	$telefono = addSlashes($_POST['telefono']);
	$mail = addSlashes($_POST['mail']);
	$observacion = addSlashes($_POST['observacion']);
	$activo = addSlashes($_POST['activo']);
		
	//////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////

	$sql = "UPDATE $TABLA SET ";
	$sql.=			" titulo='$titulo', direccion='$direccion', telefono='$telefono',";
	//$sql.=			" clave='$clave', nombreext='$nombreext',";
	$sql.=			" mail='$mail', observacion='$observacion',";
	$sql.=			" activo='$activo' ";
	$sql.= " WHERE id='$id'";
	//print "sql: $sql<br>";
	mysql_query($sql);
	
	/////////////////////////////
	?><META HTTP-EQUIV="Refresh" CONTENT="0; URL=abmTelefonosUtiles.php?accion=MOD&id=<?=$id?>"><?
	return;
}


///////////////////////////////////////////////
// Baja de registro
if ($accion == 'BAJA')	{
	$id=$_GET['id'];

	$sql = "DELETE FROM $TABLA WHERE id='$id'";
//	print $sql;
	mysql_query($sql);

	?><META HTTP-EQUIV="Refresh" CONTENT="0; URL=abmTelefonosUtiles.php"><?
	return;
}



///////////////////////////////////////////////
// Setear validado -> S
/*if ($accion == 'VALIDADOSI')	{
	$id=$_GET['id'];
	$sql = "UPDATE $TABLA SET validado='S' WHERE id='$id'";
	mysql_query($sql);
	?><META HTTP-EQUIV="Refresh" CONTENT="0; URL=usuariosweb.php"><?
	return;
}

///////////////////////////////////////////////
// Setear validado -> N
if ($accion == 'VALIDADONO')	{
	$id=$_GET['id'];
	$sql = "UPDATE $TABLA SET validado='N' WHERE id='$id'";
	mysql_query($sql);
	?><META HTTP-EQUIV="Refresh" CONTENT="0; URL=usuariosweb.php"><?
	return;
}

///////////////////////////////////////////////
// Setear bloqueado -> S
if ($accion == 'BLOQUEADOSI')	{
	$id=$_GET['id'];
	$sql = "UPDATE $TABLA SET bloqueado='S' WHERE id='$id'";
	mysql_query($sql);
	?><META HTTP-EQUIV="Refresh" CONTENT="0; URL=usuariosweb.php"><?
	return;
}

///////////////////////////////////////////////
// Setear validado -> N
if ($accion == 'BLOQUEADONO')	{
	$id=$_GET['id'];
	$sql = "UPDATE $TABLA SET bloqueado='N' WHERE id='$id'";
	mysql_query($sql);
	?><META HTTP-EQUIV="Refresh" CONTENT="0; URL=usuariosweb.php"><?
	return;
}


*/

///////////////////////////////////////////////
// Actualizaci�n de registro
if (($accion == 'MOD') || ($accion == 'ALTA'))	{
	
	$id = "";
	$targetAction = "ALTA_UPD";
	$page_title = "Alta de Telefonos Utiles";
	$err = "";

	$titulo = "";
	$direccion = "";
	$telefono = "";
	$mail = "";
	$observacion = "";
	$activo = "";
	
	$backpage = "abmTelefonosUtiles.php";
	
	if ($accion == 'MOD')	{
		
		$id = $_GET['id'];
		$targetAction = "MOD_UPD";

		$sql="SELECT * FROM $TABLA WHERE id='$id'";
		$res = mysql_query($sql);
		if (mysql_num_rows($res) < 1) {
			mysql_free_result($res);
			?><META HTTP-EQUIV="Refresh" CONTENT="0; URL=abmTelefonosUtiles.php"><?
			return;	
		}
		$page_title = "Edici�n de Telefonos Utiles";
		$backpage = "abmTelefonosUtiles.php";

		$titulo = mysql_result($res,0,'titulo');
		$direccion = mysql_result($res,0,'direccion');
		$telefono = mysql_result($res,0,'telefono');
		$mail = mysql_result($res,0,'mail');
		$observacion = mysql_result($res,0,'observacion');
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
			$direccion = $_POST['direccion'];
			$telefono = $_POST['telefono'];
			$mail = $_POST['mail'];
			$observacion = $_POST['observacion'];
			$activo = $_POST['activo'];
		}
	}
	else	{
		
	}
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

<title><?=$page_title?></title>
<link rel="stylesheet" href="styles.css" type="text/css">
<script src="util/validations.js"></script>
</head>

<body bgcolor="#EBEBEB" link="#153579" vlink="#153579" alink="#153579" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
  <? include ('header.php');?>
<p align=center><b><font face="Arial, Helvetica, sans-serif" size="3"><?=$page_title?></b></p>


<br>
<?if ($err != ''){?><p align="center" class="menu2_abm"><font color="red">Error: <b><?=$err?></b></font></p><?}?>


 <form method="post" action="abmTelefonosUtiles.php?accion=<?=$targetAction?>&id=<?=$id?>" name="data" enctype="multipart/form-data">
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
        <td valign="middle" align="right" class="menu2_abm">Direccion&nbsp;&nbsp;</td>
        <td valign="top" > 
          <input type="text" class="menu2_abm" name="direccion" size="30" maxlength="25" value="">
        </td>
      </tr>
      <tr><td height="10"></td></tr>
      <tr bgcolor="#BCCCCC"><td colspan="3"></td></tr>
      <tr><td height="10"></td></tr>

      <tr> 
        <td valign="middle" align="right" class="menu2_abm">Telefono&nbsp;&nbsp;</td>
        <td valign="top" > 
          <input type="text" class="menu2_abm" name="telefono" size="50" maxlength="80" value="" onblur="this.value=Trim(this.value);">
        </td>
      </tr>
      <tr> 
        <td valign="middle" align="right" class="menu2_abm">Mail&nbsp;&nbsp;</td>
        <td valign="top" > 
          <input type="text" class="menu2_abm" name="mail" size="50" maxlength="80" value="" onblur="this.value=Trim(this.value);">
        </td>
      </tr>
      <tr> 
        <td valign="middle" align="right" class="menu2_abm">Observaci�n&nbsp;&nbsp;</td>
        <td valign="top" > 
          <input type="text" class="menu2_abm" name="observacion" size="30" maxlength="25" value="" onblur="this.value=Trim(this.value);">
        </td>
      </tr>
      <tr> 
        <td valign="middle" align="right" class="menu2_abm">Activo&nbsp;&nbsp;</td>
        <td valign="top" > 
          <input type="text" class="menu2_abm" name="activo" size="30" maxlength="25" value="" onblur="this.value=Trim(this.value);">
        </td>
      </tr> 
      <tr><td height="10"></td></tr>
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
		if (form.elements['telefono'].value == "")	{
			form.elements['telefono'].focus();
			alert("Debe ingresar el telefono.");
			return false;
		}
		
			if (!checkEmail(form.elements['mail'].value))
			{
				form.elements['mail'].focus();
				alert("La direcci�n de e-mail no es v�lida.");
				return false;
			}
		
		//alert("todo bien");
		form.submit();
		return true;
	}
	
	// s�lo en el caso de caracteres especiales
	document.forms['data'].elements['titulo'].value = "<?=$titulo?>";
	document.forms['data'].elements['telefono'].value = "<?=$telefono?>";
	document.forms['data'].elements['direccion'].value = "<?=$direccion?>";
	document.forms['data'].elements['mail'].value = "<?=$mail?>";
	document.forms['data'].elements['observacion'].value = "<?=$observacion?>";
	document.forms['data'].elements['activo'].value = "<?=$activo?>";
</script>

</body>
</html>

<?}?>





<?
if ($accion == "LISTA")	{

	$listHeaders = Array(
					Array("titulo" => "Titulo", "campo" => "titulo", "celdas" => "1"),
					Array("titulo" => "Telefono", "campo" => "telefono", "celdas" => "1"),
					Array("titulo" => "Direccion", "campo" => "direccion", "celdas" => "1"),
					Array("titulo" => "E-Mail", "campo" => "mail", "celdas" => "1"),
					Array("titulo" => "Observacion", "campo" => "observacion", "celdas" => "1"),
					Array("titulo" => "Activo", "campo" => "activo", "celdas" => "1"),
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

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Teléfonos útiles</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="styles.css" type="text/css">
</head>

<body bgcolor="#EBEBEB" link="#153579" vlink="#153579" alink="#153579" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
  <? include ('header.php');?>

<p align=center><b><font face="Arial, Helvetica, sans-serif" size="3">Listado de Telefonos Utiles</b></p>

<p align=center>
	<input type="button" name="boton" value="Nuevo telefono" onclick="location='abmTelefonosUtiles.php?accion=ALTA';" style="width:150px"/>
	&nbsp;&nbsp;&nbsp;
	<input type="button" name="boton2" value="Menú" onclick="location='<?=MAIN_PAGE?>';" style="width:150px"/>
</p>


<table width="80%" border="0" cellspacing="0" cellpadding="0" align="center">

		<tr bgcolor="#BCCCCC" height="25px">
		<?
			echo "<td></td>";
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
		    <td nowrap>
		    	<img src="img/edit_icon.gif" style="cursor:hand" onclick="javascript:location='abmTelefonosUtiles.php?accion=MOD&id=<?=$id?>'" alt="Editar">
		    </td>
		    <td nowrap>
		    	<img src="img/delete_icon.gif" style="cursor:hand" alt="Borrar" class="menu_abm" onclick="javascript:borrar('<?=$id?>')">
		    	&nbsp;
		    </td>
		    <td class="txt_abm">&nbsp;&nbsp;&nbsp;</td>
		    
		   
		    <td class="txt_abm" width="20%">
		    	<?=$titulo?>
		    </td>
		    <td class="txt_abm">&nbsp;&nbsp;</td>
		    <td class="txt_abm" width="20%">
		    	<?=$telefono?>
		    </td>
		    <td class="txt_abm">&nbsp;&nbsp;</td>
		     
		    <td class="txt_abm" width="20%">
		    	<?=stripslashes($direccion)?>
		    </td>
		    <td class="txt_abm">&nbsp;&nbsp;</td>

 			<td class="txt_abm" width=20%">
		    	<?=stripslashes($mail)?>
		    </td>
		    <td class="txt_abm">&nbsp;&nbsp;</td>

		    <td class="txt_abm" width="40%">
		    	<?=$observacion?>
		    </td>
		    <td class="txt_abm">&nbsp;&nbsp;</td>

		    <td class="txt_abm" align="center">
		    	<?if ($activo == 'S') {?>S&iacute;<?}else{?>No<?}?>
		    </td>
		    <td class="txt_abm">&nbsp;&nbsp;</td>

		    
		  <!--  <td class="txt_abm" align="center">
		    	&nbsp;&nbsp;
		    	<?if ($adm == 'S') {?>
		    		<input type="button" class="boton" name="v1" value="No Validar" onclick="location='usuariosweb.php?accion=VALIDADONO&id=<?=$id?>'" style="height:17px">
		    	<?}else{?>
		    		<input type="button" class="boton" name="v2" value="Validar"  onclick="location='usuariosweb.php?accion=VALIDADOSI&id=<?=$id?>'" style="height:17px">
		    	<?}?>
		    </td>
		    <td class="txt_abm">&nbsp;&nbsp;</td>

		    <td class="txt_abm" align="center">
		    	<?if ($bloqueado == 'S') {?>S�<?}else{?>No<?}?>
		    </td>
		    <td class="txt_abm" align="center">
		    	&nbsp;&nbsp;
		    	<?if ($bloqueado == 'S') {?>
		    		<input type="button" class="boton" name="pub11" value="Desbloquear" onclick="location='usuariosweb.php?accion=BLOQUEADONO&id=<?=$id?>'" style="height:17px">
		    	<?}else{?>
		    		<input type="button" class="boton" name="pub21" value="Bloquear"  onclick="location='usuariosweb.php?accion=BLOQUEADOSI&id=<?=$id?>'" style="height:17px">
		    	<?}?>
		    </td>

		    <td class="txt_abm">&nbsp;&nbsp;</td>
		-->    
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
		window.location = "abmTelefonosUtiles.php?orderby=" + param + "&rnd=" + Math.random();
	}
	function ordenar(param)
	{
		window.location = "abmTelefonosUtiles.php?orderby=<?=$filtro_orderby?>&order=" + param + "&rnd=" + Math.random();
	}
	function borrar(id)	{
		var conf = confirm("�Est� seguro que desea eliminar el telefono?");
		if (conf)	{
			window.location="abmTelefonosUtiles.php?accion=BAJA&id="+id;
		}
	}
</script>

<br>
<br>
<p align=center>
	<input type="button" name="boton" value="Nuevo telefono" onclick="location='abmTelefonosUtiles.php?accion=ALTA';" style="width:150px"/>
	&nbsp;&nbsp;&nbsp;
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


