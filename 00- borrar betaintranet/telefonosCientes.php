<?
include ('lib.php');
include ('checks.php');


$MAX_NEWS = 2;
$accion = "LISTA";
$RED_FONT = "font-family: Arial, Helvetica, sans-serif; font-size: 11px; color: red";

if (isset($_GET['accion'])) 	{
	$accion=$_GET['accion'];
}


if (($accion != 'LISTA') )	{
	?><META HTTP-EQUIV="Refresh" CONTENT="0; URL=<?=MAIN_PAGE?>"><?
	return;
	}

include ('conect.php');


$TABLA = DB_PREFIX . "telefonos_clientes" ;


//////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////

if ($accion == "LISTA")	{



?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Teléfonos de Clientes</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="contenido.css" type="text/css">
<link rel="stylesheet" href="styles.css" type="text/css">
<link rel="stylesheet" href="css/jquery.dataTables.css" type="text/css">

 <script type="text/javascript" src="js/jquery.js"></script>
  <script type="text/javascript" src="js/jquery.dataTables.js"></script>
</head>
<body bgcolor="#FFFFFF" text="#000000" topmargin="0" leftmargin="0">
<table width="1000" class="contenedor" border="0" cellspacing="0" cellpadding="0" align="center">
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
           <table id="tablaTelefonos" border="0" cellspacing="0" cellpadding="0" align="center">
			<thead>
				  <tr bgcolor="#BCCCCC" height="25px"> 
				  	
				    <td>Nombre</td>
				     <td>Número de teléfono</td>
				     <td>Email</td>
				     
				 </tr>
			</thead>
			<tbody>
		
		<?
	
	$sql = "SELECT * FROM $TABLA WHERE activo ='S' ";

	$res = mysql_query($sql);
	$total = mysql_num_rows($res);

	$idx = 0;
	while ($idx < $total)	{
	
	$id = mysql_result($res, $idx,'id');
	$titulo = mysql_result($res, $idx,'titulo');
	$telefono = mysql_result($res, $idx,'telefono');
	$direccion = mysql_result($res, $idx,'direccion');
	$mail = mysql_result($res, $idx,'mail');
	$observacion = mysql_result($res, $idx,'observacion');
	$activo = mysql_result($res, $idx,'activo');
		
?>
		<tr>
		    <td>
		    	<font face="Arial, Helvetica, sans-serif" size="3"><?=$titulo?></font></bold>
		    	</br><?=stripslashes($direccion)?>
				</br><?=$observacion?>
		    </td>
		     <td><?=$telefono?></td>
 			<td><?=stripslashes($mail)?></td>
		</tr>
		
<?
		$idx++;
	}
	mysql_free_result($res);
?>
		
<?
		$idx++;
	}
	
?>
</tbody>
</table>
</div>
</td>
<script language="Javascript">
	
	$(document).ready(function(){
	    var oTable = $('#tablaTelefonos').dataTable();
	});

</script>
<br>
          </td>
          <td width="1" bgcolor="9298AB"><img src="pixel.gif"></td>
          <td valign="top" width="215"> 
            <div align="right">
              <?php include"col-der2.php"?>
            </div>
          </td>
        </tr>
      </table>
    </td>
  </tr>
  <tr>
    <td>
      <?php include"pie.php"?>
    </td>
  </tr>

</table>
</body>
</html>
