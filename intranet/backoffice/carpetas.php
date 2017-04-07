<?
include ('lib.inc');
include ('checks.inc');

$here = "carpetas.php";
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


$TABLA = DB_PREFIX . "carpetas" ;


//////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////


?>
<?

///////////////////////////////////////////////
// Alta de registro
if ($accion == 'ALTA_UPD')	{

	$fecha=date("Y-m-d", time());  
//	$directorio = addSlashes($_POST['directorio']);
	$nombre = addSlashes($_POST['nombre']);
	$activo = 'N';

	$imagen = "";
	$archivo = "";
	$url = $here;

	$sql = "SELECT COUNT(*) AS cant FROM $TABLA WHERE LOWER(nombre) = LOWER('$nombre') ";//or LOWER(directorio) = LOWER('$directorio')";
	$res = mysql_query($sql);
	$cant = mysql_result($res,0,'cant');
	mysql_free_result($res);

	if ($cant > 0 )//or file_exists(CARPETAS_DIR.OS_FILE_SEPARATOR.$directorio))	// la carpeta ya existe
	{
		$url = $here."?accion=ALTA&error=1";
		
	}else{
	
			//mkdir(CARPETAS_DIR.OS_FILE_SEPARATOR.$directorio, 0777, true);
		   
			
			$sql = "SELECT MAX(id)+1 AS indexId FROM $TABLA";
			$res = mysql_query($sql);
			$indexId = mysql_result($res,0,'indexId');
			mysql_free_result($res);
			
			//////////////////////////////////////////////////////////
			//////////////////////////////////////////////////////////
			
			$sql = "INSERT INTO $TABLA (id, nombre, activo, fecha_actualizacion) ";
			$sql.= 			"VALUES ($indexId, '$nombre', '$activo', '$fecha' )";
			print $sql;
			$resp = mysql_query($sql);
		/* if (!$resp){
		 	$url = $here."?accion=ALTA&error=2";
		 	rmdir(CARPETAS_DIR.OS_FILE_SEPARATOR.$directorio);
		 }*/
	}	

	
	?>
	<META HTTP-EQUIV="Refresh" CONTENT="0; URL=<?=$url?>">
<?
	return;
}

///////////////////////////////////////////////
// Actualización de registro
if ($accion == 'MOD_UPD')	{

	$id=$_GET['id'];
	$url = $here;

	$fecha=$fecha=date("Y-m-d", time()); 
	$nombre = addSlashes($_POST['nombre']);
//	$directorio = addSlashes($_POST['diretorio']);

	$sql = "SELECT COUNT(*) AS cant FROM $TABLA WHERE LOWER(nombre) = LOWER('$nombre') ";//or LOWER(directorio) = LOWER('$directorio')";
	$res = mysql_query($sql);
	$cant = mysql_result($res,0,'cant');
	mysql_free_result($res);

	if ($cant > 0 )//or file_exists(CARPETAS_DIR.OS_FILE_SEPARATOR.$directorio))	// la carpeta ya existe
	{
		$url = $here."?accion=MOD&error=1";
		
	}else{
	

	//	mkdir(CARPETAS_DIR.OS_FILE_SEPARATOR.$directorio, 0777, true);
    	//////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////

		$sql = "UPDATE $TABLA SET fecha_actualizacion='$fecha', ";
		$sql.=			" nombre='$nombre'";
		$sql.= " 		WHERE id='$id'";
	//	print "sql: $sql<br>";
		$resp = mysql_query($sql);
		/* if (!$resp){
		 	$url = $here."?accion=MOD&error=2";
		 	rmdir(CARPETAS_DIR.OS_FILE_SEPARATOR.$directorio);
		 }*/
	}	

		?>
<META HTTP-EQUIV="Refresh" CONTENT="0; URL=<?=$url?>">
<?
	return;
	
}


///////////////////////////////////////////////
// Baja de registro
if ($accion == 'BAJA')	{
	$id=$_GET['id'];

	$sql = "UPDATE $TABLA SET activo='N' WHERE id='$id'";
	mysql_query($sql);

	?>
<META HTTP-EQUIV="Refresh" CONTENT="0; URL=<?=$here?>">
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
// Actualización de registro
if (($accion == 'MOD') || ($accion == 'ALTA'))	{
	
	$id="";
	$targetAction="ALTA_UPD";
	$page_title = "Alta de Carpeta";

	
	$nombre = "";
	//$directorio = "";
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
		$page_title = "Edición de Carpeta";
		$backpage = $here;


		$nombre = mysql_result($res,0,'nombre');
	//	$directorio = mysql_result($res,0,'directorio');
		
		mysql_free_result($res);
	}

	$err = $_GET['error'];
	if($err == 1){
		$error="El archivo ya existe";
	}else if($err == 2){
		$error="Hubo un error, por favor intente nuevamente";
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
    <input type="hidden" name="activo" value="">
    <td valign="top">&nbsp; </td>
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
	/*	if (form.elements['directorio'].value == "")	{
			form.elements['directorio'].focus();
			alert("Debe ingresar el directorio donde se alojarán los archivos.");
			return false;
		}*/
	
		form.submit();
		return true;
	}
	
	// sólo en el caso de caracteres nombre
	document.forms['data'].elements['nombre'].value = "<?=$nombre?>";
	//document.forms['data'].elements['directorio'].value = "<?=$directorio?>";
	
	

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
<title>Listado de carpetas</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="styles.css" type="text/css">
</head>

<body bgcolor="#EBEBEB" link="#153579" vlink="#153579" alink="#153579" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
  <? include ('header.php');?>

<p align=center><b><font face="Arial, Helvetica, sans-serif" size="3">Listado de carpetas</b></p>

<p align=center>
	<input type="button" name="boton" value="Nueva carpeta" onclick="location='<?=$here?>?accion=ALTA';" style="width:150px"/>
	&nbsp;&nbsp;&nbsp;
	<input type="button" name="boton2" value="Menú" onclick="location='<?=MAIN_PAGE?>';" style="width:150px"/>
</p>


<table width="80%" border="0" cellspacing="0" cellpadding="0" align="center">

	  <tr bgcolor="#BCCCCC" height="25px"> 
	  	
	    <td>&nbsp;&nbsp;&nbsp;</td> <td>&nbsp;&nbsp;&nbsp;</td>
	    <td class="txt2_abm" nowrap colspan="2" align="center">Nombre</td>
	  <!--  <td>&nbsp;&nbsp;&nbsp;</td>
	    <td class="txt2_abm" nowrap align="center">Directorio</td>
	    <td>&nbsp;&nbsp;&nbsp;</td>-->
	    <td class="txt2_abm" nowrap align="center">Fecha Actualización</td>
	     <td>&nbsp;&nbsp;&nbsp;</td>
	   <!-- <td class="txt2_abm" nowrap align="center">Tamaño total</td>
	    <td>&nbsp;</td>-->
	     <td class="txt2_abm" nowrap align="center">Visible</td>
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
		//$directorio = mysql_result($res, $idx,'directorio');
		$fecha_actualizacion = substr(mysql_result($res, $idx,'fecha_actualizacion'),0,10);
		list($year, $month, $day)=explode("-",$fecha_actualizacion);
		$fecha_actualizacion = $day."-".$month."-".$year;
		$activo = mysql_result($res, $idx,'activo');
		//$tamanio = 0;
		
		//$fecha_str = substr($fecha_actualizacion,6,2).'/'.substr($fecha_actualizacion,4,2).'/'.substr($fecha_actualizacion,0,4);
		$publicado_str = ($activo=='S') ? "Si" : "No";
		
?>
		<tr height="25">
		    <td class="txt_abm">&nbsp;</td>
			<td nowrap>
		    	<img src="img/edit_icon.gif" style="cursor:hand" onclick="javascript:location='<?=$here?>?accion=MOD&id=<?=$id?>'" alt="Editar">
		    </td>
		   <!--- <td nowrap>
		    	<img src="img/delete_icon.gif" style="cursor:hand" alt="Borrar" class="menu_abm" onclick="javascript:borrar('<?=$id?>')">
		    	&nbsp;
		    </td>-->
		   
		    <td class="txt_abm">&nbsp;&nbsp;</td>
		    <td class="txt_abm" width="30%">
		    	<?=stripslashes($nombre)?>
		    </td>
		<!--     <td class="txt_abm">&nbsp;&nbsp;</td>
		    <td class="txt_abm" width="30%">
		    	<?=stripslashes($directorio)?>
		    </td>-->
		     <td class="txt_abm">&nbsp;&nbsp;&nbsp;</td>
		    <td class="txt_abm" nowrap>
		    	<?=$fecha_actualizacion?>
		    </td>
		     <td class="txt_abm">&nbsp;&nbsp;&nbsp;</td>
		 <!--   <td class="txt_abm" nowrap>
		    	<?=$tamanio?>
		    </td>
		    <td class="txt_abm">&nbsp;&nbsp;</td>
		-->
		    <td class="txt_abm" align="center">
		    	<?if ($activo == 'S') {?>Sí<?}else{?>No<?}?>
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
		var conf = confirm("¿Está seguro que desea eliminar la carpeta?");
		if (conf)	{
			window.location="<?=$here?>?accion=BAJA&id="+id;
		}
	}
</script>

<br>
<br>
<p align=center>
	<input type="button" name="boton" value="Nueva Carpeta" onclick="location='<?=$here?>?accion=ALTA';" style="width:150px"/>
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


