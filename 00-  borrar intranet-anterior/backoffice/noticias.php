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
	($accion != 'MOD_UPD') &&
	($accion != 'PUBLICADOSI') &&
	($accion != 'PUBLICADONO')
	)	{
	?>
<head>
<META HTTP-EQUIV="Refresh" CONTENT="0; URL=<?=MAIN_PAGE?>">
<?
	return;
	}

include ('conect.inc');


$TABLA = DB_PREFIX . "noticias" ;


//////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////


?>
<?

///////////////////////////////////////////////
// Alta de registro
if ($accion == 'ALTA_UPD')	{

	$fecha=$_POST['fecha'];
	$fecha=$fecha{6}.$fecha{7}.$fecha{8}.$fecha{9}.$fecha{3}.$fecha{4}.$fecha{0}.$fecha{1};
	$volanta = addSlashes($_POST['volanta']);
	$titulo = addSlashes($_POST['titulo']);
	$bajada = addSlashes($_POST['bajada']);
	$texto = addSlashes($_POST['texto']);
	$publicado = 'N';

	$imagen = "";
	$archivo = "";

	//////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////
	
	if ($_POST['archivo_imagen_cambio'] == 'S')
	{
		$upload_dir = NOTICIAS_DIR;
		$nuevo_archivo = basename($_FILES['archivo_imagen']['name']);
		
		$upload_filename = getFilename($upload_dir, $nuevo_archivo);
		$upload_file =  $upload_dir . $upload_filename;

		if (move_uploaded_file($_FILES['archivo_imagen']['tmp_name'], $upload_file))
		{
			$imagen = $upload_filename;
			chmod($upload_file, 0777);
		}
	}

	if ($_POST['archivo_archivo_cambio'] == 'S')
	{
		$upload_dir = NOTICIAS_DIR;
		$nuevo_archivo = basename($_FILES['archivo_archivo']['name']);
		
		$upload_filename = getFilename($upload_dir, $nuevo_archivo);
		$upload_file =  $upload_dir . $upload_filename;

		if (move_uploaded_file($_FILES['archivo_archivo']['tmp_name'], $upload_file))
		{
			$archivo = $upload_filename;
			chmod($upload_file, 0777);
		}
	}

	//////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////
	
	$sql = "INSERT INTO $TABLA (fecha, ";
	$sql.= 						" volanta, titulo, bajada, texto, ";
	$sql.= 						" imagen, archivo, publicado) ";
	$sql.= 			"VALUES ('$fecha', ";
	$sql.= 						"'$volanta', '$titulo', '$bajada', '$texto', ";
	$sql.=						"'$imagen', '$archivo', '$publicado')";
	//print $sql;
	mysql_query($sql);
	
	?>
<META HTTP-EQUIV="Refresh" CONTENT="0; URL=noticias.php">
<?
	return;
}

///////////////////////////////////////////////
// Actualizaci�n de registro
if ($accion == 'MOD_UPD')	{
	$id=$_GET['id'];

	$fecha=$_POST['fecha'];
	$fecha=$fecha{6}.$fecha{7}.$fecha{8}.$fecha{9}.$fecha{3}.$fecha{4}.$fecha{0}.$fecha{1};
	$volanta = addSlashes($_POST['volanta']);
	$titulo = addSlashes($_POST['titulo']);
	$bajada = addSlashes($_POST['bajada']);
	$texto = addSlashes($_POST['texto']);

	$imagen = $_POST['archivo_imagen_actual'];
	$archivo = $_POST['archivo_archivo_actual'];
	if ($_POST['archivo_imagen_cambio'] == 'S')
	{
		$upload_dir = NOTICIAS_DIR;
		
		if (($imagen != '') && (file_exists($upload_dir . $imagen)))
		{
			if (unlink($upload_dir . $imagen))	// foto actual eliminada!
				$imagen = "";
		}
		$nuevo_archivo = basename($_FILES['archivo_imagen']['name']);
		$upload_filename = getFilename($upload_dir, $nuevo_archivo);
		$upload_file =  $upload_dir . $upload_filename;

		if (move_uploaded_file($_FILES['archivo_imagen']['tmp_name'], $upload_file))
		{
			$imagen = $upload_filename;
			chmod($upload_file, 0777);
		}
	}
	else if ($_POST['archivo_imagen_cambio'] == 'B')	// borrar
	{
		$upload_dir = NOTICIAS_DIR;
	//	print "Borrar: " . $upload_dir . $imagen . "<br>";
		if (($imagen != '') && (file_exists($upload_dir . $imagen)))
		{
			if (unlink($upload_dir . $imagen))	// foto actual eliminada!
				$imagen = "";
		}
	}
	

	if ($_POST['archivo_archivo_cambio'] == 'S')
	{
		$upload_dir = NOTICIAS_DIR;
		
		if (($archivo != '') && (file_exists($upload_dir . $archivo)))
		{
			if (unlink($upload_dir . $archivo))	// archivo actual eliminado!
				$archivo = "";
		}
		$nuevo_archivo = basename($_FILES['archivo_archivo']['name']);
		$upload_filename = getFilename($upload_dir, $nuevo_archivo);
		$upload_file =  $upload_dir . $upload_filename;

		if (move_uploaded_file($_FILES['archivo_archivo']['tmp_name'], $upload_file))
		{
			$archivo = $upload_filename;
			chmod($upload_file, 0777);
		}
	}
	else if ($_POST['archivo_archivo_cambio'] == 'B')	// borrar
	{
		$upload_dir = NOTICIAS_DIR;
	//	print "Borrar: " . $upload_dir . $imagen . "<br>";
		if (($archivo != '') && (file_exists($upload_dir . $archivo)))
		{
			if (unlink($upload_dir . $archivo))	// archivo actual eliminado!
				$archivo = "";
		}
	}
	

	//////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////

	$sql = "UPDATE $TABLA SET fecha='$fecha', ";
	$sql.=			" volanta='$volanta', titulo='$titulo',";
	$sql.=			" bajada='$bajada', texto='$texto',";
	$sql.=			" imagen='$imagen', archivo='$archivo' ";
	$sql.= " WHERE id='$id'";
//	print "sql: $sql<br>";
	mysql_query($sql);
	
	/////////////////////////////
	?>
<META HTTP-EQUIV="Refresh" CONTENT="0; URL=noticias.php?accion=MOD&id=<?=$id?>">
<?
	return;
}


///////////////////////////////////////////////
// Baja de registro
if ($accion == 'BAJA')	{
	$id=$_GET['id'];

	$imagen = "";
	$archivo = "";
	
	$sql = "SELECT * FROM $TABLA WHERE id='$id'";
	$res = mysql_query($sql);
	$total = mysql_num_rows($res);
	if ($total > 0) {
		$imagen = mysql_result($res,0,'imagen');
		$archivo = mysql_result($res,0,'archivo');
	}
	mysql_free_result($res);
	
	if ($total > 0)
	{
		$upload_dir = NOTICIAS_DIR;
		// soporte para vieja implementaci�n
		if (($imagen != '') && (file_exists($upload_dir . $imagen)))
		{
			if (unlink($upload_dir . $imagen))	// imagen actual eliminada!
				$imagen = "";
		}
		if (($archivo != '') && (file_exists($upload_dir . $archivo)))
		{
			if (unlink($upload_dir . $archivo))	// archivo actual eliminado!
				$archivo = "";
		}
	}
	
	$sql = "DELETE FROM $TABLA WHERE id='$id'";
//	print $sql;
	mysql_query($sql);

	?>
<META HTTP-EQUIV="Refresh" CONTENT="0; URL=noticias.php">
<?
	return;
}



///////////////////////////////////////////////
// Setear publicado -> S
if ($accion == 'PUBLICADOSI')	{
	$id=$_GET['id'];
	$sql = "UPDATE $TABLA SET publicado='S' WHERE id='$id'";
	mysql_query($sql);
	?>
<META HTTP-EQUIV="Refresh" CONTENT="0; URL=noticias.php">
<?
	return;
}

///////////////////////////////////////////////
// Setear publicado -> N
if ($accion == 'PUBLICADONO')	{
	$id=$_GET['id'];
	$sql = "UPDATE $TABLA SET publicado='N' WHERE id='$id'";
	mysql_query($sql);
	?>
<META HTTP-EQUIV="Refresh" CONTENT="0; URL=noticias.php">
<?
	return;
}




///////////////////////////////////////////////
// Actualizaci�n de registro
if (($accion == 'MOD') || ($accion == 'ALTA'))	{
	
	$id="";
	$targetAction="ALTA_UPD";
	$page_title = "Alta de Noticia";
	
	$fecha = "";
	$volanta = "";
	$titulo = "";
	$bajada = "";
	$texto = "";
	$imagen = "";
	$archivo = "";
	$backpage = "noticias.php";
	
	if ($accion == 'MOD')	{
		
		$id=$_GET['id'];
		$targetAction="MOD_UPD";

		$sql="SELECT * FROM $TABLA WHERE id='$id'";
		$res=mysql_query($sql);
		if (mysql_num_rows($res)<1) {
			mysql_free_result($res);
			?>
<META HTTP-EQUIV="Refresh" CONTENT="0; URL=noticias.php">
<?
			return;	
		}
		$page_title = "Edici�n de Noticia";
		$backpage = "noticias.php";


		$fecha = mysql_result($res,0,'fecha');
		$fecha = substr($fecha,6,2).'/'.substr($fecha,4,2).'/'.substr($fecha,0,4);
		$volanta = mysql_result($res,0,'volanta');
		$titulo = mysql_result($res,0,'titulo');
		$bajada = mysql_result($res,0,'bajada');
		$texto = mysql_result($res,0,'texto');
		$imagen = mysql_result($res,0,'imagen');
		$archivo = mysql_result($res,0,'archivo');
		
		mysql_free_result($res);
	}
	else	{
		$fecha = date("d/m/Y");
	}
	
?><html>
<title>
<?=$page_title?>
</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="styles.css" type="text/css">
<script src="util/validations.js"></script>
</head>
<body bgcolor="#EBEBEB" link="#153579" vlink="#153579" alink="#153579" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<? include ('header.php');?>
<p align=center><b><font face="Arial, Helvetica, sans-serif" size="3">
  <?=$page_title?>
  </font></b></p>
<font face="Arial, Helvetica, sans-serif" size="3"> <form method="post" action="noticias.php?accion=<?=$targetAction?>&id=<?=$id?>" name="data" enctype="multipart/form-data"> 
<input type="hidden" name="id" value="<?=$id?>">
<table border="0" cellspacing="0" cellpadding="0" align="center">
  <tr> 
    <td valign="middle" align="left" class="menu2_abm" nowrap>Fecha (dd/mm/aaaa)&nbsp;&nbsp;</td>
  </tr>
  <tr> 
    <td valign="top"> 
      <input type="text" class="menu2_abm" name="fecha" size="10" maxlength="10" value="<?=$fecha?>">
    </td>
  </tr>
  <tr>
    <td height="10px"></td>
  </tr>
  <tr> 
    <td valign="middle" align="left" class="menu2_abm" nowrap>Volanta&nbsp;&nbsp;</td>
  </tr>
  <tr> 
    <td valign="top"> 
      <input type="text" class="menu2_abm" name="volanta" size="50" maxlength="80" value="">
    </td>
    <td nowrap>&nbsp;&nbsp;</td>
    <td valign="top">&nbsp; </td>
  </tr>
  <tr> 
    <td valign="top" style="<?=$RED_FONT?>"> &nbsp;&nbsp;Este texto es opcional. 
    </td>
  </tr>
  <tr>
    <td height="10px"></td>
  </tr>
  <tr> 
    <td valign="middle" align="left" class="menu2_abm" nowrap>T�tulo&nbsp;&nbsp;</td>
  </tr>
  <tr> 
    <td valign="top"> 
      <input type="text" class="menu2_abm" name="titulo" size="50" maxlength="80" value="">
    </td>
    <td nowrap>&nbsp;&nbsp;</td>
    <td valign="top">&nbsp; </td>
  </tr>
  <tr>
    <td height="10px"></td>
  </tr>
  <tr> 
    <td valign="top" align="left" class="menu2_abm" nowrap>Bajada&nbsp;&nbsp;</td>
  </tr>
  <tr> 
    <td valign="top"> 
      <textarea name="bajada" class="menu2_abm" rows="4" cols="52" ><?=stripslashes($bajada)?></textarea>
    </td>
    <td nowrap>&nbsp;&nbsp;</td>
    <td valign="top">&nbsp; </td>
  </tr>
  <tr>
    <td height="10px"></td>
  </tr>
  <tr> 
    <td valign="top" align="left" class="menu2_abm">Texto&nbsp;&nbsp;</td>
  </tr>
  <tr> 
    <td valign="top"> 
      <textarea name="texto" class="menu2_abm" rows="8" cols="52" ><?=stripslashes($texto)?></textarea>
    </td>
    <td nowrap>&nbsp;&nbsp;</td>
    <td valign="top">&nbsp; </td>
  </tr>
  <tr height="8">
    <td colspan="2"/>
  </tr>
  <tr bgcolor="#BCCCCC">
    <td colspan="3"></td>
  </tr>
  <tr height="8">
    <td colspan="2"/>
  </tr>
  <tr>
    <td colspan="3" align="center">
      <table>
        <tr> 
          <td valign="top" align="right" class="menu2_abm">Imagen&nbsp;&nbsp;</td>
          <td valign="top" class="menu2_abm"> 
            <?if ($imagen != "")	{?>
            <input type="radio" name="archivo_imagen_cambio" value="N" checked onclick="document.getElementById('id.archivo_imagen').disabled=true;">
            Sin cambios<br>
            <input type="radio" name="archivo_imagen_cambio" value="B" onclick="document.getElementById('id.archivo_imagen').disabled=true;">
            Borrar<br>
            <input type="radio" name="archivo_imagen_cambio" value="S" onclick="document.getElementById('id.archivo_imagen').disabled=false;">
            Sobre-escribir 
            <?}else{?>
            <input type="hidden" name="archivo_imagen_cambio" value="S">
            <?}?>
            <input type="hidden" name="archivo_imagen_actual" value="<?=$imagen?>">
            &nbsp;
            <input class="menu2_abm" type="file" name="archivo_imagen" id="id.archivo_imagen" <?if($imagen != ""){?> DISABLED<?}?> >
          </td>
        </tr>
        <tr> 
          <td valign="top" align="right">&nbsp;</td>
          <td valign="top" style="<?=$RED_FONT?>"> &nbsp;&nbsp;Esta imagen es 
            opcional.<br>
            &nbsp;&nbsp;No debe superar los 120 pixels de ancho.<br>
          </td>
        </tr>
        <?
      if (($accion == 'MOD') && ($imagen <> ""))	{
      	
		$width = 0;
		$height = 0;
		$sizeStr = "";
		if (file_exists(NOTICIAS_DIR . $imagen))
		{
			$size = filesize(NOTICIAS_DIR . $imagen);
			if ($size > 1024)
				$sizeStr = (intval($size/1024) + 1) . " KB";
			else
				$sizeStr = $size . " B";

			list($width, $height, $type, $attr) = getimagesize(NOTICIAS_DIR . $imagen);
		}
      	
      ?>
        <tr> 
          <td valign="middle" align="right" class="menu2_abm" nowrap></td>
          <td valign="top" class="menu2_abm"> 
            <table border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td>&nbsp;&nbsp;&nbsp;</td>
                <td> <img src="<?=NOTICIAS_DIR?><?=$imagen?>"/> </td>
                <td>&nbsp;&nbsp;&nbsp;</td>
                <td class="menu2_abm"> [
                  <?=NOTICIAS_DIR?>
                  <b>
                  <?=$imagen?>
                  </b>]<br>
                  <br>
                  Tama�o: 
                  <?=$sizeStr?>
                  <br>
                  Dimensi�n: 
                  <?=$width?>
                  x 
                  <?=$height?>
                </td>
              </tr>
            </table>
          </td>
        </tr>
        <?}?>
        <!-- ********************************************************** -->
        <!-- ********************************************************** -->
        <!-- ********************************************************** -->
        <tr bgcolor="#BCCCCC">
          <td colspan="3"></td>
        </tr>
        <tr height="8">
          <td colspan="2"/>
        </tr>
        <tr> 
          <td colspan="3" align="center">&nbsp; </td>
        </tr>
      </table></form>
  <br>
  <p align=center> 
    <input type="button" name="boton" value="Volver" onclick="location='<?=$backpage?>';" style="width:100px"/>
    &nbsp;&nbsp;&nbsp; 
    <input type="button" name="boton" value="Guardar" onclick="return verificar()" style="width:100px"/>
  </p>
  <br>
  <br>
  <script language="JavaScript">

	function verificar()	{
		var form = document.forms['data'];
		
		if (!verificarFecha(form.elements['fecha'].value))	{
			alert("Error en formato de fecha (dd/mm/aaaa)");
			form.elements['fecha'].focus();
			return false;
		}
		
	//	if (form.elements['volanta'].value == "")	{
	//		form.elements['volanta'].focus();
	//		alert("Debe ingresar el texto de la volanta");
	//		return false;
	//	}
		if (form.elements['titulo'].value == "")	{
			form.elements['titulo'].focus();
			alert("Debe ingresar el t�tulo en espa�ol.");
			return false;
		}
	
		if (form.elements['bajada'].value == "")	{
			form.elements['bajada'].focus();
			alert("Debe ingresar el texto de la bajada en espa�ol.");
			return false;
		}
	
		if (form.elements['texto'].value == "")	{
			form.elements['texto'].focus();
			alert("Debe ingresar el contenido de la noticia en espa�ol.");
			return false;
		}
	
		
		form.submit();
		return true;
	}
	
	// s�lo en el caso de caracteres especiales
	document.forms['data'].elements['volanta'].value = "<?=$volanta?>";
	document.forms['data'].elements['titulo'].value = "<?=$titulo?>";
	
	

</script>
</table>
</font>
</body>
</html>

<?}?>





<?
if ($accion == "LISTA")	{

	$orderby = (isset($_GET['orderby'])) ? $_GET['orderby'] : "titulo";
	$order = (isset($_GET['order'])) ? $_GET['order'] : "1";

?>

<html>
<head>
<title>Listado de noticias</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="styles.css" type="text/css">
</head>

<body bgcolor="#EBEBEB" link="#153579" vlink="#153579" alink="#153579" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
  <? include ('header.php');?>

<p align=center><b><font face="Arial, Helvetica, sans-serif" size="3">Listado de noticias</b></p>

<p align=center>
	<input type="button" name="boton" value="Nueva noticia" onclick="location='noticias.php?accion=ALTA';" style="width:150px"/>
	&nbsp;&nbsp;&nbsp;
	<input type="button" name="boton2" value="Men�" onclick="location='<?=MAIN_PAGE?>';" style="width:150px"/>
</p>


<table width="80%" border="0" cellspacing="0" cellpadding="0" align="center">

	  <tr bgcolor="#BCCCCC" height="25px"> 
	  	<td></td>
	  	<td></td>
	  	<td></td>
	  	<td></td>
	    <!--<td class="txt2_abm" nowrap>Fecha</td>-->
	    <td class="txt2_abm" nowrap>
	    	<table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0"<?if($orderby == "fecha"){?> bgcolor="#5ecccc"<?}?>><tr>
	    		<td width="99%" class="txt2_abm_selected">
	    		<?
	    		if ($orderby == "fecha")
	    			print "Fecha";
	    		else
	    		{
	    			print "<a href=\"" . $_SERVER['PHP_SELF'] . "?orderby=fecha" . "\" title=\"Ordenar esta columna\">";
	    			print "Fecha";
	    			print "</a>";
	    		}
	    		?>
	    		</td>
	    		<td nowrap>
	    		<?
	    		print "&nbsp;";
	    		if ($orderby == "fecha")
	    		{
	    			if ($order == "1")
	    			{
		    			print "<a href=\"" . $_SERVER['PHP_SELF'] . "?orderby=" . $orderby . "&order=2" . "\" title=\"Ordenar descendente\">";
		    			print "<img src=\"img/sort_dn.gif\" border=\"0\" >";
		    			print "</a>";
	    			}
	    			else
	    			{
		    			print "<a href=\"" . $_SERVER['PHP_SELF'] . "?orderby=" . $orderby . "&order=1" . "\" title=\"Ordenar ascendente\">";
		    			print "<img src=\"img/sort_up.gif\" border=\"0\" >";
		    			print "</a>";
	    			}
	    		}
	    		print "&nbsp;";
	    		?>
	    		</td>
	    	</tr></table>
	    </td>
	    <td>&nbsp;&nbsp;&nbsp;</td>
	    <!--<td class="txt2_abm" nowrap width="99%">T�tulo (en espa�ol)</td>-->
	    <td class="txt2_abm" nowrap width="99%">
	    	<table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0"<?if($orderby == "titulo"){?> bgcolor="#5ecccc"<?}?>><tr>
	    		<td width="99%" class="txt2_abm_selected">
	    		<?
	    		if ($orderby == "titulo")
	    			print "T�tulo (en espa�ol)";
	    		else
	    		{
	    			print "<a href=\"" . $_SERVER['PHP_SELF'] . "?orderby=titulo" . "\" title=\"Ordenar esta columna\">";
	    			print "T�tulo (en espa�ol)";
	    			print "</a>";
	    		}
	    		?>
	    		</td>
	    		<td nowrap>
	    		<?
	    		print "&nbsp;";
	    		if ($orderby == "titulo")
	    		{
	    			if ($order == "1")
	    			{
		    			print "<a href=\"" . $_SERVER['PHP_SELF'] . "?orderby=" . $orderby . "&order=2" . "\" title=\"Ordenar descendente\">";
		    			print "<img src=\"img/sort_dn.gif\" border=\"0\" >";
		    			print "</a>";
	    			}
	    			else
	    			{
		    			print "<a href=\"" . $_SERVER['PHP_SELF'] . "?orderby=" . $orderby . "&order=1" . "\" title=\"Ordenar ascendente\">";
		    			print "<img src=\"img/sort_up.gif\" border=\"0\" >";
		    			print "</a>";
	    			}
	    		}
	    		print "&nbsp;";
	    		?>
	    		</td>
	    	</tr></table>
	    </td>
	    <td>&nbsp;&nbsp;&nbsp;</td>
	    <td class="txt2_abm" nowrap colspan="2" align="center">Publicado</td>
	    <td>&nbsp;&nbsp;&nbsp;</td>
	    <td class="txt2_abm" nowrap align="center">�Tiene imagen?</td>
	    <td>&nbsp;&nbsp;&nbsp;</td>
	    <td class="txt2_abm" nowrap align="center">�Tiene archivo?</td>
	    <td>&nbsp;</td>
	  </tr>
		<tr>
		    <td bgcolor="#CCCCCC" colspan="15" height="1"></td>
		</tr>

<?
	
	$sql = "SELECT * FROM $TABLA ";
//	$sql.= " ORDER BY fecha, id";

	if ($orderby != '')
	{
		$sql .= "ORDER BY " . $orderby . " " . (($order == '1') ? "ASC" : "DESC");
	}
	else
		$sql.= "ORDER BY id";


	$res = mysql_query($sql);
	$total = mysql_num_rows($res);

	$idx = 0;
	while ($idx < $total)	{

		$id = mysql_result($res, $idx,'id');
		$fecha = mysql_result($res, $idx,'fecha');
		$titulo = mysql_result($res, $idx,'titulo');
		$imagen = mysql_result($res, $idx,'imagen');
		$publicado = mysql_result($res, $idx,'publicado');
		$archivo = mysql_result($res, $idx,'archivo');
		$imagen = mysql_result($res, $idx,'imagen');

		$fecha_str = substr($fecha,6,2).'/'.substr($fecha,4,2).'/'.substr($fecha,0,4);
		$publicado_str = ($publicado=='S') ? "Publicado" : "No publicado";
		
?>
		<tr height="25">
		    <td class="txt_abm">&nbsp;</td>
			<td nowrap>
		    	<img src="img/edit_icon.gif" style="cursor:hand" onclick="javascript:location='noticias.php?accion=MOD&id=<?=$id?>'" alt="Editar">
		    </td>
		    <td nowrap>
		    	<img src="img/delete_icon.gif" style="cursor:hand" alt="Borrar" class="menu_abm" onclick="javascript:borrar('<?=$id?>')">
		    	&nbsp;
		    </td>
		    <td class="txt_abm">&nbsp;&nbsp;&nbsp;</td>
		    <td class="txt_abm" nowrap>
		    	<?=$fecha_str?>
		    </td>
		    <td class="txt_abm">&nbsp;&nbsp;</td>
		    <td class="txt_abm" width="90%">
		    	<?=stripslashes($titulo)?>
		    </td>
		    <td class="txt_abm">&nbsp;&nbsp;</td>

		    <td class="txt_abm" align="center">
		    	<?if ($publicado == 'S') {?>S�<?}else{?>No<?}?>
		    </td>
		    <td class="txt_abm" align="center">
		    	&nbsp;&nbsp;
		    	<?if ($publicado == 'S') {?>
		    		<input type="button" class="boton" name="pub1" value="No Publicar" onclick="location='noticias.php?accion=PUBLICADONO&id=<?=$id?>'" style="height:17px">
		    	<?}else{?>
		    		<input type="button" class="boton" name="pub2" value="Publicar"  onclick="location='noticias.php?accion=PUBLICADOSI&id=<?=$id?>'" style="height:17px">
		    	<?}?>
		    </td>

		    <td class="txt_abm">&nbsp;&nbsp;</td>
		    <td class="txt_abm" align="center">
		    	<?if ($imagen != '') {?>S�<?}else{?>No<?}?>
		    </td>
		    <td class="txt_abm">&nbsp;&nbsp;</td>
		    <td class="txt_abm" align="center">
		    	<?if ($archivo != '') {?>S�<?}else{?>No<?}?>
		    </td>
		    <td nowrap>
		    	<img src="img/preview_icon.gif" style="cursor:hand" onclick="javascript:window.open('../index_preview.php?id=<?=$id?>','_blank')" alt="Preview">
		    </td>
		    <td class="txt_abm">&nbsp;</td>
		</tr>
		<tr>
		    <td bgcolor="#CCCCCC" colspan="15" height="1"></td>
		</tr>
<?
		$idx++;
	}
	mysql_free_result($res);
?>

</table>



<script language="Javascript">
	function borrar(id)	{
		var conf = confirm("�Est� seguro que desea eliminar la noticia?");
		if (conf)	{
			window.location="noticias.php?accion=BAJA&id="+id;
		}
	}
</script>

<br>
<br>
<p align=center>
	<input type="button" name="boton" value="Nueva noticia" onclick="location='noticias.php?accion=ALTA';" style="width:150px"/>
	&nbsp;&nbsp;&nbsp;
	<input type="button" name="boton2" value="Men�" onclick="location='<?=MAIN_PAGE?>';" style="width:150px"/>
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


