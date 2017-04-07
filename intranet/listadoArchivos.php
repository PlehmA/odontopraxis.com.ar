
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
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Listado Archivos</title>
<link rel="stylesheet" href="styles.css" type="text/css">
<link rel="stylesheet" href="contenido.css" type="text/css">
<link rel="stylesheet" href="css/jquery.dataTables.css" type="text/css">

<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/jquery.dataTables.js"></script>
<script src="js/jquery.fileDownload.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1257" />
</head>


<html>
<head>

<style type="text/css">
a:link {
	color: #036;
}
a:visited {
	color: #036;
}
a:hover {
	color: #036;
}
a:active {
	color: #036;
}
</style>
    </head>


<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="styles.css" type="text/css">
<link rel="stylesheet" href="css-d/contenido.css" type="text/css">
<link rel="stylesheet" href="css/jquery.dataTables.css" type="text/css">

<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/jquery.dataTables.js"></script>
</head>

//

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="styles.css" type="text/css">
<link rel="stylesheet" href="css-d/contenido.css" type="text/css">
<link rel="stylesheet" href="css/jquery.dataTables.css" type="text/css">

<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/jquery.dataTables.js"></script>
</head>

<span class="header-logo"><img src="img-d/logo.png" width="316" height="100" /></span>
<div class="header-logo" id="header-logo"></div>
  
<div class="header-placa" id="header-placa">
  <img src="img-d/banners2.jpg" width="601" height="100" />
</div>
<br>
<br>
<div class="titulo-sector-autogestion" id="titulo-sector-autogestion">INTRANET ODONTOPRAXIS
</div>
<div class="wrap2" id="wrap2">

<div class="col-iz2" id="col-iz2">
<div class="menu-iz2" id="menu-iz2">
    
<?php include"col-der.php"?>
<?php include"lat_izq.php"?>

</div>
</div>

<div class="contenedor-centro" id="contenedor-centro"> <!--contenedor-->


<td width="130" valign="top">          
<td valign="top" bgcolor="#FFFFFF">&nbsp;</td>
          <td width="1" valign="top" bgcolor="#D5EAFF">&nbsp;</td>
          
           <table class="agendausuariostab" width="600" border="0" cellspacing="0" cellpadding="0" align="left">

<div class="full_width">
           <table class="agendausuariostab" id="agendausuariostab" width="750" border="0" cellspacing="0" cellpadding="0" align="right" >
           <thead>
		<tr bgcolor="#75BAFF" height="25px">

	   <td>Carpeta</td>
	    <td>Nombre</td>
	    <td>Fecha</td>
	    <td>Descargar</td>
	 </tr>
</thead>
<tbody>


<?
	$sql = "SELECT * FROM $TABLA ";
	if ($id != null ){
		$sql.= " where id_carpeta = ".$id ." and activo = 'S'";
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
		    <td><a class="fileDownloadCustomRichExperience"  href="downloadArchivo.php?id=<?=$id?>" > <img src="download-icon.png"></a></td>
</tr>
        
                <script language="Javascript">
	$(document).ready(function(){
	    var oTable = $('#agendausuariostab').dataTable();
	});
</script>
		
<?
		$idx++;
	}
	mysql_free_result($res);
?>
</tbody>


</table>


</div>
<td width="1" bgcolor="9298AB"><img src="pixel.gif"></td>
          <td valign="top" width="215"> 
            <div align="center">

            </div>
          </td>
       
</table>



<br>
<br>
<br>
</div>
<p align=center>
	<input type="button" name="boton2" value="Volver a carpetas" onclick="location='listadoCarpetas.php';" style="width:150px"/>
</p>
        
          

 

</table>
</body>
</html>
