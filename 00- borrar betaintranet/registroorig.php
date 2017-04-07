<?
include ('lib.php');
include ('conect.php');

$MAX_NEWS = 2;
$RED_FONT = "font-family: Arial, Helvetica, sans-serif; font-size: 11px; color: red";

if (isset($_GET['accion'])) 	{
	$accion=$_GET['accion'];
}

//print $accion;
$TABLA = DB_PREFIX . "usuarios" ;

//////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////


?>


<html>
<head>

<title><?=$page_title?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="styles.css" type="text/css">
<script src="util/validations.js"></script>
</head>

<body bgcolor="#EBEBEB" link="#153579" vlink="#153579" alink="#153579" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
  <? include ('header2.php');?>
<p align=center><b><font face="Arial, Helvetica, sans-serif" size="3">Ingreso a la Intranet</b></p>
  <br>

<br>

<?

///////////////////////////////////////////////
// Alta de registro
if ($accion == 'ALTA_UPD')	{

	$dni = addSlashes($_POST['dni']);
	$clave = addSlashes($_POST['clave']);
	$nombre = addSlashes($_POST['nombre']);
	$apellido = addSlashes($_POST['apellido']);
	$sector = addSlashes($_POST['sector']);
	$email = addSlashes($_POST['email']);
	$edificio = addSlashes($_POST['edificio']);
	
	$validado = 'N';
	$bloqueado = 'N';
	
	//////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////
	// buscar ese dni

	$sql = "SELECT COUNT(*) AS cant FROM $TABLA WHERE LOWER(nro_doc) = LOWER('$dni')";
	$res = mysql_query($sql);
	$cant = mysql_result($res,0,'cant');
	mysql_free_result($res);

	//print $cant;
	
	if ($cant > 0)	// el usuario ya existe
	{
		
		?>
		<body onload="document.forms['data'].submit();">
				<form name="data" action="registro.php?accion=ALTA" method="POST">
					<input type="hidden" name="err" value="El n�mero de documento ya existe.">
					<input type="hidden" name="nro_doc" value="<?=$nro_doc?>">
					<input type="hidden" name="clave" value="<?=$clave?>">
					<input type="hidden" name="nombre" value="<?=$nombre?>">
					<input type="hidden" name="apellido" value="<?=$apellido?>">
					<input type="hidden" name="sector" value="<?=$sector?>">
					<input type="hidden" name="email" value="<?=$email?>">
					<input type="hidden" name="edificio" value="<?=$edificio?>">
				</form>
		</body>		
			
		<?
		return;
	}
	
	//////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////

	$sql = "SELECT MAX(id)+1 AS indexId FROM $TABLA";
	$res = mysql_query($sql);
	$indexId = mysql_result($res,0,'indexId');
	mysql_free_result($res);
	
	//print $sql;
	//print $indexId;
	
	$sql = "INSERT INTO $TABLA (id, clave, adm, activo, nro_doc, email, edificio, sector, nombre, apellido, fecha_reg) ";
	$sql.= 	"VALUES ($indexId,'$clave', 'N', 'S', '$dni', '$email', '$edificio', '$sector', '$nombre', '$apellido', NOW())";
	//print $sql;
	mysql_query($sql);
	
	
	?>
		<div style="margin: 0 auto;width: 463px;">
			Gracias por registrarte <?  print $nombre.' '.$apellido ?>  Tus datos de acceso son
			</br>
			Numero de documento: <? print $dni ?>
			</br>
			Contrasena: <? print $clave ?>
			</br>
			Ya puede comenzar a navegar la intranet
			<input type="button" name="boton" value="Comenzar!" onclick="location='index.php'" style="width:100px"/>
			</div>
	
		
	<?
		
	return;
}



///////////////////////////////////////////////
// Formulario Registro
if (($accion == 'ALTA'))	{
	
	$id = "";
	$targetAction = "ALTA_UPD";
	$page_title = "Registro de Usuario";
	$err = "";

	
	$dni = "";
	$fecha_reg = "";
	$nombre = "";
	$clave = "";
	$apellido = "";
	$sector = "";
	$edificio = "";
	$email = "";
	$validado = "";
	$bloqueado = "";
	
	$backpage = "registro.php";
	
		$fecha_reg = date("d-m-Y  H:m:s");
		
		if (isset($_POST['err']))
		{
			$err = $_POST['err'];
			$nombre = $_POST['nombre'];
			$clave = $_POST['clave'];
			$apellido = $_POST['apellido'];
			$sector = $_POST['sector'];
			$edificio = $_POST['edificio'];
			$email = $_POST['email'];
			$dni = $_POST['dni'];
		}
	
	
?>

<?if ($err != ''){?><p align="center" class="menu2_abm"><font color="red">Error: <b><?=$err?></b></font></p><?}?>


 <form method="post" action="registro.php?accion=<?=$targetAction?>" name="data" enctype="multipart/form-data">
 
   <table border="0" cellspacing="0" cellpadding="0" align="center">

      <tr> 
        <td valign="top" align="right" class="menu2_abm">Fecha de registro&nbsp;&nbsp;</td>
        <td valign="top" class="menu2_abm"><b><?=$fecha_reg?><b></td>
      </tr>
      <tr><td height="10"></td></tr>
   
      <tr> 
        <td valign="middle" align="right" class="menu2_abm">Numero de documento&nbsp;&nbsp;</td>
        <?if ($accion == 'ALTA'){?>
        <td valign="top" > 
          <input type="text" class="menu2_abm" name="dni" size="30" maxlength="25" value="" onblur="this.value=Trim(this.value);">
        </td>
        <?}?>
      </tr>
      <tr><td height="5"></td></tr>
      <tr> 
        <td valign="middle" align="right" class="menu2_abm">Contrasena&nbsp;&nbsp;</td>
        <td valign="top" > 
          <input type="text" class="menu2_abm" name="clave" size="30" maxlength="25" value="">
        </td>
      </tr>
      <tr> 
        <td valign="middle" align="right" class="menu2_abm">Repeticion de contrasena&nbsp;&nbsp;</td>
        <td valign="top" > 
          <input type="text" class="menu2_abm" name="clave_rep" size="30" maxlength="25" value="">
        </td>
      </tr>
     
      
      <tr><td height="10"></td></tr>
      <tr bgcolor="#BCCCCC"><td colspan="3"></td></tr>
      <tr><td height="10"></td></tr>

      <tr> 
        <td valign="middle" align="right" class="menu2_abm">Nombre &nbsp;&nbsp;</td>
        <td valign="top" > 
          <input type="text" class="menu2_abm" name="nombre" size="50" maxlength="80" value="" onblur="this.value=Trim(this.value);">
        </td>
      </tr>
      <tr> 
        <td valign="middle" align="right" class="menu2_abm">Apellido &nbsp;&nbsp;</td>
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
      <tr><td height="10"></td></tr>
      <tr bgcolor="#BCCCCC"><td colspan="3"></td></tr>
   
   </table>
 
  </form>
<br>
<p align=center>
	<input type="button" name="boton" value="Volver" onclick="location='index.php'" style="width:100px"/>
	&nbsp;&nbsp;&nbsp;
	<input type="button" name="boton2" value="Guardar" onclick="return verificar()" style="width:100px"/>
</p>


<br>
<br>

<script language="JavaScript">

	function verificar()	{
		
		var form = document.forms['data'];
		
		if (form.elements['dni'].value == "")	{
			form.elements['dni'].focus();
			alert("Debe ingresar el n�mero de documento.");
			return false;
		}
		form.elements['nombre'].value = form.elements['nombre'].value.toLowerCase();
		if (form.elements['nombre'].value == "")	{
			form.elements['nombre'].focus();
			alert("Debe ingresar el nombre.");
			return false;
		}
		form.elements['apellido'].value = form.elements['apellido'].value.toLowerCase();
		if (form.elements['apellido'].value == "")	{
			form.elements['apellido'].focus();
			alert("Debe ingresar el apellido.");
			return false;
		}
	
		if (form.elements['clave'].value != form.elements['clave_rep'].value)	{
			alert("La contrase�a ingresada y su repetici�n no son iguales.");
			return false;
		}
		
		
		if (form.elements['email'].value == "")	{
			form.elements['email'].focus();
			alert("Debe ingresar la direcci�n de e-mail.");
			return false;
		}
		else
		{
			if (!checkEmail(form.elements['email'].value))
			{
				form.elements['email'].focus();
				alert("La direcci�n de e-mail no es v�lida.");
				return false;
			}
		}
		
		form.submit();
		return true;
	}
	
	// s�lo en el caso de caracteres especiales
	document.forms['data'].elements['nombre'].value = "<?=$nombre?>";
	document.forms['data'].elements['clave'].value = "<?=$clave?>";
	document.forms['data'].elements['apellido'].value = "<?=$apellido?>";
	document.forms['data'].elements['sector'].value = "<?=$sector?>";
	document.forms['data'].elements['edificio'].value = "<?=$edificio?>";
	document.forms['data'].elements['email'].value = "<?=$email?>";
	

</script>
<?}?>


</body>
</html>



</body>
</html>



