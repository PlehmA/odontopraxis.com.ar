<?
include ('lib.php');
include ('checks.php');


$MAX_NEWS = 2;
$RED_FONT = "font-family: Arial, Helvetica, sans-serif; font-size: 11px; color: red";
$here = "perfil.php";
$backpage = $here."?accion=MOD";
$RESP0 = "Se ha actualizado con éxito";
$RESP1 = "El archivo ha sido subido exitosamente";
$RESP2 = "Ha ocurrido un error, trate de nuevo!<BR>";
$RESP3 = "El archivo es mayor que 200KB, debes reduzcirlo antes de subirlo<BR>";
$RESP4 = " Tu archivo tiene que ser JPG o GIF o PNG. Otros archivos no son permitidos<BR>";
$RESP5 = "Ha ocurrido un error subiendo el archivo, trate de nuevo!<BR>";
$RESP6 = "La imagen no debe superar los 128 x 128 pixels";

if (isset($_GET['accion'])) 	{
	$accion=$_GET['accion'];
//	print $accion;
}

if (isset($_GET['resp'])) 	{
	$resp=$_GET['resp'];
}else{
	$resp = "";
}

if (($accion != 'MOD') && ($accion != 'MOD_UPD') )	{
//	print "CHAU";
	?><META HTTP-EQUIV="Refresh" CONTENT="0; URL=<?=MAIN_PAGE?>"><?
	return;
	}
 
include ('conect.php');


$TABLA = DB_PREFIX . "usuarios" ;


//////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////


?>

<?

///////////////////////////////////////////////
// Actualización de registro
if ($accion == 'MOD_UPD')	{

	$resp = 0;
	$id=$_SESSION['idUsuario'];

	$nombre = addSlashes($_POST['nombre']);
	$clave = addSlashes($_POST['clave']);
	$apellido = addSlashes($_POST['apellido']);
	$sector = addSlashes($_POST['sector']);
	$edificio = addSlashes($_POST['edificio']);
	$email = addSlashes($_POST['email']);
	$nro_doc = addSlashes($_POST['nro_doc']);
	
	//////////////////////////////////////////////////////////
	//if($_FILES['uploadedfile'] != null){
		$target_path = PROFILE_DIR;

		$uploadedfile_size=$_FILES['uploadedfile'][size];
		if($_FILES[uploadedfile][size]!=0){
			list($width, $height) = getimagesize($_FILES['uploadedfile']['tmp_name']);
		//	print $width." ".$height;
			if ($_FILES[uploadedfile][size]>200000){
				$resp = 3;
			}else if (!($_FILES[uploadedfile][type] =="image/jpeg" OR $_FILES[uploadedfile][type] =="image/gif" 
				OR $_FILES[uploadedfile][type] =="image/png" )){
				$resp = 4;
			}else if ($width > MAX_WIDTH  or $height > MAX_HEIGHT){
				$resp = 6;
			}else{
				$fileName = basename( $_FILES['uploadedfile']['name']);
				$target_path = $target_path . $fileName; 
				if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path)) { 
					$resp = 1;
				} else{
					$resp = 5;
				}
			}
		}
	//}

	//////////////////////////////////////////////////////////

	$sql = "UPDATE $TABLA SET ";
	$sql.=			" nombre='$nombre', clave='$clave', apellido='$apellido',";
	//$sql.=			" clave='$clave', nombreext='$nombreext',";
	$sql.=			" sector='$sector', edificio='$edificio',";
	$sql.=			" email='$email', nro_doc='$nro_doc' ";
	if ($resp == 1){
		$sql.=			" ,foto='$fileName' ";
	}
	$sql.= " WHERE id='$id'";
	//print "sql: $sql<br>";
	$resultado = mysql_query($sql);

	if (!$resultado){
			$resp= 2;
	}
	
	?><META HTTP-EQUIV="Refresh" CONTENT="0; URL=<?=$backpage?>&resp=<?=$resp?>"><?

	return;
}



///////////////////////////////////////////////
// Actualización de registro
if (($accion == 'MOD') )	{

	//print "hola";
	
	$id = "";
	$error = "";
	$exito = "";

	$fecha_reg = "";
	$nombre = "";
	$clave = "";
	$apellido = "";
	$sector = "";
	$edificio = "";
	$email = "";
	$nro_doc = "";
	$activo = "";
	$adm = "";
	
		
		$id = $_SESSION['idUsuario'];
		$targetAction = "MOD_UPD";

		$sql="SELECT * FROM $TABLA WHERE id='$id'";
		$res = mysql_query($sql);
		if (mysql_num_rows($res) < 1) {
			//print "NO EXISTE";
			mysql_free_result($res);
			?><META HTTP-EQUIV="Refresh" CONTENT="0; URL=<?=$here?>"><?
			return;	
		}
		$page_title = "Edición de Usuario-Web";
		$fecha_reg = mysql_result($res,0,'fecha_reg');
		$nombre = mysql_result($res,0,'nombre');
		$clave = mysql_result($res,0,'clave');
		$apellido = mysql_result($res,0,'apellido');
		$sector = mysql_result($res,0,'sector');
		$edificio = mysql_result($res,0,'edificio');
		$email = mysql_result($res,0,'email');
		$nro_doc = mysql_result($res,0,'nro_doc');
		$activo = mysql_result($res,0,'activo');
		$adm = mysql_result($res,0,'adm');
		$foto =  mysql_result($res,0,'foto');
		
		mysql_free_result($res);

	 if ($resp != ""){
	 	switch ($resp) {
	    case 0:
	        $exito = $RESP0;
	        break;
	    case 1:
	        $exito = $RESP1;
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
	    case 5:
	        $error = $RESP5;
	        break;   
	    case 6:
	        $error = $RESP6;
	        break;   
    }
} 
	
?>

<html>
<head>

<title><?=$page_title?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="styles.css" type="text/css">
<script src="util/validations.js"></script>
<script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
</head>

<body bgcolor="#EBEBEB" link="#153579" vlink="#153579" alink="#153579" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
  <? include ('header2.php');?>
<p align=center><b><font face="Arial, Helvetica, sans-serif" size="3"><?=$page_title?></b></p>


<br>
<div id="errorDiv">
	<p align="center" class="menu2_abm"><font color="red"><?=$error?></font></p>
</div>
<div id="exitoDiv">
	<p align="center" class="menu2_abm"><font color="green"><?=$exito?></font></p>
</div>	


 <form method="post" action="<?=$here?>?accion=<?=$targetAction?>" name="data" enctype="multipart/form-data">
 <input type="hidden" name="id" value="<?=$id?>">


   <table border="0" cellspacing="0" cellpadding="0" align="center">

      <tr> 
        <td valign="top" align="right" class="menu2_abm">Fecha de registro&nbsp;&nbsp;</td>
        <td valign="top" class="menu2_abm"><b><?=$fecha_reg?><b></td>
      </tr>
      <tr><td height="10"></td></tr>
   
      <tr> 
        <td valign="middle" align="right" class="menu2_abm">Numero de documento&nbsp;&nbsp;</td>
       <td valign="top" > 
          <input type="text" class="menu2_abm" name="nro_doc" size="30" maxlength="25" value="" >
        </td>
     
      </tr>
      <tr><td height="5"></td></tr>
      <tr> 
        <td valign="middle" align="right" class="menu2_abm">Contraseña&nbsp;&nbsp;</td>
        <td valign="top" > 
          <input type="text" class="menu2_abm" name="clave" size="30" maxlength="25" value="">
        </td>
      </tr>
      <!--
      <tr> 
        <td valign="middle" align="right" class="menu2_abm">Repetición de contraseña&nbsp;&nbsp;</td>
        <td valign="top" > 
          <input type="text" class="menu2_abm" name="clave_rep" size="30" maxlength="25" value="">
        </td>
      </tr>
      -->
      
      <tr><td height="10"></td></tr>
      <tr bgcolor="#BCCCCC"><td colspan="3"></td></tr>
      <tr><td height="10"></td></tr>

      <tr> 
        <td valign="middle" align="right" class="menu2_abm">Nombre&nbsp;&nbsp;</td>
        <td valign="top" > 
          <input type="text" class="menu2_abm" name="nombre" size="50" maxlength="80" value="" onblur="this.value=Trim(this.value);">
        </td>
      </tr>
      <tr> 
        <td valign="middle" align="right" class="menu2_abm">Apellido&nbsp;&nbsp;</td>
        <td valign="top" > 
          <input type="text" class="menu2_abm" name="apellido" size="50" maxlength="80" value="" onblur="this.value=Trim(this.value);">
        </td>
      </tr>
      <tr> 
        <td valign="middle" align="right" class="menu2_abm">Sector&nbsp;&nbsp;</td>
        <td valign="top" > 
          <input type="text" class="menu2_abm" name="sector" size="30" maxlength="25" value="" onblur="this.value=Trim(this.value);">
        </td>
      </tr>
      <tr> 
        <td valign="middle" align="right" class="menu2_abm">Edificio&nbsp;&nbsp;</td>
        <td valign="top" > 
          <input type="text" class="menu2_abm" name="edificio" size="30" maxlength="25" value="" onblur="this.value=Trim(this.value);">
        </td>
      </tr>
      
       <tr> 
        <td valign="middle" align="right" class="menu2_abm">E-mail&nbsp;&nbsp;</td>
        <td valign="top" > 
          <input type="text" class="menu2_abm" name="email" size="30" maxlength="25" value="" onblur="this.value=Trim(this.value);">
        </td>
      </tr>
      <tr> 
        <td valign="middle" align="right" class="menu2_abm">Foto de Perfil&nbsp;&nbsp;</td>

        <? if ($foto != null ){
        ?> 
    	</tr>
        <tr> 
	        <td valign="middle" align="right" > <?
	        	echo "<img src='".PROFILE_DIR."$foto' >";
	        	?>
	        </td>
	     </tr>
	     <tr>  
	     	<td valign="middle" align="right" class="menu2_abm"></td>

        <? } ?>
        <td valign="top" > 
          <input name="uploadedfile" type="file" />
        </td>
      </tr>
     
      <tr><td height="10"></td></tr>
	  <tr bgcolor="#BCCCCC"><td colspan="3"></td></tr>
   
   </table>
 
  </form>
<br>
<p align=center>
	<input type="button" name="boton" value="Volver" onclick="location='home.php';" style="width:100px"/>
	&nbsp;&nbsp;&nbsp;
	<input type="button" name="boton2" value="Guardar" onclick="return verificar()" style="width:100px"/>
</p>


<br>
<br>

<script language="JavaScript">

	function verificar()	{

	//	alert("validando");
		
		var form = document.forms['data'];
		
		form.elements['nombre'].value = form.elements['nombre'].value.toLowerCase();
		if (form.elements['nombre'].value == "")	{
			form.elements['nombre'].focus();
			alert("Debe ingresar el nombre.");
			return false;
		}
		/*
		if (form.elements['clave'].value != form.elements['clave_rep'].value)	{
			alert("La nueva contraseña ingresada y su repetición no son iguales.");
			return false;
		}
		*/
		if (form.elements['apellido'].value == "")	{
			form.elements['apellido'].focus();
			alert("Debe ingresar el apellido.");
			return false;
		}
		if (form.elements['email'].value == "")	{
			form.elements['email'].focus();
			alert("Debe ingresar la dirección de e-mail.");
			return false;
		}
		else
		{
			if (!checkEmail(form.elements['email'].value))
			{
				form.elements['email'].focus();
				alert("La dirección de e-mail no es válida.");
				return false;
			}
		}
		//alert("todo bien");
		form.submit();
		return true;
	}
	
	// sólo en el caso de caracteres especiales
	document.forms['data'].elements['nombre'].value = "<?=$nombre?>";
	document.forms['data'].elements['clave'].value = "<?=$clave?>";
	document.forms['data'].elements['apellido'].value = "<?=$apellido?>";
	document.forms['data'].elements['email'].value = "<?=$email?>";
	document.forms['data'].elements['nro_doc'].value = "<?=$nro_doc?>";
	document.forms['data'].elements['sector'].value = "<?=$sector?>";
	document.forms['data'].elements['edificio'].value = "<?=$edificio?>";

</script>

</body>
</html>

<?}?>



