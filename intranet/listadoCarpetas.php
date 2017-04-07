<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        
<link href="css-d/style2.css" rel="stylesheet" type="text/css" media="all" />

<?
include ('lib.php');
include ('checks.php');

$here = "listadoCarpetas.php";
$RED_FONT = "font-family: Arial, Helvetica, sans-serif; font-size: 11px; color: red";

include ('conect.php');


?>

<?



$MAX_NEWS = 2;
$RED_FONT = "font-family: Arial, Helvetica, sans-serif; font-size: 11px; color: red";


$TABLA = DB_PREFIX . "sector" ;

function getSector($id){
	$sql = "SELECT nombre AS nombre FROM sector WHERE id = $id";
	//print $sql."</br>";
	$sector = null;
	$res = mysql_query($sql);
	if ($res){
		$sector = mysql_result($res,0,'nombre');
		mysql_free_result($res);
	}
	return $sector;
}

function getEdificio($id){
	$sql = "SELECT nombre AS nombre FROM edificio WHERE id = $id";
	//print $sql."</br>";
	$edificio = null;
	$res = mysql_query($sql);
	if ($res){
		$edificio = mysql_result($res,0,'nombre');
		mysql_free_result($res);
	}
	return $edificio;
}

?>

<html>
<script src="SpryAssets/SpryValidationCheckbox.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationCheckbox.css" rel="stylesheet" type="text/css" />
<head>

<title>Listado de Carpetas</title>
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
    
<title>Listado de Carpetas</title>
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

  <?php include"checks.php"?>
<tr> 
  <td> 
<tr> 
    <td> 



<br>
       


    <td width="130" valign="top">          
<td valign="top" bgcolor="#FFFFFF">&nbsp;</td>
          <td width="1" valign="top" bgcolor="#D5EAFF">&nbsp;</td>
          
<div class="full_width">
           <table class="agendausuariostab" id="agendausuariostab" width="750" border="0" cellspacing="0" cellpadding="0" align="center">
           <thead>
		<tr bgcolor="#75BAFF" height="25px">
	    <td>Carpeta<span id="sprycheckbox1"><span class="checkboxRequiredMsg"> </span></span></td>
	     <td>Fecha Actualización</td>
</tr>
	</thead>
	<tbody>
	

<?

	
	$sql = "SELECT c.id as id , c.nombre as nombre, c.fecha_actualizacion as fecha, sum(a.tamanio) as tamanio ".
			"FROM carpetas c join archivos a on a.id_carpeta = c.id where c.activo ='S' and a.activo = 'S' group by c.id ";
	//	print $sql;
//	$sql.= " ORDER BY fecha, id";

	$res = mysql_query($sql);
	$total = mysql_num_rows($res);

	$idx = 0;
	while ($idx < $total)	{

		$id = mysql_result($res, $idx,'id');
		$nombre = mysql_result($res, $idx,'nombre');
		$fecha = substr(mysql_result($res, $idx,'fecha'),0,10);
		list($year, $month, $day)=explode("-",$fecha);
		$fecha = $day."-".$month."-".$year;
		$tamanio = mysql_result($res, $idx,'tamanio');
		
?>
		<tr>
		   <td><img src="folder-icon.png" width="23" height="19"/>
		    	<a href="listadoArchivos.php?id=<?=$id?>">
		    		<?=stripslashes($nombre)?>
		    	</a>
	      </td>
		    <td colspan="2" >
		    	<?=$fecha?>
		    </td>
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


          
          
</table>
<script language="Javascript">

	$(document).ready(function(){
	    var oTable = $('#tablaCarpetas').dataTable();
	});

	
</script>
<br>
<p align=center><br />
	<input type="button" name="boton2" value="Volver" onclick="location='<?=MAIN_PAGE?>';" style="width:150px"/>
</p>


<!--final contenedor--></div>
</body>
<script type="text/javascript">
var sprycheckbox1 = new Spry.Widget.ValidationCheckbox("sprycheckbox1");
</script>
</html>
