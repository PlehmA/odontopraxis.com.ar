<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        
<link href="css-d/style2.css" rel="stylesheet" type="text/css" media="all" />

<?
include ('lib.php');
include ('checks.php');




$MAX_NEWS = 2;
$RED_FONT = "font-family: Arial, Helvetica, sans-serif; font-size: 11px; color: red";


include ('conect.php');


$TABLA = DB_PREFIX . "pedido" ;

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

<title>Documento sin t&iacute;tulo</title>
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
.font {
	font-family: Verdana, Geneva, sans-serif;
	font-size: 11px;
}
</style>
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


<div class="contenedor-centro" id="contenedor-centro"> <!--contenedor-->



<?

if ($_SESSION['hacerPedidos'] != "Y")	{
		header("location: ".MAIN_PAGE);
		return;
}


$RED_FONT = "font-family: Arial, Helvetica, sans-serif; font-size: 11px; color: red";
$here = "pedido.php";
$backpage = $here."?accion=ERROR";
$RESP0 = "Se ha enviado el pedido con éxito";
$RESP1 = "Ha ocurrido un error con la configuracion del usuario";
$RESP2 = "Ha ocurrido un error con la configuracion del jefe de sector";
$RESP3 = "Ha ocurrido un error con la configuracion del jefe de sector, hay mas de uno";
$RESP4 = "Error en el envio, intentelo nuevamente";


if (isset($_GET['accion'])) 	{
	$accion=$_GET['accion'];
}else{
	$accion='ALTA';
}

if (isset($_GET['resp'])) 	{
	$resp=$_GET['resp'];
}else{
	$resp = "";
}

if (($accion != 'ALTA') && ($accion != 'ENVIO') && ($accion != 'ERROR'))	{
	?><META HTTP-EQUIV="Refresh" CONTENT="0; URL=<?=MAIN_PAGE?>"><?
	return;
}
 


$TABLA = DB_PREFIX . "pedido" ;


	$resSector = mysql_query('SELECT id,nombre FROM sector');
	$totalSector = mysql_num_rows($resSector);
	$idxSector = 0;
               

	$resEdificio = mysql_query('SELECT id,nombre FROM edificio');
	$totalEdificio= mysql_num_rows($resEdificio);
	$idxEdificio = 0; 

///////////////////////////////////////////////
// Actualizaci?n de registro
if ($accion == 'ENVIO')	{

	$resp = 0;
	$id=$_SESSION['idUsuario'];

	$asunto = addSlashes($_POST['asunto']);
	$mensaje = addSlashes($_POST['mensaje']);
	$superior = addSlashes($_POST['superior']);
	$sector = addSlashes($_POST['sector']);
	$desde1 = addSlashes($_POST['desde1']);
	$hasta1 = addSlashes($_POST['hasta1']);
	$desde2 = addSlashes($_POST['desde2']);
	$hasta2 = addSlashes($_POST['hasta2']);


	//////////////////////////////////////////////////////////

	$sql = "INSERT INTO $TABLA SET ";
	$sql.= " usuario='$id', superior='$superior', sector='$sector',";
	$sql.= " asunto='$asunto', mensaje='$mensaje',";
	$sql.= " fecha_pedido = now() , desde1 = '$desde1' , ";
	$sql.= " hasta1 = '$hasta1' , desde2 = '$desde2' , hasta2 = '$hasta2' ";

	//print $sql;
	$resultado = mysql_query($sql);

	if (!$resultado){
			$resp= 4;
	}else{
		$resp = 0;
	}

	?><META HTTP-EQUIV="Refresh" CONTENT="0; URL=<?=$backpage?>&resp=<?=$resp?>"><?
			return;	
}else{

if ($accion == 'ERROR'){
	if ($resp != ""){
	 	switch ($resp) {
	    case 0:
	        $exito = $RESP0;
	        break;
	    case 1:
	        $error = $RESP1;
	        break;
	    case 2:
	        $error = $RESP2;
	        break;
	    case 3:
	        $error = $RESP3;
	        break;
	    case 4:
	        $error = $RESP4;
	        break;
		}
	}
}
?>


<script src="util/validations.js"></script>
<script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
</head>


  <tr> 
    <td> 

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

<p align=center><b><font face="Arial, Helvetica, sans-serif" size="3"><?=$page_title?></b></p>



<div id="errorDiv">
	<p align="center" class="menu2_abm"><font color="red"><?=$error?></font></p>
</div>
<div id="exitoDiv">
	<p align="center" class="menu2_abm"><font color="green"><?=$exito?></font></p>
</div>	
		<?
		// Actualizaci?n de registro
		if (($accion == 'ALTA') )	{

			$sql="SELECT s.id as id_sector, s.nombre as sector, u.jerarquia as jerarquia FROM usuarios u inner join sector s on u.sector = s.id WHERE u.id='".$_SESSION['idUsuario']."'";
			
			//print $sql;
			$res = mysql_query($sql);
			if (mysql_num_rows($res) < 1) {
				//print "NO EXISTE usuario";
					$resp = 1;
					mysql_free_result($res);
					?><META HTTP-EQUIV="Refresh" CONTENT="0; URL=<?=$backpage?>&resp=<?=$resp?>"><?
					return;	
			}
			$idSector = mysql_result($res,0,'id_sector');
			$sector = mysql_result($res,0,'sector');
			$jerarquia = mysql_result($res,0,'jerarquia');

			//Si es "empleado" puede ser un superior "jefe" o "jefe dependiente de gerencia" del sector
			if($jerarquia == 3){
				$sql2 = "SELECT * FROM usuarios where sector = ".$idSector." and (jerarquia = 2 or jerarquia = 5)";
			
			//si es "jefe" o "Gerente" el superior es "Persidente" 
			}else if($jerarquia == 2 || $jerarquia == 6){
				$sql2 = "SELECT * FROM usuarios where jerarquia = 1";
			
			//si es "jefe dependiente de gerencia" el superior es "gerente" del sector
			}else if ($jerarquia == 5){	
				$sql2 = "SELECT * FROM usuarios where sector = ".$idSector." and jerarquia = 6";
			}else{
						$resp = 1;
						?><META HTTP-EQUIV="Refresh" CONTENT="0;  URL=<?=$backpage?>&resp=<?=$resp?>"><?
						return;	
			}
				
			//print $sql2;
			$res2 = mysql_query($sql2);
			if (mysql_num_rows($res2) < 1) {
					//print "NO EXISTE jefe";
					$resp = 2;
					mysql_free_result($res2);
					?><META HTTP-EQUIV="Refresh" CONTENT="0;  URL=<?=$backpage?>&resp=<?=$resp?>"><?
					return;	
			}else if(mysql_num_rows($res2) > 1){
				//print "mas de un jefe";
					$resp = 3;
					mysql_free_result($res2);
					?><META HTTP-EQUIV="Refresh" CONTENT="0; URL=<?=$backpage?>&resp=<?=$resp?>"><?
					return;	
			}

			$superior = mysql_result($res2,0,'nombre')." ".mysql_result($res2,0,'apellido');
			$idSuperior = mysql_result($res2,0,'id');
			$page_title = "Formulario de Pedidos";
			$targetAction = "ENVIO"; 
		?>


		 <form method="post" action="<?=$here?>?accion=<?=$targetAction?>" name="data" enctype="multipart/form-data">
		 <input type="hidden" name="id" value="<?=$id?>">
         
         <div class="font" id="font">
<table border="0" cellspacing="0" cellpadding="0" align="center">

 <tr> 
		       <td valign="top" align="right" class="menu2_abm">Sector&nbsp;&nbsp;</td>
		        <td valign="top" class="menu2_abm"><b><?=$sector?><b></td>
		          <input type="hidden" name="sector" value="<?=$idSector?>">
		      </tr>
		      <tr><td height="10"></td></tr>
		   	  <tr> 
		       <td valign="top" align="right" class="menu2_abm">Superior &nbsp;&nbsp;</td>
		        <td valign="top" class="menu2_abm"><b><?=$superior?><b></td>
		         <input type="hidden" name="superior" value="<?=$idSuperior?>">
		      </tr>
		      <tr><td height="10"></td></tr>
		   
		      <tr> 
		        <td valign="middle" align="right" class="menu2_abm">&nbsp;&nbsp;</td>
		       <td valign="top" > 
		          <span class="Estilo8">
		          <select name="asunto" class="texto3 Estilo1 Estilo5 Estilo3" id="cbEspecilidadTurno" onchange="javascript: cbEspecilidadTurno_Change();">
                      <option value="Vacaciones">Vacaciones</option>
		            <option value="Días de estudio">Dias de estudio</option>
		            <option value="Llegadas tarde">Llegadas tarde</option>
		            <option value="Retirarse antes">Retirarse antes</option>
		            <option value="Turno médico">Turno médico</option>
		          
	              </select>
		          </span></td>
		     
		      </tr>
		      <tr><td height="5"></td></tr>
		      <tr> 
		        <td valign="middle" align="right" class="menu2_abm">Horario Normal ingreso:&nbsp;&nbsp;</td>
		        <td valign="top" >
                		          <select name="desde1" class="texto3 Estilo1 Estilo5 Estilo3" id="desde1" onchange="javascript: cbEspecilidadTurno_Change();">
		            
		          
		            <option value="06:00">6:00 Hs  </option>
		            <option value="06:30">6:30 Hs  </option>
		            <option value="07:00">7:00 Hs  </option>
		            <option value="07:30">7:30 Hs  </option>
                    <option value="08:00">8:00 Hs  </option>
		            <option value="08:30">8:30 Hs  </option>
                    <option value="09:00">9:00 Hs  </option>
		            <option value="09:30">9:30 Hs  </option>
                    <option value="10:00">10:00 Hs  </option>
		            <option value="10:30">10:30 Hs  </option>
                    <option value="11:00">11:00 Hs  </option>
		            <option value="11:30">11:30 Hs  </option>
                    <option value="12:00">12:00 Hs  </option>
		            <option value="12:30">12:30 Hs  </option>
                    <option value="13:00">13:00 Hs  </option>
		            <option value="13:30">13:30 Hs  </option>
                     <option value="14:00">14:00 Hs  </option>
		            <option value="14:30">14:30 Hs  </option>
                    <option value="15:00">15:00 Hs  </option>
		            <option value="15:30">15:30 Hs  </option>
                    <option value="16:00">16:00 Hs  </option>
		            <option value="16:30">16:30 Hs  </option>
                     <option value="17:00">17:00 Hs  </option>
                      <option value="17:30">17:30 Hs  </option>
                      <option value="18:00">18:00 Hs  </option>
                      <option value="18:30">18:30 Hs  </option>
                      <option value="19:00">19:00 Hs  </option>
                      <option value="19:30">19:30 Hs  </option>
                      <option value="20:00">20:00 Hs  </option>
                      <option value="20:30">20:30 Hs  </option>
                      <option value="21:00">21:00 Hs  </option>
                      <option value="21:30">21:30 Hs  </option>
                      <option value="22:00">22:00 Hs  </option>
                      <option value="22:30">22:30 Hs  </option>
                      <option value="23:00">23:00 Hs  </option>
		           
		          
	              </select>
               &nbsp; <span class="menu2_abm">Horario Normal egreso:</span>
                <select name="hasta1" class="texto3 Estilo1 Estilo5 Estilo3" id="hasta1" onchange="javascript: cbEspecilidadTurno_Change();">
                  
                  <option value="06:00">6:00 Hs </option>
                  <option value="06:30">6:30 Hs </option>
                  <option value="07:00">7:00 Hs </option>
                  <option value="07:30">7:30 Hs </option>
                  <option value="08:00">8:00 Hs </option>
                  <option value="08:30">8:30 Hs </option>
                  <option value="09:00">9:00 Hs </option>
                  <option value="09:30">9:30 Hs </option>
                  <option value="10:00">10:00 Hs </option>
                  <option value="10:30">10:30 Hs </option>
                  <option value="11:00">11:00 Hs </option>
                  <option value="11:30">11:30 Hs </option>
                  <option value="12:00">12:00 Hs </option>
                  <option value="12:30">12:30 Hs </option>
                  <option value="13:00">13:00 Hs </option>
                  <option value="13:30">13:30 Hs </option>
                  <option value="14:00">14:00 Hs </option>
                  <option value="14:30">14:30 Hs </option>
                  <option value="15:00">15:00 Hs </option>
                  <option value="15:30">15:30 Hs </option>
                  <option value="16:00">16:00 Hs </option>
                  <option value="16:30">16:30 Hs </option>
                  <option value="17:00">17:00 Hs </option>
                  <option value="17:30">17:30 Hs </option>
                  <option value="18:00">18:00 Hs </option>
                  <option value="18:30">18:30 Hs </option>
                  <option value="19:00">19:00 Hs </option>
                  <option value="19:30">19:30 Hs </option>
                  <option value="20:00">20:00 Hs </option>
                  <option value="20:30">20:30 Hs </option>
                  <option value="21:00">21:00 Hs </option>
                  <option value="21:30">21:30 Hs </option>
                  <option value="22:00">22:00 Hs </option>
                  <option value="22:30">22:30 Hs </option>
                  <option value="23:00">23:00 Hs </option>
                </select>                <br /></td>
		      </tr>
              
              		      <tr> 
		        <td valign="middle" align="right" class="menu2_abm">Horario solicitado:&nbsp;&nbsp;</td>
		        <td valign="top" ><select name="desde2" class="texto3 Estilo1 Estilo5 Estilo3" id="desde2" onchange="javascript: cbEspecilidadTurno_Change();">
		          
		          <option value="06:00">6:00 Hs </option>
		          <option value="06:30">6:30 Hs </option>
		          <option value="07:00">7:00 Hs </option>
		          <option value="07:30">7:30 Hs </option>
		          <option value="08:00">8:00 Hs </option>
		          <option value="08:30">8:30 Hs </option>
		          <option value="09:00">9:00 Hs </option>
		          <option value="09:30">9:30 Hs </option>
		          <option value="10:00">10:00 Hs </option>
		          <option value="10:30">10:30 Hs </option>
		          <option value="11:00">11:00 Hs </option>
		          <option value="11:30">11:30 Hs </option>
		          <option value="12:00">12:00 Hs </option>
		          <option value="12:30">12:30 Hs </option>
		          <option value="13:00">13:00 Hs </option>
		          <option value="13:30">13:30 Hs </option>
		          <option value="14:00">14:00 Hs </option>
		          <option value="14:30">14:30 Hs </option>
		          <option value="15:00">15:00 Hs </option>
		          <option value="15:30">15:30 Hs </option>
		          <option value="16:00">16:00 Hs </option>
		          <option value="16:30">16:30 Hs </option>
		          <option value="17:00">17:00 Hs </option>
		          <option value="17:30">17:30 Hs </option>
		          <option value="18:00">18:00 Hs </option>
		          <option value="18:30">18:30 Hs </option>
		          <option value="19:00">19:00 Hs </option>
		          <option value="19:30">19:30 Hs </option>
		          <option value="20:00">20:00 Hs </option>
		          <option value="20:30">20:30 Hs </option>
		          <option value="21:00">21:00 Hs </option>
		          <option value="21:30">21:30 Hs </option>
		          <option value="22:00">22:00 Hs </option>
		          <option value="22:30">22:30 Hs </option>
		          <option value="23:00">23:00 Hs </option>
		          </select>
		          &nbsp; 
		          <span class="menu2_abm">Horario Solicitado egreso:</span>
		          <select name="hasta2" class="texto3 Estilo1 Estilo5 Estilo3" id="hasta2" onchange="javascript: cbEspecilidadTurno_Change();">
		            
		            <option value="06:00">6:00 Hs </option>
		            <option value="06:30">6:30 Hs </option>
		            <option value="07:00">7:00 Hs </option>
		            <option value="07:30">7:30 Hs </option>
		            <option value="08:00">8:00 Hs </option>
		            <option value="08:30">8:30 Hs </option>
		            <option value="09:00">9:00 Hs </option>
		            <option value="09:30">9:30 Hs </option>
		            <option value="10:00">10:00 Hs </option>
		            <option value="10:30">10:30 Hs </option>
		            <option value="11:00">11:00 Hs </option>
		            <option value="11:30">11:30 Hs </option>
		            <option value="12:00">12:00 Hs </option>
		            <option value="12:30">12:30 Hs </option>
		            <option value="13:00">13:00 Hs </option>
		            <option value="13:30">13:30 Hs </option>
		            <option value="14:00">14:00 Hs </option>
		            <option value="14:30">14:30 Hs </option>
		            <option value="15:00">15:00 Hs </option>
		            <option value="15:30">15:30 Hs </option>
		            <option value="16:00">16:00 Hs </option>
		            <option value="16:30">16:30 Hs </option>
		            <option value="17:00">17:00 Hs </option>
		            <option value="17:30">17:30 Hs </option>
		            <option value="18:00">18:00 Hs </option>
		            <option value="18:30">18:30 Hs </option>
		            <option value="19:00">19:00 Hs </option>
		            <option value="19:30">19:30 Hs </option>
		            <option value="20:00">20:00 Hs </option>
		            <option value="20:30">20:30 Hs </option>
		            <option value="21:00">21:00 Hs </option>
		            <option value="21:30">21:30 Hs </option>
		            <option value="22:00">22:00 Hs </option>
		            <option value="22:30">22:30 Hs </option>
		            <option value="23:00">23:00 Hs </option>
	              </select>		          <br /></td>
		      </tr>
              
              
              		      <tr> 
		        <td valign="middle" align="right" class="menu2_abm">Mensaje:&nbsp;&nbsp;</td>
		        <td valign="top" > 
		        	<textarea name="mensaje" class="menu2_abm" rows="4" cols="52" ></textarea>
		        </td>
		      </tr>
              
              
		         <tr><td height="10"></td></tr>
		 
		      <tr><td height="10"></td></tr>
			  <tr bgcolor="#BCCCCC"><td colspan="3"></td></tr>
		   
		   </table>
		 
		  </form>
          
<!--final font--></div>
          
		<br>
		<p align=center>
			<input type="button" name="boton" value="Cancelar" onClick="location='home.php';" style="width:100px"/>
			&nbsp;&nbsp;&nbsp;
			<input type="button" name="boton2" value="Enviar" onClick="return verificar()" style="width:100px"/>
		</p>


		<br>
		<br>

		<script language="JavaScript">

			function verificar()	{

				
				var form = document.forms['data'];
				
				if (form.elements['asunto'].value == "")	{
					form.elements['asunto'].focus();
					alert("Debe ingresar el asunto del pedido");
					return false;
				}
				
				if (form.elements['mensaje'].value == "")	{
					form.elements['mensaje'].focus();
					alert("Debe ingresar el cuerpo del mensaje del pedido");
					return false;
				}
				form.submit();
				return true;
			}
			
			// s?lo en el caso de caracteres especiales
			document.forms['data'].elements['asunto'].value = "<?=$asunto?>";
			document.forms['data'].elements['mensaje'].value = "<?=$mensaje?>";
			
		</script>
		<?}



}
?>




<!--final contenedor--></div>


</body>
</html>

