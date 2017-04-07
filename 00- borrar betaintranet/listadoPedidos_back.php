<?
include ('lib.php');
include ('checks.php');
//print "jerarquia :".$_SESSION['jerarquia'];

if ($_SESSION['jerarquia'] != 1 && $_SESSION['jerarquia'] != 2)	{
	header("location: ".MAIN_PAGE);
	return;
}

$RED_FONT = "font-family: Arial, Helvetica, sans-serif; font-size: 11px; color: red";
$here="listadoPedidos.php";
$avalar=$here."?accion=AVALAR&id=";
$rechazar=$here."?accion=RECHAZAR&id=";
$revisar=$here."?accion=REVISAR&id=";
$listar=$here."?accion=LISTADO";


include ('conect.php');


$TABLA = DB_PREFIX . "pedido" ;

if (isset($_GET['accion'])) 	{
	$accion=$_GET['accion'];
}else{
	$accion='LISTADO';
}

if (($accion != 'LISTADO') && ($accion != 'REVISAR') && ($accion != 'RECHAZAR') && ($accion != 'AVALAR') )	{
	?><META HTTP-EQUIV="Refresh" CONTENT="0; URL=<?=MAIN_PAGE?>"><?
	return;
}
 

?>

<html>
<head>
<title>Pedidos</title>
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

<?

function update($id, $respuesta){
	$sqlCheck = "SELECT superior FROM pedido where id = $id ";
	//print $sqlUpdate;
	$res = mysql_query($sqlCheck);
	$total = mysql_num_rows($res);
	if( $total != 1)	{
		return;	
	}
	$superior = mysql_result($res,0,'superior');

	if($_SESSION['idUsuario'] == $superior){

		$sqlUpdate = "UPDATE pedido SET fecha_respuesta = now() , respuesta = $respuesta WHERE id = $id ";
		//print $sqlUpdate;
		mysql_query($sqlUpdate);
	}
	return;
}

function sendEmail($idPedido){

	$total = 0;

	/* u1: RRHH
	 * u2: Superior
	 * u3: Solicitante
	 * u4: Presidente
	 */
	$sql = "SELECT group_concat(u1.email) as eRrhh, u4.email as ePresi,  u3.email as eUsuario, ";
	$sql.= " p.mensaje, p.asunto, p.fecha_pedido, p.respuesta, u3.nombre as uNombre, u3.apellido as uApellido, ";
	$sql.= " s.nombre as sector, u2.nombre as sNombre, u2.apellido as sApellido FROM usuarios u1 ,usuarios u2, ";
	$sql.= " usuarios u4, usuarios u3 join sector s on s.id = u3.sector join pedido p on p.usuario = u3.id ";
	$sql.= " where u1.jerarquia = 4 and u4.jerarquia = 1 and u2.id = ".$_SESSION['idUsuario']." and p.id = $idPedido group by u1.jerarquia";

//	print $sql;
	$res = mysql_query($sql);
	if($res){
		$total = mysql_num_rows($res);
		if ($total == 1){
			$eRrhh = mysql_result($res,0,'eRrhh');
			$ePresi = mysql_result($res,0,'ePresi');
			$eUsuario = mysql_result($res,0,'eUsuario');
			$asunto = mysql_result($res,0,'asunto');
			$mensaje = mysql_result($res,0,'mensaje');
			$fecha = mysql_result($res,0,'fecha_pedido');
			$respuesta = mysql_result($res,0,'respuesta');
			$uNombre = mysql_result($res,0,'uNombre');
			$uApellido = mysql_result($res,0,'uApellido');
			$sector = mysql_result($res,0,'sector');
			$sNombre = mysql_result($res,0,'sNombre');
			$sApellido = mysql_result($res,0,'sApellido');
		}
	}
	mysql_free_result($res);

		
	if ($total != 1)
	{
		$sqlUpdate = "UPDATE pedido SET fecha_respuesta = null, respuesta = null WHERE id = $idPedido ";
		mysql_query($sqlUpdate);
		//return;
	}
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

	$headerMail = '<html><body>';
	$headerMail .= "<h1>PEDIDO ".$respuesta."</h1>";
	$headerMail .= '<table rules="all" style="border-color: #666;" cellpadding="10">';
	$titleMail = "<tr style='background: #eee;'><td>El d&iacute;a  ".$fecha." se realiz&oacute; la siguiente solicitud del sector ". $sector. "</td></tr>";
	$bodyMail .= "<tr><td><strong>Solicitante:</strong> </td><td>" .$uNombre.' '.$uApellido . "</td></tr>";
	$bodyMail .= "<tr><td><strong>Asunto:</strong> </td><td>" . $asunto . "</td></tr>";
	$bodyMail .= "<tr><td><strong>Pedido:</strong> </td><td>" . $mensaje . "</td></tr>";
	$bodyMail .= "<tr><td><strong>Receptor:</strong> </td><td>" . $sNombre.' '.$sApellido . "</td></tr>";
	$bodyMail .= "<tr><td><strong>Respuesta:</strong> </td><td>" . $respuesta . "</td></tr>";
	$bodyMail .= "</table>";
	$bodyMail .= '</body></html>';

	$to = $eRrhh.", ";
	if($_SESSION['jerarquia'] != 1){
		$to .= $ePresi;
	}
	mail($to,"Intranet Solicitud",$headerMail.$titleMail.$bodyMail, $headers);

	$titleMail = "<tr style='background: #eee;'><td>El d&iacute;a  ".$fecha." usted realiz&oacute; la siguiente solicitud del sector ". $sector. ".</td></tr>";
	mail($eUsuario,"Intranet Solicitud",$headerMail.$titleMail.$bodyMail, $headers);
		
	return;
}

if($accion== "AVALAR"){

	$id=$_GET['id'];
	update($id, '"AVALADO"');
	sendEmail($id);
	?><META HTTP-EQUIV="Refresh" CONTENT="0; URL=<?=$listar?>"><?
	return;
}

if($accion== "RECHAZAR"){

	$id=$_GET['id'];
	update($id, '"RECHAZADO"');
	sendEmail($id);
	?><META HTTP-EQUIV="Refresh" CONTENT="0; URL=<?=$listar?>"><?
	return;
}

if($accion== "REVISAR"){

	$id=$_GET['id'];
	
	$sql = "SELECT p.id, u.nombre, u.apellido, s.nombre as sector, p.asunto, p.mensaje, p.fecha_pedido ";
	$sql.= "FROM pedido p inner join usuarios u on p.usuario = u.id ";
	$sql.= "inner join sector s on p.sector = s.id where p.id = ".$id;
	//print $sql;
	$res = mysql_query($sql);
	$total = mysql_num_rows($res);
	if( $total != 1)	{
		?><META HTTP-EQUIV="Refresh" CONTENT="0; URL=<?=$listar?>"><?
		return;	
	}
	$fecha_pedido = mysql_result($res,0,'fecha_pedido');
	$nombre = mysql_result($res, 0,'nombre');
	$apellido = mysql_result($res, 0,'apellido');
	$asunto = mysql_result($res, 0,'asunto');
	$mensaje = mysql_result($res, 0,'mensaje');
	?>
	<table border="0" cellspacing="0" cellpadding="0" align="center">

		      <tr> 
		       <td valign="top" align="left" class="menu2_abm">Solicitante&nbsp;&nbsp;</td>
		        <td valign="top" align="left" class="menu2_abm"><b><?=$nombre." ".$apellido?><b></td>
		      </tr>
		      <tr><td height="10"></td></tr>
		   	  <tr> 
		        <td valign="middle" align="left" class="menu2_abm">Asunto&nbsp;&nbsp;</td>
		        <td valign="top" align="left" class="menu2_abm"><b><?=$asunto?><b></td>     
		      </tr>
		      <tr><td height="5"></td></tr>
		      <tr> 
		        <td valign="middle" align="left" class="menu2_abm">Mensaje&nbsp;&nbsp;</td>
		        <td valign="top" align="left" class="menu2_abm"><b><?=$mensaje?><b></td>
		      </tr>
		         <tr><td height="10"></td></tr> <tr><td height="10"></td></tr> <tr><td height="10"></td></tr>
		 		<tr> 
		        <td valign="button" class="menu2_abm">
				<input type="button" name="boton" value="Rechazar" onclick="location='<?=$rechazar.$id?>';" style="width:100px"/>
				&nbsp;&nbsp;&nbsp;
				<input type="button" name="boton2" value="Avalar" onclick="location='<?=$avalar.$id?>';" style="width:100px"/>

			     </td>
		      </tr>
		       <tr><td height="50"></td></tr>
		      <tr> 
		        <td valign="button" class="menu2_abm">
				<input type="button" name="boton" value="Cancelar" onclick="location='home.php';" style="width:100px"/>
				</td>
		      </tr>
		      <tr><td height="10"></td></tr>
			  <tr bgcolor="#BCCCCC"><td colspan="3"></td></tr>
		   
		   </table>
	
	<?
	
}

if($accion == "LISTADO"){
?>
           <table class="pedidostab" id="pedidostab" width="600" border="0" cellspacing="0" cellpadding="0" align="center">
           <thead>
		<tr bgcolor="#BCCCCC" height="25px">
		 <td>Nombre</td>
	    <td>Apellido</td>
	    <td>Asunto</td>
	    <td>Fecha</td>
	    <td>Ver Pedido</td>
		</tr>

		</thead>
		<tbody>		

<?
	
	$sql = "SELECT p.id, u.nombre, u.apellido, s.nombre as sector, p.asunto, p.mensaje, p.fecha_pedido, p.respuesta ";
	$sql.= "FROM pedido p inner join usuarios u on p.usuario = u.id ";
	$sql.= "inner join sector s on p.sector = s.id where p.superior =".$_SESSION['idUsuario'];
	$sql.=" order by p.fecha_pedido desc";

	$res = mysql_query($sql);
	$total = mysql_num_rows($res);

	$idx = 0;
	while ($idx < $total)	{
	
	$id = mysql_result($res, $idx,'id');
	$fecha_pedido = mysql_result($res, $idx,'fecha_pedido');
	$nombre = mysql_result($res, $idx,'nombre');
	$apellido = mysql_result($res, $idx,'apellido');
	$asunto = mysql_result($res, $idx,'asunto');
	$respuesta = mysql_result($res, $idx,'respuesta');
?>
		<tr height="25">
		   
		    
		    
		    
		    <td>
		    	<?=$nombre?>
		    </td>
		    <td>
		    	<?=$apellido?>
		    </td>
		    <td>
		    	<?=$asunto?>
		   </td>
		    <td>
		    	<?=$fecha_pedido?>
		   </td>
		    <td>
		    	<? if($respuesta == null){?>
		    	<a href="<?=$revisar.$id?>"><img style="width:25px" src="img/edit_icon.gif"></a>
		    	<?
		    	}else{
		    		print $respuesta;
		    	}?>
		    </td>

		 	</tr>
		
<?
		$idx++;
	}
	mysql_free_result($res);
?>
	</tbody>
	</table>

<?
}
?>

</div>
</td>
<script language="Javascript">
	$(document).ready(function(){
	    var oTable = $('#pedidostab').dataTable();
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
