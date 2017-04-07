<?
include ('lib.inc');
include ('checks.inc');

$here = "archivos.php";
$MAX_NEWS = 2;
$accion = "LISTA";
$RED_FONT = "font-family: Arial, Helvetica, sans-serif; font-size: 11px; color: red";

$RESP0 = "Se ha actualizado con &eacute;xito";
$RESP1 = "El archivo ha sido subido exitosamente";
$RESP2 = "Ha ocurrido un error, trate de nuevo!<BR>";
$RESP3 = "El archivo es mayor que 5MB, debes reduzcirlo antes de subirlo<BR>";
$RESP4 = "Los archivos permitidos son : JPG, GIF, PNG, PDF, DOC.<BR>";
$RESP5 = "Ha ocurrido un error subiendo el archivo, trate de nuevo!<BR>";
$RESP6 = "El archivo ya existe.";
$RESP7 = "La carpeta no existe.";

if (isset($_GET['accion'])) 	{
	$accion=$_GET['accion'];
}


if (($accion != 'LISTA') &&
	($accion != 'ALTA') &&
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


$TABLA = DB_PREFIX . "archivos" ;


//////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////
function subirArchivo($target_path, $fileName){

	$uploadedfile_size=$_FILES['uploadedfile'][size];

	$allowedMimeTypes = array( 
			  'application/msword',
			  'text/pdf',
			  'image/gif',
			  'image/jpeg',
			  'image/png',
			  'application/pdf',
			  'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
			  'application/vnd.ms-excel',
			  'application/vnd.ms-powerpoint',
			  
			);

	if($_FILES[uploadedfile][size]!=0){
			
		if ($_FILES[uploadedfile][size]>5000000){
			$resp = 3;
		}else if (! in_array( $_FILES["uploadedfile"]["type"], $allowedMimeTypes ) ){
			$resp = 4;
		}else{
			$target_path = $target_path . $fileName; 
			if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path)) { 
				$resp = 1;
			} else{
				$resp = 5;
			}
		}
	}else{
		$resp = 2;
	}

	return $resp;
}

function existeArchivoEnBase($nombre){
	$sql = "SELECT COUNT(*) AS cant FROM ARCHIVOS WHERE LOWER(nombre) = LOWER('$nombre') ";
	$res = mysql_query($sql);
	$cant = 0;
	//print $sql."</br>";
	if ($res){
		$cant = mysql_result($res,0,'cant');
		mysql_free_result($res);
	}	
	return $cant;
}

function getDirectorio($carpeta){
	$sql = "SELECT nombre AS dir FROM carpetas WHERE id = $carpeta";
	//print $sql."</br>";
	$directorio = null;
	$res = mysql_query($sql);
	if ($res){
		$directorio = mysql_result($res,0,'dir');
		mysql_free_result($res);
	}
	return $directorio;
}


///////////////////////////////////////////////
// Alta de registro
if ($accion == 'ALTA_UPD')	{

	$fecha=date("Y-m-d", time());  
	$nombre = addSlashes($_POST['nombre']);
	$carpeta = addSlashes($_POST['carpeta']);
	$activo = 'N';

	$archivo = "";
	$url = $here;

	$cant = existeArchivoEnBase($nombre);
	
	$target_path = CARPETAS_DIR.OS_FILE_SEPARATOR;
	$fileName = basename( $_FILES['uploadedfile']['name']);
		
		
	if ($cant > 0 or file_exists($target_path.$fileName))	
	{
		$resp = 6;
			
	}else{

		$resp = subirArchivo($target_path, $fileName);
		//print $resp;
		
		if($resp == 1){	
			$tamanio = $_FILES[uploadedfile][size]/1000;
			$sql = "SELECT MAX(id)+1 AS indexId FROM $TABLA";
			$res = mysql_query($sql);
			$indexId = mysql_result($res,0,'indexId');
			mysql_free_result($res);
			
			//////////////////////////////////////////////////////////
			//////////////////////////////////////////////////////////
			
			$sql = "INSERT INTO $TABLA (id, nombre, id_carpeta, archivo, tamanio, fecha, activo) ";
			$sql.= 			"VALUES ($indexId, '$nombre', '$carpeta', '$fileName', '$tamanio', '$fecha','N' )";
			//print $sql;
			$res = mysql_query($sql);
			if ($res){
				$sql = "UPDATE CARPETAS SET fecha = '$fecha' where id = '$carpeta'";
			//	print $sql;
				$res2 = mysql_query($sql);	
			}
		}
	}
	

	if($resp != 1){
		$url = $here."?accion=ALTA&error=".$resp;
	}	

	
	?>
	<META HTTP-EQUIV="Refresh" CONTENT="0; URL=<?=$url?>">
	<?
	return; 
}

///////////////////////////////////////////////
// Actualizaci�n de registro
if ($accion == 'MOD_UPD')	{

	$id=$_GET['id'];
	$url = $here;

	$fecha=$fecha=date("Y-m-d", time()); 
	$nombre = addSlashes($_POST['nombre']);
	$carpeta = addSlashes($_POST['carpeta']);
	$archivo = addSlashes($_POST['archivo']);
	$tamanio = addSlashes($_POST['tamanio']);
	$activo = addSlashes($_POST['activo']);

	$fileName = basename( $_FILES['uploadedfile']['name']);
	//print "filename: ".$fileName;
	$resp = 1;

	if ($fileName){ //subir nuevo archivo
		$cant = existeArchivoEnBase($fileName);
		$target_path = CARPETAS_DIR.OS_FILE_SEPARATOR;
		
		if ($cant > 0 or file_exists($target_path.$fileName))	
		{
			$resp = 6;
			
		}else{

			$resp = subirArchivo($target_path, $fileName);
			if($resp == 1){	
				$archivo = $fileName;
				$tamanio = $_FILES[uploadedfile][size]/1000;
			
			}
		}
	}

	//print "rta: ".$resp;

	if($resp == 1){	

			$sql = "UPDATE $TABLA SET fecha='$fecha', ";
			$sql.=			" nombre='$nombre', id_carpeta='$carpeta', archivo= '$archivo', tamanio = '$tamanio', activo = '$activo' ";
			$sql.= " 		WHERE id='$id'";
			//print $sql;
			$resp = mysql_query($sql);

			if ($resp){
				$sql = "UPDATE CARPETAS SET fecha = '$fecha' where id = '$carpeta'";
			//	print $sql;
				$resp = mysql_query($sql);	
			}

	}else{
			$url = $here."?accion=MOD&id=".$id."&error=".$resp;
	}	
	

		//////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////

	
	?>
		<META HTTP-EQUIV="Refresh" CONTENT="0; URL=<?=$url?>">
		<?
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
	
	$id="";
	$targetAction="ALTA_UPD";
	$page_title = "Alta de Archivo";

	
	$nombre = "";
	$directorio = "";
	$backpage = $here;
	
	if ($accion == 'MOD')	{
		
		$id=$_GET['id'];
		$targetAction="MOD_UPD";

		$sql="SELECT * FROM $TABLA WHERE id='$id'";
		$res=mysql_query($sql);
		if (mysql_num_rows($res)<1) {
			mysql_free_result($res);
			?>
		<META HTTP-EQUIV="Refresh" CONTENT="0; URL=<?=$here?>">
		<?
			return;	
		}
		$page_title = "Edici�n de Archivo";
		$backpage = $here;


		$nombre = mysql_result($res,0,'nombre');
		$carpeta = mysql_result($res,0,'id_carpeta');
		$archivo = mysql_result($res,0,'archivo');
		$tamanio = mysql_result($res,0,'tamanio');
		$activo = mysql_result($res,0,'activo');
		mysql_free_result($res);
	}

	$resp = $_GET['error'];
		if ($resp != ""){

			 	switch ($resp) {
			    case 0:
			        $exito = $RESP0;
			        break;
			    case 1:
			        $exito = $RESP1;
			        break;
			    case 2:
			        $error = $RESP2;
			        break;
			    case 3:
			        $error = $RESP3;
			        break;
			    case 4:
			        $error = $RESP4;
			        break;
			    case 5:
			        $error = $RESP5;
			        break;   
			    case 6:
			        $error = $RESP6;
			        break;   
		    }
		 }   

	$resCarpetas = mysql_query('SELECT id,nombre FROM carpetas');
	$totalCarpetas = mysql_num_rows($resCarpetas);
	$idxCarpetas = 0;
               

	
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>
<?=$page_title?>
</title>

<link rel="stylesheet" href="styles.css" type="text/css">
<script src="util/validations.js"></script>
</head>
<body bgcolor="#EBEBEB" link="#153579" vlink="#153579" alink="#153579" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<? include ('header.php');?>
<p align=center><b><font face="Arial, Helvetica, sans-serif" size="3">
  <?=$page_title?>
  </font></b></p>


<font face="Arial, Helvetica, sans-serif" size="3"> <form method="post" action="<?=$here?>?accion=<?=$targetAction?>&id=<?=$id?>" name="data" enctype="multipart/form-data"> 
<input type="hidden" name="id" value="<?=$id?>">

<br>
<div id="errorDiv">
	<p align="center" class="menu2_abm"><font color="red"><?=$error?></font></p>
</div>



<table border="0" cellspacing="0" cellpadding="0" align="center">
  <tr> 
    <td valign="middle" align="left" class="menu2_abm" nowrap>Nombre&nbsp;&nbsp;</td>
  </tr>
  <tr> 
    <td valign="top"> 
      <input type="text" class="menu2_abm" name="nombre" size="50" maxlength="80" value="">
    </td>
    <td nowrap>&nbsp;&nbsp;</td>
    <td valign="top">&nbsp; </td>
  </tr>
  <tr> 
    <td valign="middle" align="left" class="menu2_abm" nowrap>Carpeta&nbsp;&nbsp;</td>
  </tr>
  <tr> 
    <td valign="top"> 
			<select name="carpeta">
			                  
			            <? 
			                
			               while ($idxCarpetas < $totalCarpetas)	{
				
								$idCarpetas = mysql_result($resCarpetas, $idxCarpetas,'id');
								$nombreCarpetas = mysql_result($resCarpetas, $idxCarpetas,'nombre');

			                    echo "<option value='$idCarpetas'>$nombreCarpetas</option>"; 
			                    $idxCarpetas++;
			                } 
			            ?> 
                </select> 
    </td>
    <td nowrap>&nbsp;&nbsp;</td>
    <td valign="top">&nbsp; </td>
     <tr> 
     	 <td valign="top"> 
     	 	<input type="hidden" name="activo" value="">
      		<input type="hidden" class="menu2_abm" name="archivo" size="50" maxlength="80" value="" >
      		<input type="hidden" class="menu2_abm" name="tamanio" size="50" maxlength="80" value="" >
      		
      		<?=$archivo?>
    	</td>
    </tr>
    <tr>	
     	 <td valign="middle" align="right" class="menu2_abm">
     	 	<? if ($archivo != null){ ?>
     	 		Modificar Archivo&nbsp;&nbsp;
     	 	<? }else{ ?>
				Subir Archivo&nbsp;&nbsp;
     	 	<?} ?>	
     	 </td>

        <td valign="top" > 
          <input name="uploadedfile" type="file" />
        </td>
      </tr>
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
		
			if (form.elements['nombre'].value == "")	{
			form.elements['nombre'].focus();
			alert("Debe ingresar el nombre.");
			return false;
		}
	
		//TODO validar que el nombre del directorio sea sin espacios ni cosas raras
		if (form.elements['carpeta'].value == "")	{
			form.elements['carpeta'].focus();
			alert("Debe ingresar la carpeta donde se alojar�n los archivos.");
			return false;
		}
	
		form.submit();
		return true;
	}
	
	// s�lo en el caso de caracteres nombre
	document.forms['data'].elements['nombre'].value = "<?=$nombre?>";
	document.forms['data'].elements['carpeta'].value = "<?=$carpeta?>";
	document.forms['data'].elements['archivo'].value = "<?=$archivo?>";
	document.forms['data'].elements['tamanio'].value = "<?=$tamanio?>";
	document.forms['data'].elements['activo'].value = "<?=$activo?>";
	

</script>
</table>
</font>
</body>
</html>

<?}?>





<?
if ($accion == "LISTA")	{

	$orderby = (isset($_GET['orderby'])) ? $_GET['orderby'] : "nombre";
	$order = (isset($_GET['order'])) ? $_GET['order'] : "1";

?>

<html>
<head>
<title>Listado de Archivos</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="styles.css" type="text/css">
</head>

<body bgcolor="#EBEBEB" link="#153579" vlink="#153579" alink="#153579" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
  <? include ('header.php');?>

<p align=center><b><font face="Arial, Helvetica, sans-serif" size="3">Listado de Archivos</b></p>

<p align=center>
	<input type="button" name="boton" value="Nuevo archivo" onclick="location='<?=$here?>?accion=ALTA';" style="width:150px"/>
	&nbsp;&nbsp;&nbsp;
	<input type="button" name="boton2" value="Men&uacute;" onclick="location='<?=MAIN_PAGE?>';" style="width:150px"/>
</p>


<table width="80%" border="0" cellspacing="0" cellpadding="0" align="center">

	  <tr bgcolor="#BCCCCC" height="25px"> 
	  	
	    <td>&nbsp;&nbsp;&nbsp;</td>
	    <td>&nbsp;&nbsp;&nbsp;</td>
	    <td class="txt2_abm" nowrap colspan="2" align="center" width="40%">Carpeta</td>
	    <td>&nbsp;&nbsp;&nbsp;</td>
	    <td class="txt2_abm" nowrap colspan="2" align="center" width="40%">Nombre</td>
	    <td>&nbsp;&nbsp;&nbsp;</td>
	    <td class="txt2_abm" nowrap align="center" width="10%">Fecha</td>
	    <td>&nbsp;&nbsp;&nbsp;</td>
	    <td class="txt2_abm" nowrap align="center" width="10%">Tama&ntilde;o (KB)</td>
	     <td>&nbsp;&nbsp;&nbsp;</td>
	    <td class="txt2_abm" nowrap align="center">Activo</td>
	     <td>&nbsp;&nbsp;&nbsp;</td>
	      <td class="txt2_abm" nowrap align="center">Publicar</td>
	     <td>&nbsp;&nbsp;&nbsp;</td>
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
		$nombre = mysql_result($res, $idx,'nombre');
		$carpeta = mysql_result($res, $idx,'id_carpeta');
		$dir = getDirectorio($carpeta);
		$archivo = mysql_result($res, $idx,'archivo');
		$fecha = substr(mysql_result($res, $idx,'fecha'),0,10);
		list($year, $month, $day)=explode("-",$fecha);
		$fecha = $day."-".$month."-".$year;
		$activo = mysql_result($res, $idx,'activo');
		$tamanio = mysql_result($res, $idx,'tamanio');;
		
		//$fecha_str = substr($fecha_actualizacion,6,2).'/'.substr($fecha_actualizacion,4,2).'/'.substr($fecha_actualizacion,0,4);
		$publicado_str = ($activo=='S') ? "Si" : "No";
		
?>
		<tr height="25">
		    <td class="txt_abm">&nbsp;</td>
			<td nowrap>
		    	<img src="img/edit_icon.gif" style="cursor:hand" onclick="javascript:location='<?=$here?>?accion=MOD&id=<?=$id?>'" alt="Editar">
		    </td>
		   <td class="txt_abm">&nbsp;&nbsp;&nbsp;&nbsp;</td>

		    <td class="txt_abm" width="40%">
		    	<?=$dir?>
		    </td>
		    <td class="txt_abm">&nbsp;&nbsp;</td>
		    <td class="txt_abm" width="40%">
		    	<?=stripslashes($nombre)?>
		    </td>
		     <td class="txt_abm">&nbsp;&nbsp;</td>
		    <td class="txt_abm" width="10%">
		    	<?=stripslashes($fecha)?>
		    </td>
		     <td class="txt_abm">&nbsp;&nbsp;&nbsp;</td>
		    <td class="txt_abm"  width="10%">
		    	<?=$tamanio?>
		    </td>
		     <td class="txt_abm">&nbsp;&nbsp;&nbsp;</td>
		    <td class="txt_abm" align="center">
		    	<?if ($activo == 'S') {?>S&iacute;<?}else{?>No<?}?>
		    </td>
		    <td class="txt_abm" align="center">
		    	&nbsp;&nbsp;
		    	<?if ($activo == 'S') {?>
		    		<input type="button" class="boton" name="pub1" value="No Publicar" onclick="location='<?=$here?>?accion=PUBLICADONO&id=<?=$id?>'" style="height:17px">
		    	<?}else{?>
		    		<input type="button" class="boton" name="pub2" value="Publicar"  onclick="location='<?=$here?>?accion=PUBLICADOSI&id=<?=$id?>'" style="height:17px">
		    	<?}?>
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
		var conf = confirm("�Est� seguro que desea eliminar el archivo y todo su contenido ?");
		if (conf)	{
			window.location="<?=$here?>?accion=BAJA&id="+id;
		}
	}
</script>

<br>
<br>
<p align=center>
	<input type="button" name="boton" value="Nuevo archivo" onclick="location='<?=$here?>?accion=ALTA';" style="width:150px"/>
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


