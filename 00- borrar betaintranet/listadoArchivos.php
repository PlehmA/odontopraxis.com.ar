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
<title>Listado Archivos</title>
<link rel="stylesheet" href="styles.css" type="text/css">
<link rel="stylesheet" href="contenido.css" type="text/css">
<link rel="stylesheet" href="css/jquery.dataTables.css" type="text/css">

<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/jquery.dataTables.js"></script>
<script src="js/jquery.fileDownload.js"></script>
</head>
<body bgcolor="#738fbb" text="#000000" topmargin="0" leftmargin="0">
<table class="contenedor" width="1000" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr> 
    <td> 
      <?php include"header.php"?>
      <?php include"checks.php"?>
    </td>
  </tr>
  <tr> 
    <td> 
      <!--<div align="center">
        <?php include"flash.php"?>
      </div>-->
    </td>
  </tr>
  <!--<tr> 
    <td> 
      <?php include"menu_ac.php"?>
    </td>
  </tr>-->
  <tr> 
    <td> 
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr> 
          <td width="130" valign="top"> 
            <?php include"lat_izq.php"?>
          </td>
          <td width="1" valign="top" bgcolor="9298AB"><img src="pixel.gif"></td>
          <td>
           <table class="agendausuariostab" width="600" border="0" cellspacing="0" cellpadding="0" align="center">

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
		    <td><a class="fileDownloadCustomRichExperience"  href="downloadArchivo.php?id=<?=$id?>" > <img src="download-icon.png"></a></td>
		</tr>
		
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
            <div align="right">
              <?php include"col-der2.php"?>
            </div>
          </td>
          
</table>
<script language="Javascript">

	$(document).ready(function(){
	    var oTable = $('#tablaArchivos').dataTable();
	});

	
</script>
<br>
<p align=center>
	<input type="button" name="boton2" value="Volver a carpetas" onclick="location='listadoCarpetas.php';" style="width:150px"/>
</p>
          </td>
          
        </tr>
         <tr>
    <td>
      <?php include"pie.php"?>
    </td>
  </tr>
      </table>
    </td>
  </tr>
 

</table>
</body>
</html>
