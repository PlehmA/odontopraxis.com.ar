<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        
<link href="css-d/style2.css" rel="stylesheet" type="text/css" media="all" />
<head>
<?



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

<title>Listado de Pedidos </title>
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


<body>
<div class="header-logo" id="header-logo">
  <img src="img-d/logo.png" width="316" height="100" /></div>
  
<div class="header-placa" id="header-placa">
  <img src="img-d/banners2.jpg" width="601" height="100" />
</div>


<div class="titulo-sector-autogestion" id="titulo-sector-autogestion">INTRANET ODONTOPRAXIS
</div>


<div class="col-iz2" id="col-iz2">
<div class="menu-iz2" id="menu-iz2">
    
<?php include"col-der.php"?>
<?php include"lat_izq.php"?>

</div>
</div>


</div>
</div>

<div class="contenedor-centro" id="contenedor-centro"> <!--contenedor-->




<?
include ('lib.php');
include ('checks.php');
//print "jerarquia :".$_SESSION['jerarquia'];

if ($_SESSION['bandejaPedidos'] != "Y")	{
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

<title>Pedidos</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="styles.css" type="text/css">
<link rel="stylesheet" href="contenido.css" type="text/css">
<link rel="stylesheet" href="css/jquery.dataTables.css" type="text/css">

<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/jquery.dataTables.js"></script>






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
	$sql = "SELECT u3.sector , group_concat(u1.email) as eRrhh, u4.email as ePresi,  u3.email as eUsuario, ";
	$sql.= " p.mensaje, p.asunto, p.fecha_pedido, p.respuesta, u3.nombre as uNombre, u3.apellido as uApellido, ";
	$sql.= " s.nombre as sector, u2.nombre as sNombre, u2.apellido as sApellido, ";
	$sql.= " p.desde1, p.hasta1, p.desde2, p.hasta2 ";
	$sql.= " FROM usuarios u1 ,usuarios u2, ";
	$sql.= " usuarios u4, usuarios u3 join sector s on s.id = u3.sector join pedido p on p.usuario = u3.id ";
	$sql.= " where u1.jerarquia = 4 and u4.jerarquia = 1 and u2.id = ".$_SESSION['idUsuario']." and p.id = $idPedido group by u1.jerarquia";

	//print $sql;
	$res = mysql_query($sql);
	if($res){
	//	print "sql ";
		$total = mysql_num_rows($res);
		if ($total == 1){
			$eGte = "";
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
			$desde1 = mysql_result($res,0,'desde1');
			$hasta1 = mysql_result($res,0,'hasta1');
			$desde2 = mysql_result($res,0,'desde2');
			$hasta2 = mysql_result($res,0,'hasta2');
			$sector = mysql_result($res,0,'sector');
		}
	mysql_free_result($res);
	}
	
		
	if ($total != 1)
	{
		$sqlUpdate = "UPDATE pedido SET fecha_respuesta = null, respuesta = null WHERE id = $idPedido ";
		mysql_query($sqlUpdate);
		//return;
	}
	if ($_SESSION['jerarquia'] == 5){
		$sql = "select email from usuarios where sector = $sector and jerarquia = 6";
		$res = mysql_query($sql);
		if($res){
			$total = mysql_num_rows($res);
			if ($total == 1){
				$eGte = mysql_result($res,0,'email');
			}
		}
		mysql_free_result($res);	
	}

	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

	$headerMail = '<html><body>';
	$headerMail .= "<h1>PEDIDO ".$respuesta."</h1>";
	$headerMail .= '<table rules="all" style="border-color: #666;" cellpadding="10">';
	$titleMail = "<tr style='background: #eee;'><td>El d&iacute;a  ".$fecha." se realiz&oacute; la siguiente solicitud del sector ". $sector. "</td></tr>";
	$bodyMail .= "<tr><td><strong>Solicitante:</strong> </td><td>" .$uNombre.' '.$uApellido . "</td></tr>";
	$bodyMail .= "<tr><td><strong>Asunto:</strong> </td><td>" . $asunto . "</td></tr>";
	$bodyMail .= "<tr><td><strong>Horario Normal ingreso:</strong> </td><td>" . $desde1 . "</td></tr>";
	$bodyMail .= "<tr><td><strong>Horario Normal egreso:</strong> </td><td>" . $hasta1 . "</td></tr>";
	$bodyMail .= "<tr><td><strong>Horario solicitado:</strong> </td><td>" . $desde2 . "</td></tr>";
	$bodyMail .= "<tr><td><strong>Horario Solicitado egreso:</strong> </td><td>" . $hasta2 . "</td></tr>";
	$bodyMail .= "<tr><td><strong>Pedido:</strong> </td><td>" . $mensaje . "</td></tr>";
	$bodyMail .= "<tr><td><strong>Receptor:</strong> </td><td>" . $sNombre.' '.$sApellido . "</td></tr>";
	$bodyMail .= "<tr><td><strong>Respuesta:</strong> </td><td>" . $respuesta . "</td></tr>";
	$bodyMail .= "</table>";
	$bodyMail .= '</body></html>';

	$to = $eRrhh;
	if($_SESSION['jerarquia'] != 1){
		$to .= ", ".$ePresi;
	}
	if($_SESSION['jerarquia'] == 5){
		$to .= ", ".$eGte;
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
	
	$sql = "SELECT p.id, u.nombre, u.apellido, s.nombre as sector, p.asunto, p.mensaje, p.fecha_pedido,	 p.respuesta, ";
	$sql.= " p.desde1, p.hasta1, p.desde2, p.hasta2 ";
	$sql.= " FROM pedido p inner join usuarios u on p.usuario = u.id ";
	$sql.= " inner join sector s on p.sector = s.id where p.id = ".$id;
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
	$respuesta = mysql_result($res, 0,'respuesta');
	$desde1 = mysql_result($res, 0,'desde1');
	$hasta1 = mysql_result($res, 0,'hasta1');
	$desde2 = mysql_result($res, 0,'desde2');
	$hasta2 = mysql_result($res, 0,'hasta2');

	?>
<table border="0" align="left" cellpadding="0" cellspacing="0">
		      <tr> 
		       <td valign="top" align="left" class="menu2_abm">Solicitante&nbsp;&nbsp;</td>
		        <td valign="top" align="left" class="menu2_abm"><b><?=$nombre." ".$apellido?><b></td>
		      </tr>
		      <tr><td height="10"></td></tr>
		   	  <tr> 
		        <td valign="middle" align="left" class="menu2_abm">Asunto&nbsp;&nbsp;</td>
		        <td valign="top" align="left" class="menu2_abm"><b><?=$asunto?><b></td>     
		      </tr>
		      <tr> 
		        <td valign="middle" align="left" class="menu2_abm">Horario Normal ingreso:&nbsp;&nbsp;</td>
		        <td valign="top" align="left" class="menu2_abm"><b><?=$desde1?><b></td>     
		      </tr>
		      <tr> 
		        <td valign="middle" align="left" class="menu2_abm">Horario Normal egreso:&nbsp;&nbsp;</td>
		        <td valign="top" align="left" class="menu2_abm"><b><?=$hasta1?><b></td>     
		      </tr>
		      <tr> 
		        <td valign="middle" align="left" class="menu2_abm">Horario solicitado:&nbsp;&nbsp;</td>
		        <td valign="top" align="left" class="menu2_abm"><b><?=$desde2?><b></td>     
		      </tr>
		      <tr> 
		        <td valign="middle" align="left" class="menu2_abm">Horario Solicitado egreso:&nbsp;&nbsp;</td>
		        <td valign="top" align="left" class="menu2_abm"><b><?=$hasta2?><b></td>     
		      </tr>
		      <tr><td height="5"></td></tr>
		      <tr> 
		        <td valign="middle" align="left" class="menu2_abm">Mensaje&nbsp;&nbsp;</td>
		        <td valign="top" align="left" class="menu2_abm"><b><?=$mensaje?><b></td>
		      </tr>
		         <tr><td height="10"></td></tr> <tr><td height="10"></td></tr> <tr><td height="10"></td></tr>
		 		<tr> 
		        <td valign="button" class="menu2_abm">
			<?if($respuesta  == null ){?>

		 		<input type="button" name="boton" value="Rechazar" onClick="location='<?=$rechazar.$id?>';" style="width:100px"/>
				&nbsp;&nbsp;&nbsp;
				<input type="button" name="boton2" value="Avalar" onClick="location='<?=$avalar.$id?>';" style="width:100px"/>
 			
			<? } ?> 
			     </td>
		      </tr>
	    
		       <tr><td height="30"></td></tr>
		      <tr> 
		        <td valign="button" class="menu2_abm">
				<input type="button" name="boton" value="Volver" onClick="location='listadoPedidos.php';" style="width:100px"/>
				</td>
		      </tr>
		      <tr><td height="10"></td></tr>
			  <tr bgcolor="#BCCCCC"><td colspan="3"></td></tr>
		   
	      </table>
	
	<?
	
}

if($accion == "LISTADO"){
?>
 <div class="contenedor-centro" id="contenedor-centro"> <!--contenedor-->
 
 
           <table class="agendausuariostab" id="agendausuariostab" 
width="750" border="0" cellspacing="0" cellpadding="0" align="center">
           <thead>
		<tr bgcolor="#75BAFF" height="25px">
		 <td>Nombre</td>
	    <td>Apellido</td>
	    <td>Asunto</td>
	    <td>Fecha</td>
	    <td>Estado</td>
	    <td>Ver</td>
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
		   
		    
		    
		    
		    <td height="31">
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
		    	<? if($respuesta == null){
		    		print "Nuevo";
    		    	}else{
		    		print $respuesta;
		    	}?>
		    </td>
		    <td>
		    	<a href="<?=$revisar.$id?>"><img style="width:25px" src="img/edit_icon.gif"></a>
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


</td>
<script language="Javascript">
	$(document).ready(function(){
	    var oTable = $('#pedidostab').dataTable();
	});
</script>
<td width="35" bgcolor="9298AB">&nbsp;</td>
          <td valign="top" width="965">&nbsp;</td>


<!--final contenedor--></div>
</body>
</html>

