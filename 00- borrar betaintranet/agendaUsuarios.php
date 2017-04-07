<?
include ('lib.php');
include ('checks.php');


$MAX_NEWS = 2;
$RED_FONT = "font-family: Arial, Helvetica, sans-serif; font-size: 11px; color: red";


include ('conect.php');


$TABLA = DB_PREFIX . "usuarios" ;

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
<head>
<title>Agenda de Usuarios</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="styles.css" type="text/css">
<link rel="stylesheet" href="contenido.css" type="text/css">
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
  <tr> 
    <td> 
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr> 
          <td width="130" valign="top"> 
            <?php include"lat_izq.php"?>
          </td>
          <td width="1" valign="top" bgcolor="9298AB"><img src="pixel.gif"></td>
           <td>
		<div class="full_width">
           <table class="agendausuariostab" id="agendausuariostab" width="600" border="0" cellspacing="0" cellpadding="0" align="center">
           <thead>
		<tr bgcolor="#BCCCCC" height="25px">
		 <td>Nombre</td>
	    <td>Apellido</td>
	    <td>Sector</td>
	    <td>Edificio</td>
	    <td>Tel</td>
	    <td>Int</td>
	    <td>Email</td>
		</tr>

		</thead>
		<tbody>		

<?
	
	$sql = "SELECT * FROM $TABLA ";

	$res = mysql_query($sql);
	$total = mysql_num_rows($res);

	$idx = 0;
	while ($idx < $total)	{
	
	$id = mysql_result($res, $idx,'id');
	$clave = mysql_result($res, $idx,'clave');
	$adm = mysql_result($res, $idx,'adm');
	$activo = mysql_result($res, $idx,'activo');
	$nro_doc = mysql_result($res, $idx,'nro_doc');
	$email = mysql_result($res, $idx,'email');
	$edificio = mysql_result($res, $idx,'edificio');
	$edificio = getEdificio($edificio);
	$sector = mysql_result($res, $idx,'sector');
	$sector = getSector($sector);
	$nombre = mysql_result($res, $idx,'nombre');
	$apellido = mysql_result($res, $idx,'apellido');
	$fecha_reg = mysql_result($res, $idx,'fecha_reg');
	$tel = mysql_result($res, $idx,'tel');
	$interno = mysql_result($res, $idx,'interno');	
?>
		<tr height="25">
		   
		    
		    
		    
		    <td>
		    	<?=$nombre?>
		    </td>
		    <td>
		    	<?=$apellido?>
		    </td>
		    <td>
		    	<?=stripslashes($sector)?>
		    </td>
		    <td>
		    	<?=stripslashes($edificio)?>
		   </td>
		    <td>
		    	<?=stripslashes($tel)?>
		   </td>
		    <td>
		    	<?=stripslashes($interno)?>
		   </td>
		    <td>
		     	<a href="mailto:<?=$email?>"><img style="width:25px" src="mailicon.jpeg"></a>
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
</td>
<script language="Javascript">
	$(document).ready(function(){
	    var oTable = $('#agendausuariostab').dataTable();
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
