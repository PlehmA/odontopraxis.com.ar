<?
include ('lib.php');
include ('checks.php');

if ($_SESSION['jerarquia'] != 3 && $_SESSION['jerarquia'] != 2)	{
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
 
include ('conect.php');


$TABLA = DB_PREFIX . "pedido" ;


	$resSector = mysql_query('SELECT id,nombre FROM sector');
	$totalSector = mysql_num_rows($resSector);
	$idxSector = 0;
               

	$resEdificio = mysql_query('SELECT id,nombre FROM edificio');
	$totalEdificio= mysql_num_rows($resEdificio);
	$idxEdificio = 0; 

///////////////////////////////////////////////
// Actualizaci�n de registro
if ($accion == 'ENVIO')	{

	$resp = 0;
	$id=$_SESSION['idUsuario'];

	$asunto = addSlashes($_POST['asunto']);
	$mensaje = addSlashes($_POST['mensaje']);
	$superior = addSlashes($_POST['superior']);
	$sector = addSlashes($_POST['sector']);


	//////////////////////////////////////////////////////////

	$sql = "INSERT INTO $TABLA SET ";
	$sql.= " usuario='$id', superior='$superior', sector='$sector',";
	$sql.= " asunto='$asunto', mensaje='$mensaje',";
	$sql.= " fecha_pedido = now() ";
	//print $sql;
	$resultado = mysql_query($sql);

	if (!$resultado){
			$resp= 2;
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
		}
	}
}
?>
///////////////////////////////////////////////

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	

<title><?=$page_title?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="styles.css" type="text/css">
<link rel="stylesheet" href="contenido.css" type="text/css">
<script src="util/validations.js"></script>
<script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
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
           <table class="agendausuariostab" width="100" border="0" cellspacing="0" cellpadding="0" align="center">
<p align=center><b><font face="Arial, Helvetica, sans-serif" size="3"><?=$page_title?></b></p>



<div id="errorDiv">
	<p align="center" class="menu2_abm"><font color="red"><?=$error?></font></p>
</div>
<div id="exitoDiv">
	<p align="center" class="menu2_abm"><font color="green"><?=$exito?></font></p>
</div>	
		<?
		// Actualizaci�n de registro
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
			$jerarquiaSuperior = $jerarquia - 1;
			if($jerarquiaSuperior != 1 && $jerarquiaSuperior != 2){
					$resp = 1;
					?><META HTTP-EQUIV="Refresh" CONTENT="0;  URL=<?=$backpage?>&resp=<?=$resp?>"><?
					return;	
			}
			if($jerarquiaSuperior == 1){
				$sql2 = "SELECT * FROM usuarios where jerarquia = 1";
			}
			if ($jerarquiaSuperior == 2){
				$sql2 = "SELECT * FROM usuarios where sector = ".$idSector." and jerarquia = 2";
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
		        <td valign="middle" align="right" class="menu2_abm">Asunto&nbsp;&nbsp;</td>
		       <td valign="top" > 
		          <input type="text" class="menu2_abm" name="asunto" size="50" maxlength="100" value="" >
		        </td>
		     
		      </tr>
		      <tr><td height="5"></td></tr>
		      <tr> 
		        <td valign="middle" align="right" class="menu2_abm">Mensaje&nbsp;&nbsp;</td>
		        <td valign="top" > 
		        	<textarea name="mensaje" class="menu2_abm" rows="4" cols="52" ></textarea>
		        </td>
		      </tr>
		         <tr><td height="10"></td></tr>
		 
		      <tr><td height="10"></td></tr>
			  <tr bgcolor="#BCCCCC"><td colspan="3"></td></tr>
		   
		   </table>
		 
		  </form>
		<br>
		<p align=center>
			<input type="button" name="boton" value="Cancelar" onclick="location='home.php';" style="width:100px"/>
			&nbsp;&nbsp;&nbsp;
			<input type="button" name="boton2" value="Enviar" onclick="return verificar()" style="width:100px"/>
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
			
			// s�lo en el caso de caracteres especiales
			document.forms['data'].elements['asunto'].value = "<?=$asunto?>";
			document.forms['data'].elements['mensaje'].value = "<?=$mensaje?>";
			
		</script>
		<?}



}
?>
<td width="1" bgcolor="9298AB"><img src="pixel.gif"></td>
          <td valign="top" width="215"> 
            <div align="right">
              <?php include"col-der.php"?>
            </div>
          </td>
           <?php include"pie.php"?>
</table>


          </td>
          
        </tr>
        
      
    </td>
  </tr>
  

</table>
</body>
</html>
