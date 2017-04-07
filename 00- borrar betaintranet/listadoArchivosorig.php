<?
include ('lib.php');
include ('checks.php');
include ('conect.php');

$here = "listadoArchivos.php";
$RED_FONT = "font-family: Arial, Helvetica, sans-serif; font-size: 11px; color: red";
$TABLA = DB_PREFIX . "archivos" ;
$id = null;
if (isset($_GET['id'])) 	{
	$id=$_GET['id'];
}
$target_path = CARPETAS_DIR;


//////////////////////////////////////////////////////////////////////////////////////////

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


/////////////////////////////////////////////////////////////////////////////////////////

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Listado de Archivos</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="styles.css" type="text/css">
<link rel="stylesheet" href="css/jquery.dataTables.css" type="text/css">

<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/jquery.dataTables.js"></script>
<script src="js/jquery.fileDownload.js"></script>

</head>

<body bgcolor="#EBEBEB" link="#153579" vlink="#153579" alink="#153579" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
  <? include ('header2.php');?>

<p align=center><b><font face="Arial, Helvetica, sans-serif" size="3">Listado de Archivos</b></p>

<p align=center>
	<input type="button" name="boton2" value="Men�" onclick="location='<?=MAIN_PAGE?>';" style="width:150px"/>
</p>

<div class="full_width">
<table id="tablaArchivos" border="0" cellspacing="0" cellpadding="0" align="center">
<thead>
	<tr bgcolor="#BCCCCC" height="25px">
	   <td>Carpeta</td>
	    <td>Nombre</td>
	    <td>Fecha</td>
	    <td>Tamaño en KB</td>
	    <td>Descargar</td>
	 </tr>
</thead>
<tbody>

<?
	
	$sql = "SELECT * FROM $TABLA ";
	if ($id != null){
		$sql.= " where id_carpeta = ".$id;
	}

	$res = mysql_query($sql);
	$total = mysql_num_rows($res);

	$idx = 0;
	while ($idx < $total)	{

		$id = mysql_result($res, $idx,'id');
		$nombre = mysql_result($res, $idx,'nombre');
		$carpeta = mysql_result($res, $idx,'id_carpeta');
		$dir = getDirectorio($carpeta);
		$fecha = substr(mysql_result($res, $idx,'fecha'),0,10);
		$activo = mysql_result($res, $idx,'activo');
		$tamanio = mysql_result($res, $idx,'tamanio');;
		$archivo = mysql_result($res, $idx,'archivo');;
		//$fecha_str = substr($fecha_actualizacion,6,2).'/'.substr($fecha_actualizacion,4,2).'/'.substr($fecha_actualizacion,0,4);
		$publicado_str = ($activo=='S') ? "Si" : "No";
		$path = $target_path.$archivo;
		
?>
		<tr>
		   <td><?=$dir?></td>
		    <td><?=stripslashes($nombre)?></td>
		    <td><?=stripslashes($fecha)?></td>
		    <td><?=$tamanio?></td>
		    <td><a class="fileDownloadCustomRichExperience"  href="downloadArchivo.php?id=<?=$id?>" > <?=$archivo?> </a></td>
		</tr>
		
<?
		$idx++;
	}
	mysql_free_result($res);
?>
</tbody>
</table>
</div>

<script language="Javascript">

	$(document).ready(function(){
	    var oTable = $('#tablaArchivos').dataTable();
	});

	
</script>

<br>
<br>
<p align=center>
	<input type="button" name="boton2" value="Men�" onclick="location='<?=MAIN_PAGE?>';" style="width:150px"/>
</p>
<br>
</body>
</html>



