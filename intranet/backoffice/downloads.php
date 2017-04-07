<?
include ('lib.inc');
include ('checks.inc');
include ('util/httpclient.php');
include ('paginasidx.inc.php');


$listaUrl = (isset($_GET[LISTA_PARAM])) ? $_GET[LISTA_PARAM] : $_SERVER['PHP_SELF'];
$THIS_PAGE = $_SERVER['PHP_SELF'];

//print "listaUrl: $listaUrl<br>";

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
	($accion != 'PUBLICADONO') &&
	($accion != 'IMG') &&
	($accion != 'UPDATE_IMG') &&
	($accion != 'BAJA_IMG')

	)	{
	?><META HTTP-EQUIV="Refresh" CONTENT="0; URL=<?=MAIN_PAGE?>"><?
	return;
	}

include ('conect.inc');


$TABLA = DB_PREFIX . "downloads" ;
$TABLA_CATEGORIAS = DB_PREFIX . "downloads_categorias" ;
$TABLA_IMG = DB_PREFIX . "downloads_img" ;


//////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////


?>

<?

///////////////////////////////////////////////
// Alta de registro
if ($accion == 'ALTA_UPD')	{

	$categoria = addSlashes($_POST['categoria']);
	$titulo = addSlashes($_POST['titulo']);
	$descripcion = '';
	
	$publicado = 'N';

	$imagen = "";
	$archivo = "";

	//////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////
	
	if ($_POST['archivo_archivo_cambio'] == 'S')
	{
		$upload_dir = DOWNLOADS_DIR;
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
	
	$sql = "INSERT INTO $TABLA (categoria, fecha_creacion, ";
	$sql.= 						" titulo, descripcion, ";
	$sql.= 						"archivo, publicado) ";
	$sql.= 			"VALUES ('$categoria', NOW(), ";
	$sql.= 						"'$titulo', '$descripcion', ";
	$sql.=						"'$archivo', '$publicado')";
	//print $sql;
	mysql_query($sql);

	/////////////////////////////
	//	actualizar páginas de whitepapers
	actualizarPaginaPorUrl(DB_PREFIX, "downloads.php");
	
	?><META HTTP-EQUIV="Refresh" CONTENT="0; URL=<?=$listaUrl?>"><?
	return;
}

///////////////////////////////////////////////
// Actualización de registro
if ($accion == 'MOD_UPD')	{
	$id = $_GET['id'];

	$categoria = addSlashes($_POST['categoria']);
	$titulo = addSlashes($_POST['titulo']);
	$descripcion = '';

	$archivo = $_POST['archivo_archivo_actual'];
	if ($_POST['archivo_archivo_cambio'] == 'S')
	{
		$upload_dir = DOWNLOADS_DIR;
		
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
		$upload_dir = DOWNLOADS_DIR;
	//	print "Borrar: " . $upload_dir . $imagen . "<br>";
		if (($archivo != '') && (file_exists($upload_dir . $archivo)))
		{
			if (unlink($upload_dir . $archivo))	// archivo actual eliminado!
				$archivo = "";
		}
	}
	
	//////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////

	$sql = "UPDATE $TABLA SET categoria='$categoria', ";
	$sql.=			" titulo='$titulo', ";
	$sql.=			" archivo='$archivo' ";
	$sql.= " WHERE id='$id'";
//	print "sql: $sql<br>";
	mysql_query($sql);
	
	/////////////////////////////
	//	actualizar páginas de whitepapers
	actualizarPaginaPorUrl(DB_PREFIX, "downloads.php");
	
	/////////////////////////////
	?><META HTTP-EQUIV="Refresh" CONTENT="0; URL=<?=$THIS_PAGE?>?accion=MOD&id=<?=$id?>&<?=LISTA_PARAM?>=<?=urlencode($listaUrl)?>"><?
	return;
}


///////////////////////////////////////////////
// Baja de registro
if ($accion == 'BAJA')	{
	$id=$_GET['id'];

//	$imagen = "";
	$archivo = "";
	
	$sql = "SELECT * FROM $TABLA WHERE id='$id'";
	$res = mysql_query($sql);
	$total = mysql_num_rows($res);
	if ($total > 0) {
	//	$imagen = mysql_result($res,0,'imagen');
		$archivo = mysql_result($res,0,'archivo');
	}
	mysql_free_result($res);
	
	if ($total > 0)
	{
		$upload_dir = DOWNLOADS_DIR;
		// soporte para vieja implementación
		if (($archivo != '') && (file_exists($upload_dir . $archivo)))
		{
			if (unlink($upload_dir . $archivo))	// archivo actual eliminado!
				$archivo = "";
		}
	}
	
	$sql = "DELETE FROM $TABLA WHERE id='$id'";
//	print $sql;
	mysql_query($sql);

	
	/////////////////////////////
	//	actualizar páginas de whitepapers
	actualizarPaginaPorUrl(DB_PREFIX, "downloads.php");
	
	?><META HTTP-EQUIV="Refresh" CONTENT="0; URL=<?=$listaUrl?>"><?
	return;
}



///////////////////////////////////////////////
// Setear publicado -> S
if ($accion == 'PUBLICADOSI')	{
	$id=$_GET['id'];
	$sql = "UPDATE $TABLA SET publicado='S' WHERE id='$id'";
	mysql_query($sql);
	
	/////////////////////////////
	//	actualizar páginas de whitepapers
	actualizarPaginaPorUrl(DB_PREFIX, "downloads.php");
	
	?><META HTTP-EQUIV="Refresh" CONTENT="0; URL=<?=$listaUrl?>"><?
	return;
}

///////////////////////////////////////////////
// Setear publicado -> N
if ($accion == 'PUBLICADONO')	{
	$id=$_GET['id'];
	$sql = "UPDATE $TABLA SET publicado='N' WHERE id='$id'";
	mysql_query($sql);
	
	/////////////////////////////
	//	actualizar páginas de whitepapers
	actualizarPaginaPorUrl(DB_PREFIX, "downloads.php");
	
	?><META HTTP-EQUIV="Refresh" CONTENT="0; URL=<?=$listaUrl?>"><?
	return;
}




///////////////////////////////////////////////
// Actualización de registro
if (($accion == 'MOD') || ($accion == 'ALTA'))	{
	
	$id="";
	$targetAction="ALTA_UPD";
	$page_title = "Alta de Whitepaper/Download";
	
	$categoria = "";
	$fecha_creacion = "";
	$titulo = "";
	$descripcion = "";
	$archivo = "";
	$publicado = "";
	
//	$backpage = $THIS_PAGE;
	$backpage = $listaUrl;
	
	if ($accion == 'MOD')	{
		
		$id=$_GET['id'];
		$targetAction="MOD_UPD";

		$sql="SELECT * FROM $TABLA WHERE id='$id'";
		$res=mysql_query($sql);
		if (mysql_num_rows($res)<1) {
			mysql_free_result($res);
			/*?><META HTTP-EQUIV="Refresh" CONTENT="0; URL=downloads.php"><?*/
			?><META HTTP-EQUIV="Refresh" CONTENT="0; URL=<?=$listaUrl?>"><?
			return;	
		}
		$page_title = "Edición de Whitepaper/Download";
	//	$backpage = $THIS_PAGE;


		$categoria = mysql_result($res,0,'categoria');
		$fecha_creacion = mysql_result($res,0,'fecha_creacion');
		$titulo = mysql_result($res,0,'titulo');
		$descripcion = mysql_result($res,0,'descripcion');
//		$imagen = mysql_result($res,0,'imagen');
		$archivo = mysql_result($res,0,'archivo');
		$publicado = mysql_result($res,0,'publicado');
		
		mysql_free_result($res);
	}
	else	{
		$fecha_creacion = date("d-m-Y  H:m:s");
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


 <form method="post" action="<?=$THIS_PAGE?>?accion=<?=$targetAction?>&id=<?=$id?>&<?=LISTA_PARAM?>=<?=urlencode($listaUrl)?>" name="data" enctype="multipart/form-data">
 <input type="hidden" name="id" value="<?=$id?>">


   <table border="0" cellspacing="0" cellpadding="0" align="center">
   
      <tr> 
        <td valign="top" align="right" class="menu2_abm">Fecha de creación&nbsp;&nbsp;</td>
        <td valign="top" class="menu2_abm"><b><?=$fecha_creacion?><b></td>
      </tr>
      
      <tr><td height="10"></td></tr>
      <tr> 
        <td align="right" class="menu2_abm">Categoría&nbsp;&nbsp;</td>
        <td class="menu2_abm">
        	<select name="categoria" class="menu2_abm">
<?
			$sql = "SELECT * FROM $TABLA_CATEGORIAS ORDER BY orden";
			$res = mysql_query($sql);
			$total = mysql_num_rows($res);
			$idx = 0;
			while ($idx < $total)	{
				$id = mysql_result($res, $idx,'id');
				$nombre = mysql_result($res, $idx,'nombre');
?>
        		<option value="<?=$id?>" <?if ($categoria == $id) print("SELECTED");?>><?=$nombre?></option>
<?
				$idx++;
			}
			mysql_free_result($res);
?>
        	</select>
        </td>
      </tr>
   
      <tr><td height="10"></td></tr>
      <tr> 
        <td align="right" class="menu2_abm">Título&nbsp;&nbsp;</td>
        <td class="menu2_abm">
        	<input type="text" class="menu2_abm" name="titulo" size="45" maxlength="80" value="">
        </td>
      </tr>
      
      
      <tr><td height="10"></td></tr>
		
   
	<!-- ********************************************************** -->
	<!-- ********************************************************** -->
	<!-- ********************************************************** -->
	
      <tr bgcolor="#BCCCCC"><td colspan="3"></td></tr>
      
      <tr height="8"><td colspan="2"/></tr>
      
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
        &nbsp;&nbsp;Este archivo es <b>obligatorio</b>.<br>
        &nbsp;&nbsp;Si no hay archivo, no se publica el download.<br>
		</td>
      </tr>
      <?
      if (($accion == 'MOD') && ($archivo <> ""))	{
      	
		$width = 0;
		$height = 0;
		$sizeStr = "";
		if (file_exists(DOWNLOADS_DIR . $archivo))
		{
			$size = filesize(DOWNLOADS_DIR . $archivo);
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
        			<a href="<?=DOWNLOADS_DIR?><?=$archivo?>" target="_blank">[<?=DOWNLOADS_DIR?><b><?=$archivo?></b>]</a><br>
        			Tamaño: <?=$sizeStr?>
        		</td>
        	</tr></table>
        </td>
      </tr>
      <?}?>


	<!-- ********************************************************** -->
	<!-- ********************************************************** -->
	<!-- ********************************************************** -->
   
   
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
		
		if (form.elements['titulo'].value == "")	{
			form.elements['titulo'].focus();
			alert("Debe ingresar el título.");
			return false;
		}
		form.submit();
		return true;
	}
	
	// sólo en el caso de caracteres especiales
	document.forms['data'].elements['titulo'].value = "<?=$titulo?>";
	

</script>

</body>
</html>

<?
}





if ($accion == "LISTA")	{

	$listHeaders = Array(
					Array("titulo" => "Fecha de creación", "campo" => "fecha_creacion", "celdas" => "1"),
					Array("titulo" => "Categoria", "campo" => "categoria_nombre", "celdas" => "1"),
					Array("titulo" => "Título", "campo" => "titulo", "celdas" => "1"),
					Array("titulo" => "¿Está publicado?", "campo" => "publicado", "celdas" => "2"),
					Array("titulo" => "¿Tiene archivo?", "campo" => "", "celdas" => "1")
				);

	$filtro_orderby = "1";	// Título
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
<title>Listado de whitepapers/downloads</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="styles.css" type="text/css">
</head>

<body bgcolor="#EBEBEB" link="#153579" vlink="#153579" alink="#153579" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
  <? include ('header.php');?>

<p align=center><b><font face="Arial, Helvetica, sans-serif" size="3">Listado de whitepapers/downloads</b></p>

<p align=center>
	<input type="button" name="boton" value="Nuevo whitepaper/download" onclick="javascript:nuevo();" style="width:150px"/>
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
				
				if ($listHeaders[$i]["campo"] == '')
				{
					echo $listHeaders[$i]["titulo"];
				}
				else
				{
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
				}
				echo "</td>";
				echo "<td></td>";
			}
		?>
		</tr>

		<tr>
		    <td bgcolor="#CCCCCC" colspan="19" height="1"></td>
		</tr>

<?
	
	$sql = "SELECT $TABLA.id, $TABLA.fecha_creacion, $TABLA.titulo, ";
	$sql.=  	 " $TABLA.archivo, ";
	$sql.=  	 " $TABLA.publicado, ";
	$sql.=  	 " $TABLA_CATEGORIAS.nombre AS categoria_nombre ";
	$sql.=  " FROM $TABLA ";
	$sql.=  " LEFT JOIN $TABLA_CATEGORIAS ON  $TABLA.categoria = $TABLA_CATEGORIAS.id ";
	if ($listHeaders[$filtro_orderby]["campo"] != '')
		$sql.= " ORDER BY " . $listHeaders[$filtro_orderby]["campo"] . ( ($filtro_order == 0)? " ASC" : " DESC" );
	else
		$sql.= " ORDER BY 1";
	
//	print $sql;
	$res = mysql_query($sql);
	$total = mysql_num_rows($res);

	$idx = 0;
	while ($idx < $total)	{

		$id = mysql_result($res, $idx,'id');
		$fecha_creacion = mysql_result($res, $idx,'fecha_creacion');
		$titulo = mysql_result($res, $idx,'titulo');
		$archivo = mysql_result($res, $idx,'archivo');
		$publicado = mysql_result($res, $idx,'publicado');
		$categoria_nombre = mysql_result($res, $idx,'categoria_nombre');
		
		$publicado_str = ($publicado=='S') ? "Publicado" : "No publicado";
?>
		<tr height="25">
		    <td class="txt_abm">&nbsp;</td>
		    <td nowrap>
		    	<img src="img/edit_icon.gif" style="cursor:hand" onclick="javascript:editar('<?=$id?>');" alt="Editar">
		    	<!--
		    	<img src="img/camera_icon.gif" style="cursor:hand" onclick="javascript:capturas('<?=$id?>');" alt="Editar capturas">
		    	-->
		    	&nbsp;
		    </td>
		    <td nowrap>
		    	<img src="img/delete_icon.gif" style="cursor:hand" alt="Borrar" class="menu_abm" onclick="javascript:borrar('<?=$id?>');">
		    	&nbsp;
		    </td>
		    <td class="txt_abm">&nbsp;&nbsp;&nbsp;</td>
		    <td class="txt_abm" nowrap>
		    	<?=$fecha_creacion?>
		    </td>
		    <td class="txt_abm">&nbsp;&nbsp;</td>
		    <td class="txt_abm" nowrap>
		    	<?=$categoria_nombre?>
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
		    		<input type="button" class="boton" name="pub1" value="No Publicar" onclick="javascript:publicar('<?=$id?>', false);" style="height:17px">
		    	<?}else{?>
		    		<input type="button" class="boton" name="pub2" value="Publicar"  onclick="javascript:publicar('<?=$id?>', true);" style="height:17px">
		    	<?}?>
		    </td>

		    <td class="txt_abm">&nbsp;&nbsp;</td>
		    <td class="txt_abm" align="center">
		    	<?if ($archivo != '') {?>Sí<?}else{?><font color="red"><b>No</b></font><?}?>
		    </td>

		    <td class="txt_abm">&nbsp;</td>
		</tr>
		<tr>
		    <td bgcolor="#CCCCCC" colspan="19" height="1"></td>
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
		window.location = "<?=$THIS_PAGE?>?orderby=" + param + "&rnd=" + Math.random();
	}
	function ordenar(param)
	{
		window.location = "<?=$THIS_PAGE?>?orderby=<?=$filtro_orderby?>&order=" + param + "&rnd=" + Math.random();
	}
	function borrar(id)
	{
		var conf = confirm("¿Está seguro que desea eliminar el archivo?");
		if (conf)	{
			window.location="<?=$THIS_PAGE?>?accion=BAJA&id=" + id + "&<?=LISTA_PARAM?>=" + escape(window.location.href);
		}
	}
	function editar(id)
	{
		window.location = "<?=$THIS_PAGE?>?accion=MOD&id=" + id + "&<?=LISTA_PARAM?>=" + escape(window.location.href);
	}
	function nuevo()
	{
		window.location = "<?=$THIS_PAGE?>?accion=ALTA&<?=LISTA_PARAM?>=" + escape(window.location.href);
	}
	function publicar(id, publicar)
	{
		if (publicar)
			window.location = "<?=$THIS_PAGE?>?accion=PUBLICADOSI&id=" + id + "&<?=LISTA_PARAM?>=" + escape(window.location.href);
		else
			window.location = "<?=$THIS_PAGE?>?accion=PUBLICADONO&id=" + id + "&<?=LISTA_PARAM?>=" + escape(window.location.href);
	}

</script>

<br>
<br>
<p align=center>
	<input type="button" name="boton" value="Nuevo whitepaper/download" onclick="javascript:nuevo();" style="width:150px"/>
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
////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////

?>






