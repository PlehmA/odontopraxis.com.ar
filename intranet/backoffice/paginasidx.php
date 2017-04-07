<?
include ('lib.inc');
include ('checks.inc');
include ('util/httpclient.php');
include ('paginasidx.inc.php');

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
	($accion != 'PUBLICADONO') &&
	($accion != 'IDX')
	)	{
	?><META HTTP-EQUIV="Refresh" CONTENT="0; URL=<?=MAIN_PAGE?>"><?
	return;
	}

include ('conect.inc');


$TABLA = DB_PREFIX . "paginasidx" ;

$tiposIndexacion = Array(
					Array("id" => "total", "nombre" => "Total", "clave" => ""),
					Array("id" => "etiq1", "nombre" => "Parcial", "clave" => "IDXCRMLATAM1")
					);


//////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////
/*	
	function getIdxKeyStart($key)
	{
	//	print "getIdxKeyStart(key=$key)<br>";
		return "<!-- " . $key . " START -->";
	}
	function getIdxKeyEnd($key)
	{
		return "<!-- " . $key . " END -->";
	}
	
	
	function preprocessXMLString($srcString)
	{
		$resString = $srcString;
		
		$ISO_CHARSET = "<?xml version=\"1.0\" encoding=\"ISO-";
		$pos = stripos($resString, $ISO_CHARSET);
		if (($pos !==  false) && ($pos == 0))	// es ISO!!!
		{
		//	print ("preprocessXMLString -> Codificando a UTF-8...<br>");
			$resString = utf8_encode($resString);
		}
		return $resString;
	}
	
	function getWords($str)
	{
		$words = split("[\n\r\t ]+", $str);
		$str1 = "";
		for ($i = 0; $i < sizeof($words); $i++)
		{
			if (trim($words[$i]) == '') continue;
			if ($i > 0) $str1 .= " ";
			$str1 .= $words[$i];
		}
		return $str1;
	}
	
	function processPageText($str1, $tipoIndexacion)
	{
		$str = $str1;
		
		if ($tipoIndexacion != '')	// filtrar cadenas
		{
			$etiquetaEncontrada = false;
			$ETIQUETA_INICIO = getIdxKeyStart($tipoIndexacion);
			$ETIQUETA_FIN = getIdxKeyEnd($tipoIndexacion);
			$strFiltrado = "";
			$lastPos = 0;
			while (true)
			{
			//	$pos1 = strpos(strtolower($str), $ETIQUETA_INICIO, $lastPos);
				$pos1 = strpos($str, $ETIQUETA_INICIO, $lastPos);
				if ($pos1 !== false)	// encontrado
				{
					$etiquetaEncontrada = true;
				//	$pos2 = strpos(strtolower($str), $ETIQUETA_FIN, $pos1 + strlen($ETIQUETA_INICIO));
					$pos2 = strpos($str, $ETIQUETA_FIN, $pos1 + strlen($ETIQUETA_INICIO));
					if ($pos2 !== false)	// encontrado
					{
						$strFiltrado .= " " . substr($str, $pos1 + strlen($ETIQUETA_INICIO), $pos2 - ($pos1 + strlen($ETIQUETA_INICIO)));
						$lastPos = $pos2 + strlen($ETIQUETA_FIN);
					}
					else
					{
						$lastPos = $pos1 + strlen($ETIQUETA_INICIO);
					}
				}
				else
					break;
			}
		//	if ($strFiltrado != '')
			if ($etiquetaEncontrada)
				$str = $strFiltrado;
		}
		
		$SCRIPT_START = "<script";
		$SCRIPT_END = "</script>";
		// eliminar los <script>..</script>
		$lastPos = 0;
		while (true)
		{
			$pos1 = strpos(strtolower($str), $SCRIPT_START, $lastPos);
			if ($pos1 !== false)	// encontrado
			{
				$pos2 = strpos(strtolower($str), $SCRIPT_END, $pos1 + strlen($SCRIPT_START));
				if ($pos2 !== false)	// encontrado
				{
				//	$str = substr($str, $pos1, $pos2 + strlen($SCRIPT_END) - $pos1);
					$tempStr = substr($str, 0, $pos1);
					$tempStr.= substr($str, $pos2 + strlen($SCRIPT_END));
					$str = $tempStr;
					$lastPos = 0;
				}
				else
				{
					$lastPos = $pos1 + strlen($SCRIPT_START);
				}
			}
			else
				break;
		}

		$str = strip_tags($str);
		
		$str = getWords($str);
	//	print "str: $str<br>";

		return $str;
	}

	function getStandardUrl($page)
	{
		$domain = $_SERVER['HTTP_HOST'];
	//	$path = $_SERVER['SCRIPT_NAME'];
	//	print "domain: $domain<br>";
	//	print "path: $path<br>";
		$path_parts = split("\/", $_SERVER['SCRIPT_NAME']);
	//	print_r ($path_parts); print "<br>";
		
		$path = "";
		for ($i = 0; $i < sizeof($path_parts)-2; $i++)	// discard 'backoffice' and script-name
		{
			if ($path_parts[$i] != '')
				$path.= "/" . $path_parts[$i];
		}
	//	print "path: $path<br>";
		
		$newUrl = "http://" . $domain . $path;
		
		$pos = strpos($page, "/");
		if (($pos !== false) && ($pos == 0))
			$newUrl.= $page;
		else
			$newUrl.= "/" . $page;

		return $newUrl;
	}

	function actualizarPagina($tabla, $id)
	{
		$encontrado = false;
		$sql = "SELECT * FROM $tabla WHERE id='$id'";
		
		$res = mysql_query($sql);
		if (mysql_num_rows($res) >= 1)
		{
			$encontrado = true;
			$url = stripslashes(mysql_result($res,0,'url'));
			$fullurl = mysql_result($res,0,'fullurl');
			$titulo = stripslashes(mysql_result($res,0,'titulo'));
			$texto = mysql_result($res,0,'texto');
			$habilitado = mysql_result($res,0,'habilitado');
			$indexado = mysql_result($res,0,'indexado');
			$fecha_actualizacion = mysql_result($res,0,'fecha_actualizacion');
			$tipo = mysql_result($res,0,'tipo');
		}
		mysql_free_result($res);
		
		if (!$encontrado)
			return false;
		
		$texto = '';
		$indexado = 'S';
		
	//	print "fullurl: $fullurl<br>";
	//	$pageContents = preprocessXMLString(HttpClient::quickGet($fullurl));
		$pageContents = HttpClient::quickGet($fullurl);
		$texto = processPageText($pageContents, $tipo);
	//	print "pageContents:<br>$pageContents<br>";
	
		$sql = "UPDATE $tabla SET texto='$texto', indexado='$indexado', fecha_actualizacion=NOW() ";
		$sql.= " WHERE id='$id'";
		mysql_query($sql);
		
		return ($indexado == 'S');
	}
*/
?>

<?

///////////////////////////////////////////////
// Alta de registro
if ($accion == 'ALTA_UPD')	{

	$url = addSlashes($_POST['url']);
	$titulo = addSlashes($_POST['titulo']);
	$tipo = addSlashes($_POST['tipo']);
	
	$fullurl = getStandardUrl($url);
	$texto = '';
	$habilitado = 'S';
	$indexado = 'N';

	//////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////
	
	$sql = "INSERT INTO $TABLA ( ";
	$sql.= 						" url, fullurl, titulo, texto, ";
	$sql.= 						" habilitado, indexado, fecha_actualizacion, tipo) ";
	$sql.= 			"VALUES ( ";
	$sql.= 						"'$url', '$fullurl', '$titulo', '$texto', ";
	$sql.=						"'$habilitado', '$indexado', NOW(), '$tipo')";
//	print $sql;
	mysql_query($sql);
	$insert_id = mysql_insert_id();
	
	actualizarPagina($TABLA, $insert_id)
	
	?><META HTTP-EQUIV="Refresh" CONTENT="0; URL=paginasidx.php"><?
	return;
}

///////////////////////////////////////////////
// Actualización de registro
if ($accion == 'MOD_UPD')	{
	$id=$_GET['id'];

	$url = addSlashes($_POST['url']);
	$titulo = addSlashes($_POST['titulo']);
	$tipo = addSlashes($_POST['tipo']);

	$fullurl = getStandardUrl($url);
	//////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////

	$sql = "UPDATE $TABLA SET ";
	$sql.=			" url='$url', fullurl='$fullurl', titulo='$titulo',";
	$sql.=			" fecha_actualizacion=NOW(), tipo='$tipo'";
	$sql.= " WHERE id='$id'";
//	print "sql: $sql<br>";
	mysql_query($sql);
	
	actualizarPagina($TABLA, $id);
	
	/////////////////////////////
	?><META HTTP-EQUIV="Refresh" CONTENT="0; URL=paginasidx.php?accion=MOD&id=<?=$id?>"><?
	return;
}


///////////////////////////////////////////////
// Baja de registro
if ($accion == 'BAJA')	{
	$id=$_GET['id'];

	$sql = "DELETE FROM $TABLA WHERE id='$id'";
//	print $sql;
	mysql_query($sql);

	?><META HTTP-EQUIV="Refresh" CONTENT="0; URL=paginasidx.php"><?
	return;
}



///////////////////////////////////////////////
// Setear publicado -> S
if ($accion == 'PUBLICADOSI')	{
	$id=$_GET['id'];
	$sql = "UPDATE $TABLA SET habilitado='S' WHERE id='$id'";
	mysql_query($sql);
	?><META HTTP-EQUIV="Refresh" CONTENT="0; URL=paginasidx.php"><?
	return;
}

///////////////////////////////////////////////
// Setear publicado -> N
if ($accion == 'PUBLICADONO')	{
	$id=$_GET['id'];
	$sql = "UPDATE $TABLA SET habilitado='N' WHERE id='$id'";
	mysql_query($sql);
	?><META HTTP-EQUIV="Refresh" CONTENT="0; URL=paginasidx.php"><?
	return;
}

///////////////////////////////////////////////
// Indexar todos
if ($accion == 'IDX')	{
	
	$ids = Array();
	$sql = "SELECT * FROM $TABLA ";
	$sql.= " ORDER BY url, titulo";
	$res = mysql_query($sql);
	$total = mysql_num_rows($res);
	$idx = 0;
	while ($idx < $total)	{
		$id = mysql_result($res, $idx,'id');
		array_push($ids, $id);
		$idx++;
	}
	mysql_free_result($res);
	
	for ($i = 0; $i < sizeof($ids); $i++)
	{
		actualizarPagina($TABLA, $ids[$i]);
	}
	
	?><META HTTP-EQUIV="Refresh" CONTENT="0; URL=paginasidx.php"><?
	return;
}




///////////////////////////////////////////////
// Actualización de registro
if (($accion == 'MOD') || ($accion == 'ALTA'))	{
	
	$id="";
	$targetAction="ALTA_UPD";
	$page_title = "Alta de Página Indexada";
	
	$url = "";
	$titulo = "";
	$texto = "";
	$habilitado = "";
	$indexado = "N";
	$fecha_actualizacion = null;
	$tipo = "";
	$backpage = "paginasidx.php";
	
	if ($accion == 'MOD')	{
		
		$id=$_GET['id'];
		$targetAction="MOD_UPD";

		$sql="SELECT * FROM $TABLA WHERE id='$id'";
		$res=mysql_query($sql);
		if (mysql_num_rows($res)<1) {
			mysql_free_result($res);
			?><META HTTP-EQUIV="Refresh" CONTENT="0; URL=paginasidx.php"><?
			return;	
		}
		$page_title = "Edición de Página Indexada";
		$backpage = "paginasidx.php";
		
		$url = mysql_result($res,0,'url');
		$titulo = mysql_result($res,0,'titulo');
		$texto = mysql_result($res,0,'texto');
		$habilitado = mysql_result($res,0,'habilitado');
		$indexado = mysql_result($res,0,'indexado');
		$fecha_actualizacion = mysql_result($res,0,'fecha_actualizacion');
		$tipo = mysql_result($res,0,'tipo');
		
		mysql_free_result($res);
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
 <form method="post" action="paginasidx.php?accion=<?=$targetAction?>&id=<?=$id?>" name="data" enctype="multipart/form-data">
 <input type="hidden" name="id" value="<?=$id?>">
 
   <table border="0" cellspacing="0" cellpadding="0" align="center">

      <tr> 
        <td valign="middle" align="left" class="menu2_abm" nowrap>Url</td>
        <td nowrap>&nbsp;&nbsp;</td>
        <td valign="top"> 
          <input type="text" class="menu2_abm" name="url" size="50" maxlength="80" value="">
        </td>
      </tr>
      
      <tr><td height="10px"></td></tr>
      <tr> 
        <td valign="middle" align="left" class="menu2_abm" nowrap>Título</td>
        <td nowrap>&nbsp;&nbsp;</td>
        <td valign="top"> 
          <input type="text" class="menu2_abm" name="titulo" size="50" maxlength="80" value="">
        </td>
      </tr>
   		
      <tr><td height="10px"></td></tr>
      <tr> 
        <td valign="middle" align="left" class="menu2_abm" nowrap>Fecha de actualización</td>
        <td nowrap>&nbsp;&nbsp;</td>
        <td class="menu2_abm"> 
          <?if (is_null($fecha_actualizacion)) {?>
          	<b>No actualizado</b>
          <?}else{?>
          	</b><?=$fecha_actualizacion?></b>
          <?}?>
        </td>
      </tr>
   
   	<?if (!is_null($fecha_actualizacion)) {?>
      <tr><td height="10px"></td></tr>
      <tr> 
        <td valign="middle" align="left" class="menu2_abm" nowrap>Indexado</td>
        <td nowrap>&nbsp;&nbsp;</td>
        <td class="menu2_abm"> 
          <b><?if ($indexado == 'S') {?>Sí<?}else{?>No<?}?></b>
        </td>
      </tr>
    <?}?>
   
      <tr><td height="10px"></td></tr>
      <tr> 
        <td valign="top" align="left" class="menu2_abm" nowrap>Tipo de indexación</td>
        <td nowrap>&nbsp;&nbsp;</td>
        <td valign="top" class="menu2_abm">
          <table border="0" cellpadding="0" cellspacing="0" width="100%">
          <?for ($i = 0; $i < sizeof($tiposIndexacion); $i++){
          ?>
          	<tr>
          	  <td class="menu2_abm">
          	  	<input type="radio" name="tipo_tmp" class="menu2_abm" value="<?=$tiposIndexacion[$i]["clave"]?>" <?if ($tiposIndexacion[$i]["clave"] == $tipo) echo " checked";?> onclick="this.form.elements['tipo'].value=this.value;">
          	  </td>
          	  <td class="menu2_abm">&nbsp;<?=$tiposIndexacion[$i]["nombre"]?></td>
          	</tr>
          	<tr>
          	  <td class="menu2_abm"></td>
          	  <td class="menu2_abm"><font color="red" size="1">
	          	<?if ($tiposIndexacion[$i]["clave"] == "") {?>
	          		Se indexará toda la página
	          	<?}else{?>
	          		Se indexará los contenidos de la página que estén entre las<br>siguientes etiquetas HTML:
	          		 <b><?=htmlentities(getIdxKeyStart($tiposIndexacion[$i]["clave"]))?></b><br>
	          		 y <b><?=htmlentities(getIdxKeyEnd($tiposIndexacion[$i]["clave"]))?></b>
	          	<?}?>
          	  </font></td>
          	</tr>
          <?}?>
          </table>
          <input type="hidden" name="tipo" value="<?=$tipo?>"/>
        </td>
      </tr>
   		
   </table>
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
		
		if (form.elements['url'].value == "")	{
			form.elements['url'].focus();
			alert("Debe ingresar la url de la página a indexar.");
			return false;
		}
		
		var haySeleccion = false;
		var field = form.elements['tipo_tmp'];
		for (i = 0; i < field.length; i++)
		{
			if (field[i].checked)
			{
				haySeleccion = true;
				break;
			}
		}
		if (!haySeleccion)
		{
			alert("Debe seleccionar un tipo de indexación");
			return false;
		}
		
		form.submit();
		return true;
	}
	
	// sólo en el caso de caracteres especiales
	document.forms['data'].elements['url'].value = "<?=$url?>";
	document.forms['data'].elements['titulo'].value = "<?=$titulo?>";

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
<title>Listado de páginas indexadas</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="styles.css" type="text/css">
</head>

<body bgcolor="#EBEBEB" link="#153579" vlink="#153579" alink="#153579" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
  <? include ('header.php');?>

<p align=center><b><font face="Arial, Helvetica, sans-serif" size="3">Listado de páginas indexadas</b></p>

<p align=center>
	<input type="button" name="boton" value="Nueva página indexada" onclick="location='paginasidx.php?accion=ALTA';" style="width:150px"/>
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
	    <td class="txt2_abm" nowrap>Url</td>
	    <td>&nbsp;&nbsp;</td>
	    <td class="txt2_abm" nowrap>Título</td>
	    <td>&nbsp;&nbsp;&nbsp;</td>
	    <td class="txt2_abm" nowrap>Actualización</td>
	    <td>&nbsp;&nbsp;</td>
	    <td class="txt2_abm" nowrap colspan="2" align="center">Habilitado</td>
	    <td>&nbsp;&nbsp;&nbsp;</td>
	    <td class="txt2_abm" nowrap align="center">¿Indexado?</td>
	    <td>&nbsp;&nbsp;&nbsp;</td>
	    <td class="txt2_abm" nowrap align="center">Tipo</td>
	    <td>&nbsp;</td>
	  </tr>
		<tr>
		    <td bgcolor="#CCCCCC" colspan="17" height="1"></td>
		</tr>

<?
	
	$sql = "SELECT * FROM $TABLA ";
	$sql.= " ORDER BY url, titulo";
	$res = mysql_query($sql);
	$total = mysql_num_rows($res);

	$idx = 0;
	while ($idx < $total)	{

		$id = mysql_result($res, $idx,'id');
		$url = mysql_result($res, $idx,'url');
		$titulo = mysql_result($res, $idx,'titulo');
		$habilitado = mysql_result($res, $idx,'habilitado');
		$indexado = mysql_result($res, $idx,'indexado');
		$fecha_actualizacion = mysql_result($res, $idx,'fecha_actualizacion');
		$tipo = mysql_result($res, $idx,'tipo');

    	$tipo_str = "";
    	for ($i = 0; $i < sizeof($tiposIndexacion); $i++)
    	{
    		if ($tiposIndexacion[$i]["clave"] == $tipo)
    		{
    			$tipo_str = $tiposIndexacion[$i]["nombre"];
    			break;
    		}
    	}

?>
		<tr height="25">
		    <td class="txt_abm">&nbsp;</td>
		    <td nowrap>
		    	<img src="img/edit_icon.gif" style="cursor:hand" onclick="javascript:location='paginasidx.php?accion=MOD&id=<?=$id?>'" alt="Editar">
		    </td>
		    <td nowrap>
		    	<img src="img/delete_icon.gif" style="cursor:hand" alt="Borrar" class="menu_abm" onclick="javascript:borrar('<?=$id?>')">
		    	&nbsp;
		    </td>
		    <td class="txt_abm">&nbsp;&nbsp;&nbsp;</td>
		    <td class="txt_abm" nowrap>
		    	<?=stripslashes($url)?>
		    </td>
		    <td class="txt_abm">&nbsp;&nbsp;</td>
		    <td class="txt_abm" width="90%">
		    	<?=stripslashes($titulo)?>
		    </td>
		    <td class="txt_abm">&nbsp;&nbsp;&nbsp;</td>

		    <td class="txt_abm" nowrap>
		    	<?=$fecha_actualizacion?>
		    </td>
		    <td class="txt_abm">&nbsp;&nbsp;&nbsp;</td>
		    <td class="txt_abm" align="center">
		    	<?if ($habilitado == 'S') {?>Sí<?}else{?>No<?}?>
		    </td>
		    <td class="txt_abm" align="center">
		    	&nbsp;&nbsp;
		    	<?if ($habilitado == 'S') {?>
		    		<input type="button" class="boton" name="pub1" value="No Habilitar" onclick="location='paginasidx.php?accion=PUBLICADONO&id=<?=$id?>'" style="height:17px">
		    	<?}else{?>
		    		<input type="button" class="boton" name="pub2" value="Habilitar"  onclick="location='paginasidx.php?accion=PUBLICADOSI&id=<?=$id?>'" style="height:17px">
		    	<?}?>
		    </td>

		    <td class="txt_abm">&nbsp;&nbsp;</td>
		    <td class="txt_abm" align="center">
		    	<?if ($indexado == 'S') {?>Sí<?}else{?><font color=red>No</font><?}?>
		    </td>
		    <td class="txt_abm">&nbsp;&nbsp;</td>
		    <td class="txt_abm" align="center">
		    	<?=$tipo_str?>
		    </td>
		    
		    <td class="txt_abm">&nbsp;</td>
		</tr>
		<tr>
		    <td bgcolor="#CCCCCC" colspan="17" height="1"></td>
		</tr>
<?
		$idx++;
	}
	mysql_free_result($res);
?>

</table>



<script language="Javascript">
	function borrar(id)	{
		var conf = confirm("¿Está seguro que desea eliminar la página indexada?");
		if (conf)	{
			window.location="paginasidx.php?accion=BAJA&id="+id;
		}
	}
</script>

<br>
<br>
<p align=center>
	<input type="button" name="boton" value="Nueva página indexada" onclick="location='paginasidx.php?accion=ALTA';" style="width:150px"/>
	&nbsp;&nbsp;&nbsp;
	<input type="button" name="boton" value="Indexar todos" onclick="location='paginasidx.php?accion=IDX';" style="width:150px"/>
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


