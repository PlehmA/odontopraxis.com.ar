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
	?><META HTTP-EQUIV="Refresh" CONTENT="0; URL=<?=MAIN_PAGE?>"><?
	return;
	}

include ('conect.inc');


$TABLA = DB_PREFIX . "eventos" ;


//////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////


?>

<?

///////////////////////////////////////////////
// Alta de registro
if ($accion == 'ALTA_UPD')	{

	$fecha_inicio=$_POST['fecha_inicio'];
	$fecha_inicio=$fecha_inicio{6}.$fecha_inicio{7}.$fecha_inicio{8}.$fecha_inicio{9}.$fecha_inicio{3}.$fecha_inicio{4}.$fecha_inicio{0}.$fecha_inicio{1};
	$fecha_fin=$_POST['fecha_fin'];
	$fecha_fin=$fecha_fin{6}.$fecha_fin{7}.$fecha_fin{8}.$fecha_fin{9}.$fecha_fin{3}.$fecha_fin{4}.$fecha_fin{0}.$fecha_fin{1};
	$lugar = addSlashes($_POST['lugar']);
	$titulo = addSlashes($_POST['titulo']);
	$texto = addSlashes($_POST['texto']);
	$titulo_por = addSlashes($_POST['titulo_por']);
	$texto_por = addSlashes($_POST['texto_por']);
	$publicado = 'N';

	$imagen = "";
	$archivo = "";

	//////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////
	
	if ($_POST['archivo_imagen_cambio'] == 'S')
	{
		$upload_dir = EVENTOS_DIR;
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
		$upload_dir = EVENTOS_DIR;
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
	
	$sql = "INSERT INTO $TABLA (fecha_inicio, fecha_fin,";
	$sql.= 						" lugar, titulo, texto, titulo_por, texto_por, ";
	$sql.= 						" imagen, archivo, publicado) ";
	$sql.= 			"VALUES ('$fecha_inicio', '$fecha_fin', ";
	$sql.= 						"'$lugar', '$titulo', '$texto', '$titulo_por','$texto_por', ";
	$sql.=						"'$imagen', '$archivo', '$publicado')";
	//print $sql;
	mysql_query($sql);
	
	?><META HTTP-EQUIV="Refresh" CONTENT="0; URL=eventos.php"><?
	return;
}

///////////////////////////////////////////////
// Actualización de registro
if ($accion == 'MOD_UPD')	{
	$id=$_GET['id'];

	$fecha_inicio=$_POST['fecha_inicio'];
	$fecha_inicio=$fecha_inicio{6}.$fecha_inicio{7}.$fecha_inicio{8}.$fecha_inicio{9}.$fecha_inicio{3}.$fecha_inicio{4}.$fecha_inicio{0}.$fecha_inicio{1};
	$fecha_fin=$_POST['fecha_fin'];
	$fecha_fin=$fecha_fin{6}.$fecha_fin{7}.$fecha_fin{8}.$fecha_fin{9}.$fecha_fin{3}.$fecha_fin{4}.$fecha_fin{0}.$fecha_fin{1};
	$lugar = addSlashes($_POST['lugar']);
	$titulo = addSlashes($_POST['titulo']);
	$texto = addSlashes($_POST['texto']);
	$titulo_por = addSlashes($_POST['titulo_por']);
	$texto_por = addSlashes($_POST['texto_por']);

	$imagen = $_POST['archivo_imagen_actual'];
	$archivo = $_POST['archivo_archivo_actual'];

	if ($_POST['archivo_imagen_cambio'] == 'S')
	{
		$upload_dir = EVENTOS_DIR;
		
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
		$upload_dir = EVENTOS_DIR;
	//	print "Borrar: " . $upload_dir . $imagen . "<br>";
		if (($imagen != '') && (file_exists($upload_dir . $imagen)))
		{
			if (unlink($upload_dir . $imagen))	// foto actual eliminada!
				$imagen = "";
		}
	}
	

	if ($_POST['archivo_archivo_cambio'] == 'S')
	{
		$upload_dir = EVENTOS_DIR;
		
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
		$upload_dir = EVENTOS_DIR;
	//	print "Borrar: " . $upload_dir . $imagen . "<br>";
		if (($archivo != '') && (file_exists($upload_dir . $archivo)))
		{
			if (unlink($upload_dir . $archivo))	// archivo actual eliminado!
				$archivo = "";
		}
	}
	

	//////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////

	$sql = "UPDATE $TABLA SET fecha_inicio='$fecha_inicio', fecha_fin='$fecha_fin', ";
	$sql.=			" lugar='$lugar', ";
	$sql.=			" titulo='$titulo', texto='$texto',";
	$sql.=			" titulo_por='$titulo_por', texto_por='$texto_por',";
	$sql.=			" imagen='$imagen', archivo='$archivo' ";
	$sql.= " WHERE id='$id'";
//	print "sql: $sql<br>";
	mysql_query($sql);
	
	/////////////////////////////
	?><META HTTP-EQUIV="Refresh" CONTENT="0; URL=eventos.php?accion=MOD&id=<?=$id?>"><?
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
		$upload_dir = EVENTOS_DIR;
		// soporte para vieja implementación
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

	?><META HTTP-EQUIV="Refresh" CONTENT="0; URL=eventos.php"><?
	return;
}



///////////////////////////////////////////////
// Setear publicado -> S
if ($accion == 'PUBLICADOSI')	{
	$id=$_GET['id'];
	$sql = "UPDATE $TABLA SET publicado='S' WHERE id='$id'";
	mysql_query($sql);
	?><META HTTP-EQUIV="Refresh" CONTENT="0; URL=eventos.php"><?
	return;
}

///////////////////////////////////////////////
// Setear publicado -> N
if ($accion == 'PUBLICADONO')	{
	$id=$_GET['id'];
	$sql = "UPDATE $TABLA SET publicado='N' WHERE id='$id'";
	mysql_query($sql);
	?><META HTTP-EQUIV="Refresh" CONTENT="0; URL=eventos.php"><?
	return;
}




///////////////////////////////////////////////
// Actualización de registro
if (($accion == 'MOD') || ($accion == 'ALTA'))	{
	
	$id="";
	$targetAction="ALTA_UPD";
	$page_title = "Alta de Evento";
	
	$fecha_inicio = "";
	$fecha_fin = "";
	$lugar = "";
	$titulo = "";
	$texto = "";
	$titulo_por = "";
	$texto_por = "";
	$imagen = "";
	$archivo = "";
	$backpage = "eventos.php";
	
	if ($accion == 'MOD')	{
		
		$id=$_GET['id'];
		$targetAction="MOD_UPD";

		$sql="SELECT * FROM $TABLA WHERE id='$id'";
		$res=mysql_query($sql);
		if (mysql_num_rows($res)<1) {
			mysql_free_result($res);
			?><META HTTP-EQUIV="Refresh" CONTENT="0; URL=eventos.php"><?
			return;	
		}
		$page_title = "Edición de Evento";
		$backpage = "eventos.php";


		$fecha_inicio = mysql_result($res,0,'fecha_inicio');
		$fecha_inicio = substr($fecha_inicio,6,2).'-'.substr($fecha_inicio,4,2).'-'.substr($fecha_inicio,0,4);
		$fecha_fin = mysql_result($res,0,'fecha_fin');
		$fecha_fin = substr($fecha_fin,6,2).'-'.substr($fecha_fin,4,2).'-'.substr($fecha_fin,0,4);
		$lugar = mysql_result($res,0,'lugar');
		$titulo = mysql_result($res,0,'titulo');
		$texto = mysql_result($res,0,'texto');
		$titulo_por = mysql_result($res,0,'titulo_por');
		$texto_por = mysql_result($res,0,'texto_por');
		$imagen = mysql_result($res,0,'imagen');
		$archivo = mysql_result($res,0,'archivo');
		
		mysql_free_result($res);
	}
	else	{
		$fecha_inicio = date("d-m-Y");
		$fecha_fin = date("d-m-Y");
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

 <form method="post" action="eventos.php?accion=<?=$targetAction?>&id=<?=$id?>" name="data" enctype="multipart/form-data">
 <input type="hidden" name="id" value="<?=$id?>">
 
   <table border="0" cellspacing="0" cellpadding="0" align="center">


      <tr> 
        <td valign="middle" align="left" class="menu2_abm" nowrap>Fecha de inicio (dd-mm-aaaa)&nbsp;&nbsp;</td>
        <td nowrap>&nbsp;&nbsp;</td>
        <td valign="middle" align="left" class="menu2_abm" nowrap>Fecha de fin (dd-mm-aaaa)&nbsp;&nbsp;</td>
      </tr>
      <tr> 
        <td valign="top"> 
          <input type="text" class="menu2_abm" name="fecha_inicio" size="10" maxlength="10" value="<?=$fecha_inicio?>">
        </td>
        <td nowrap>&nbsp;&nbsp;</td>
        <td valign="top"> 
          <input type="text" class="menu2_abm" name="fecha_fin" size="10" maxlength="10" value="<?=$fecha_fin?>">
        </td>
      </tr>
      <tr>
        <td valign="top"> 
        </td>
        <td nowrap>&nbsp;&nbsp;</td>
        <td valign="top" style="<?=$RED_FONT?>">
        &nbsp;&nbsp;Si no se introduce una fecha de fin,<br>se asume igual a la fecha de inicio.
		</td>
      </tr>
      
      <tr><td height="10px"></td></tr>
      <tr> 
        <td valign="middle" align="left" class="menu2_abm" nowrap>Lugar&nbsp;&nbsp;</td>
      </tr>
      <tr> 
        <td valign="top" colspan="3"> 
          <input type="text" class="menu2_abm" name="lugar" size="60" maxlength="60" value="">
        </td>
      </tr>
      <tr>
        <td valign="top" style="<?=$RED_FONT?>">
        &nbsp;&nbsp;Este texto es opcional.
		</td>
      </tr>
      <tr><td height="10px"></td></tr>
      <tr> 
        <td valign="middle" align="left" class="menu2_abm" nowrap>Título&nbsp;&nbsp;</td>
        <td nowrap>&nbsp;&nbsp;</td>
        <td valign="top" align="left" class="menu2_abm" nowrap>Título (en portugués)</td>
      </tr>
      <tr> 
        <td valign="top"> 
          <input type="text" class="menu2_abm" name="titulo" size="50" maxlength="80" value="">
        </td>
        <td nowrap>&nbsp;&nbsp;</td>
        <td valign="top"> 
          <input type="text" class="menu2_abm" name="titulo_por" size="50" maxlength="80" value="">
        </td>
      </tr>
      <tr><td height="10px"></td></tr>

      <tr> 
        <td valign="top" align="left" class="menu2_abm">Texto</td>
        <td nowrap>&nbsp;&nbsp;</td>
        <td valign="top" align="left" class="menu2_abm" nowrap>Texto (en portugués)</td>
      </tr>
      <tr> 
        <td valign="top">
          <textarea name="texto" class="menu2_abm" rows="8" cols="52" ><?=stripslashes($texto)?></textarea>
        </td>
        <td nowrap>&nbsp;&nbsp;</td>
        <td valign="top">
          <textarea name="texto_por" class="menu2_abm" rows="8" cols="52" ><?=stripslashes($texto_por)?></textarea>
        </td>
      </tr>
      <tr height="8"><td colspan="2"/></tr>



      <tr bgcolor="#BCCCCC"><td colspan="3"></td></tr>
      
      <tr height="8"><td colspan="2"/></tr>
      <tr><td colspan="3" align="center"><table>
      
      <tr>
        <td valign="top" align="right" class="menu2_abm">Imagen&nbsp;&nbsp;</td>
        <td valign="top" class="menu2_abm">
			<?if ($imagen != "")	{?>
			<input type="radio" name="archivo_imagen_cambio" value="N" checked onclick="document.getElementById('id.archivo_imagen').disabled=true;"> Sin cambios<br>
			<input type="radio" name="archivo_imagen_cambio" value="B" onclick="document.getElementById('id.archivo_imagen').disabled=true;"> Borrar<br>
			<input type="radio" name="archivo_imagen_cambio" value="S" onclick="document.getElementById('id.archivo_imagen').disabled=false;"> Sobre-escribir
			<?}else{?>
			<input type="hidden" name="archivo_imagen_cambio" value="S">
			<?}?>
			<input type="hidden" name="archivo_imagen_actual" value="<?=$imagen?>">
   			&nbsp;<input class="menu2_abm" type="file" name="archivo_imagen" id="id.archivo_imagen" <?if($imagen != ""){?> DISABLED<?}?> >
       </td>
      </tr>
      <tr>
        <td valign="top" align="right">&nbsp;</td>
        <td valign="top" style="<?=$RED_FONT?>">
        &nbsp;&nbsp;Esta imagen es opcional.<br>
        &nbsp;&nbsp;No debe superar los 120 pixels de ancho.<br>
		</td>
      </tr>
      <?
      if (($accion == 'MOD') && ($imagen <> ""))	{
      	
		$width = 0;
		$height = 0;
		$sizeStr = "";
		if (file_exists(EVENTOS_DIR . $imagen))
		{
			$size = filesize(EVENTOS_DIR . $imagen);
			if ($size > 1024)
				$sizeStr = (intval($size/1024) + 1) . " KB";
			else
				$sizeStr = $size . " B";

			list($width, $height, $type, $attr) = getimagesize(EVENTOS_DIR . $imagen);
		}
      	
      ?>
      <tr>
        <td valign="middle" align="right" class="menu2_abm" nowrap></td>
        <td valign="top" class="menu2_abm">
        	<table border="0" cellspacing="0" cellpadding="0"><tr>
        		<td>&nbsp;&nbsp;&nbsp;</td>
        		<td>
        			<img src="<?=EVENTOS_DIR?><?=$imagen?>"/>
        		</td>
        		<td>&nbsp;&nbsp;&nbsp;</td>
        		<td class="menu2_abm">
        			[<?=EVENTOS_DIR?><b><?=$imagen?></b>]<br>
        			<br>
        			Tamaño: <?=$sizeStr?><br>
        			Dimensión: <?=$width?> x <?=$height?>
        		</td>
        	</tr></table>
        </td>
      </tr>
      <?}?>
		
	<!-- ********************************************************** -->
	<!-- ********************************************************** -->
	<!-- ********************************************************** -->
	
      <tr bgcolor="#BCCCCC"><td colspan="3"></td></tr>
      
      <tr height="8"><td colspan="2"/></tr>
      <tr><td colspan="3" align="center"><table>
      
      <tr>
        <td valign="top" align="right" class="menu2_abm">Archivo&nbsp;&nbsp;</td>
        <td valign="top" class="menu2_abm">
			<?if ($archivo != "")	{?>
			<input type="radio" name="archivo_archivo_cambio" value="N" checked onclick="document.getElementById('id.archivo_archivo').disabled=true;"> Sin cambios<br>
			<input type="radio" name="archivo_archivo_cambio" value="B" onclick="document.getElementById('id.archivo_archivo').disabled=true;"> Borrar<br>
			<input type="radio" name="archivo_archivo_cambio" value="S" onclick="document.getElementById('id.archivo_archivo').disabled=false;"> Sobre-escribir
			<?}else{?>
			<input type="hidden" name="archivo_archivo_cambio" value="S">
			<?}?>
			<input type="hidden" name="archivo_archivo_actual" value="<?=$archivo?>">
   			&nbsp;<input class="menu2_abm" type="file" name="archivo_archivo" id="id.archivo_archivo" <?if($archivo != ""){?> DISABLED<?}?> >
       </td>
      </tr>
      <tr>
        <td valign="top" align="right">&nbsp;</td>
        <td valign="top" style="<?=$RED_FONT?>">
        &nbsp;&nbsp;Este archivo es opcional.<br>
		</td>
      </tr>
      <?
      if (($accion == 'MOD') && ($archivo <> ""))	{
      	
		$width = 0;
		$height = 0;
		$sizeStr = "";
		if (file_exists(EVENTOS_DIR . $archivo))
		{
			$size = filesize(EVENTOS_DIR . $archivo);
			if ($size > 1024)
				$sizeStr = (intval($size/1024) + 1) . " KB";
			else
				$sizeStr = $size . " B";
		}
      	
      ?>
      <tr>
        <td valign="middle" align="right" class="menu2_abm" nowrap></td>
        <td valign="top" class="menu2_abm">
        	<table border="0" cellspacing="0" cellpadding="0"><tr>
        		<td>&nbsp;&nbsp;&nbsp;</td>
        		<td class="menu2_abm">
        			<a href="<?=EVENTOS_DIR?><?=$archivo?>" target="_blank">[<?=EVENTOS_DIR?><b><?=$archivo?></b>]</a><br>
        			Tamaño: <?=$sizeStr?>
        		</td>
        	</tr></table>
        </td>
      </tr>
      <?}?>


	<!-- ********************************************************** -->
	<!-- ********************************************************** -->
	<!-- ********************************************************** -->
      
      </table></td></tr>
    </table>
  </form>
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
		
		if (!verificarFecha(form.elements['fecha_inicio'].value))	{
			alert("Error en formato de fecha de inicio (dd-mm-aaaa)");
			form.elements['fecha_inicio'].focus();
			return false;
		}
		if ((form.elements['fecha_fin'].value != "") &&
			(!verificarFecha(form.elements['fecha_fin'].value)))
		{
			alert("Error en formato de fecha de fin (dd-mm-aaaa)");
			form.elements['fecha_fin'].focus();
			return false;
		}
		
		if (form.elements['lugar'].value == "")	{
			form.elements['lugar'].focus();
			alert("Debe ingresar el lugar del evento.");
			return false;
		}
		if (form.elements['titulo'].value == "")	{
			form.elements['titulo'].focus();
			alert("Debe ingresar el título en español.");
			return false;
		}
		if (form.elements['titulo_por'].value == "")	{
			form.elements['titulo_por'].focus();
			alert("Debe ingresar el título en portugués.");
			return false;
		}
		if (form.elements['texto'].value == "")	{
			form.elements['texto'].focus();
			alert("Debe ingresar el contenido del evento en español.");
			return false;
		}
		if (form.elements['texto_por'].value == "")	{
			form.elements['texto_por'].focus();
			alert("Debe ingresar el contenido del evento en portugués.");
			return false;
		}
		
		form.submit();
		return true;
	}
	
	// sólo en el caso de caracteres especiales
	document.forms['data'].elements['lugar'].value = "<?=$lugar?>";
	document.forms['data'].elements['titulo'].value = "<?=$titulo?>";
	document.forms['data'].elements['titulo_por'].value = "<?=$titulo_por?>";
	

</script>

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
<title>Listado de eventos</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="styles.css" type="text/css">
</head>

<body bgcolor="#EBEBEB" link="#153579" vlink="#153579" alink="#153579" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
  <? include ('header.php');?>

<p align=center><b><font face="Arial, Helvetica, sans-serif" size="3">Listado de eventos</b></p>

<p align=center>
	<input type="button" name="boton" value="Nuevo evento" onclick="location='eventos.php?accion=ALTA';" style="width:150px"/>
	&nbsp;&nbsp;&nbsp;
	<input type="button" name="boton2" value="Menú" onclick="location='<?=MAIN_PAGE?>';" style="width:150px"/>
</p>


<table width="80%" border="0" cellspacing="0" cellpadding="0" align="center">

	  <tr bgcolor="#BCCCCC" height="25px"> 
	  	<td></td>
	  	<td></td>
	  	<td></td>
	  	<td></td>
	    <!--<td class="txt2_abm" nowrap>Fecha</td>-->
	    <td class="txt2_abm" nowrap>
	    	<table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0"<?if($orderby == "fecha_inicio"){?> bgcolor="#5ecccc"<?}?>><tr>
	    		<td width="99%" class="txt2_abm_selected" nowrap>
	    		<?
	    		if ($orderby == "fecha_inicio")
	    			print "Fecha de inicio";
	    		else
	    		{
	    			print "<a href=\"" . $_SERVER['PHP_SELF'] . "?orderby=fecha_inicio" . "\" title=\"Ordenar esta columna\">";
	    			print "Fecha de inicio";
	    			print "</a>";
	    		}
	    		?>
	    		</td>
	    		<td nowrap>
	    		<?
	    		print "&nbsp;";
	    		if ($orderby == "fecha_inicio")
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
	    <!--<td class="txt2_abm" nowrap width="99%">Título (en español)</td>-->
	    <td class="txt2_abm" nowrap width="99%">
	    	<table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0"<?if($orderby == "titulo"){?> bgcolor="#5ecccc"<?}?>><tr>
	    		<td width="99%" class="txt2_abm_selected">
	    		<?
	    		if ($orderby == "titulo")
	    			print "Título (en español)";
	    		else
	    		{
	    			print "<a href=\"" . $_SERVER['PHP_SELF'] . "?orderby=titulo" . "\" title=\"Ordenar esta columna\">";
	    			print "Título (en español)";
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
	    <td class="txt2_abm" nowrap align="center">¿Tiene imagen?</td>
	    <td>&nbsp;&nbsp;&nbsp;</td>
	    <td class="txt2_abm" nowrap align="center">¿Tiene archivo?</td>
	    <td>&nbsp;</td>
	  </tr>
		<tr>
		    <td bgcolor="#CCCCCC" colspan="15" height="1"></td>
		</tr>

<?
	
	$sql = "SELECT * FROM $TABLA ";
//	$sql.= " ORDER BY fecha_inicio, id";
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
		$fecha_inicio = mysql_result($res, $idx,'fecha_inicio');
		$fecha_fin = mysql_result($res, $idx,'fecha_fin');
		$titulo = mysql_result($res, $idx,'titulo');
		$titulo_por = mysql_result($res, $idx,'titulo_por');
		$imagen = mysql_result($res, $idx,'imagen');
		$archivo = mysql_result($res, $idx,'archivo');
		$publicado = mysql_result($res, $idx,'publicado');

		$fecha_inicio_str = substr($fecha_inicio,6,2).'-'.substr($fecha_inicio,4,2).'-'.substr($fecha_inicio,0,4);
		$fecha_fin_str = substr($fecha_fin,6,2).'-'.substr($fecha_fin,4,2).'-'.substr($fecha_fin,0,4);
		$fecha_str = ($fecha_inicio_str == $fecha_fin_str) ? $fecha_inicio_str : ($fecha_inicio_str . " - " . $fecha_fin_str);
		
		$publicado_str = ($publicado=='S') ? "Publicado" : "No publicado";
		
?>
		<tr height="25">
		    <td class="txt_abm">&nbsp;</td>
		    <td nowrap>
		    	<img src="img/edit_icon.gif" style="cursor:hand" onclick="javascript:location='eventos.php?accion=MOD&id=<?=$id?>'" alt="Editar">
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
		    	<?if ($publicado == 'S') {?>Sí<?}else{?>No<?}?>
		    </td>
		    <td class="txt_abm" align="center">
		    	&nbsp;&nbsp;
		    	<?if ($publicado == 'S') {?>
		    		<input type="button" class="boton" name="pub1" value="No Publicar" onclick="location='eventos.php?accion=PUBLICADONO&id=<?=$id?>'" style="height:17px">
		    	<?}else{?>
		    		<input type="button" class="boton" name="pub2" value="Publicar"  onclick="location='eventos.php?accion=PUBLICADOSI&id=<?=$id?>'" style="height:17px">
		    	<?}?>
		    </td>

		    <td class="txt_abm">&nbsp;&nbsp;</td>
		    <td class="txt_abm" align="center">
		    	<?if ($imagen != '') {?>Sí<?}else{?>No<?}?>
		    </td>
		    <td class="txt_abm">&nbsp;&nbsp;</td>
		    <td class="txt_abm" align="center">
		    	<?if ($archivo != '') {?>Sí<?}else{?>No<?}?>
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
		var conf = confirm("¿Está seguro que desea eliminar el evento?");
		if (conf)	{
			window.location="eventos.php?accion=BAJA&id="+id;
		}
	}
</script>

<br>
<br>
<p align=center>
	<input type="button" name="boton" value="Nuevo evento" onclick="location='eventos.php?accion=ALTA';" style="width:150px"/>
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


