<?
include ('lib.php');
include ('checks.php');

$here = "listadoCarpetas.php";
$RED_FONT = "font-family: Arial, Helvetica, sans-serif; font-size: 11px; color: red";

include ('conect.php');


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Listado Carpetas</title>
<link rel="stylesheet" href="contenido.css" type="text/css">
<link rel="stylesheet" href="styles.css" type="text/css">
<link rel="stylesheet" href="css/jquery.dataTables.css" type="text/css">

 <script type="text/javascript" src="js/jquery.js"></script>
  <script type="text/javascript" src="js/jquery.dataTables.js"></script>
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
<table id="tablaCarpetas" border="0" cellspacing="0" cellpadding="0" align="center">
	<thead>
	  <tr bgcolor="#BCCCCC" height="25px"> 
	  	
	    <th>Carpeta</th>
	     <th>Fecha de Actualización</th>
	     <th>Tamaño Total en KB</th>
	     
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
		   <td><img src="folder-icon.png"/>
		    	<a href="listadoArchivos.php?id=<?=$id?>">
		    		<?=stripslashes($nombre)?>
		    	</a>
		    </td>
		    <td >
		    	<?=$fecha?>
		    </td>
		   <td>
		    	<?=$tamanio?>
		    </td>
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
	    var oTable = $('#tablaCarpetas').dataTable();
	});

	
</script>
<br>
<p align=center>
	<input type="button" name="boton2" value="Volver" onclick="location='<?=MAIN_PAGE?>';" style="width:150px"/>
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
