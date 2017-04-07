<?
include ('lib.php');
include ('conect.php');

$accion = null;
$RED_FONT = "font-family: Arial, Helvetica, sans-serif; font-size: 11px; color: red";

if (isset($_GET['accion'])) 	{
	$accion=$_GET['accion'];
}

//print $accion;
$TABLA = DB_PREFIX . "usuarios" ;

//////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////


?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

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
if ($accion == 'MAIL')	{

	$email = addSlashes($_POST['email']);
	$total = 0;
	$sql = "SELECT nombre, apellido, email, clave, nro_doc FROM $TABLA WHERE email = LOWER('$email')";
	//print $sql;
	$res = mysql_query($sql);
	//print $res;
	if($res){
		$total = mysql_num_rows($res);
		if ($total == 1){
			$nombre = mysql_result($res,0,'nombre');
			$apellido = mysql_result($res,0,'apellido');
			$email = mysql_result($res,0,'email');
			$nro_doc = mysql_result($res,0,'nro_doc');
			$clave = mysql_result($res,0,'clave');
		}
	}
	mysql_free_result($res);

		
	if ($total != 1)	// el usuario no existe
	{
		
		?>
		<body onload="document.forms['data'].submit();">
				<form name="data" action="olvidoPass.php?error=1" method="POST">
					<input type="hidden" name="email" value="<?=$email?>">
				</form>
		</body>		
			
		<?
		return;
	}
		
	$bodyMail = "Se solicitó recuperar la clave de la intranet, si usted no lo hizo, por favor contactarse con el administrador ";	
	$bodyMail = $bodyMail.$nombre.' '.$apellido." Tus datos de acceso son: ";
	$bodyMail = $bodyMail."Documento: ".$nro_doc."";
	$bodyMail = $bodyMail." Contraseña: ".$clave."";

	mail($email,"Intranet Clave Recuperada",$bodyMail);

	?>
		<div style="margin: 0 auto;width: 463px;">
			Gracias! Se envió un mail con la contraseña</br> 
			<input type="button" name="boton" value="Seguir" onclick="location='index.php'" style="width:100px"/>
			</div>
	
		
	<?
		
	return;
}



///////////////////////////////////////////////
// Formulario Registro
if (($accion == null))	{
	
	$id = "";
	$targetAction = "MAIL";
	$page_title = "Recuperar Contraseña";
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
	
	$backpage = "olvidoPass.php";
	
		$fecha_reg = date("d-m-Y  H:m:s");
		
		if (isset($_GET['error']))
		{
			$err = "No existe usuario con el email, intente nuevamente";
		}
	
	
?>

<?if ($err != ''){?><p align="center" class="menu2_abm"><font color="red">Error: <b><?=$err?></b></font></p><?}?>


 <form method="post" action="olvidoPass.php?accion=<?=$targetAction?>" name="data" enctype="multipart/form-data">
 
   <table border="0" cellspacing="0" cellpadding="0" align="center">

      <tr> 
        <td valign="middle" align="right" class="menu2_abm">E-mail&nbsp;&nbsp;</td>
        <td valign="top" > 
          <input type="text" class="menu2_abm" name="email" size="45" maxlength="45" value="" onblur="this.value=Trim(this.value);">
        </td>
      </tr>
      <tr><td height="10"></td></tr>
      <tr bgcolor="#BCCCCC"><td colspan="3"></td></tr>
   
   </table>
 
  </form>
<br>
<p align=center>
	
	<input type="button" name="boton2" value="Enviar" onclick="return verificar()" style="width:100px"/>
</p>


<br>
<br>

<script language="JavaScript">

	function verificar()	{
		
		var form = document.forms['data'];
		
			
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
	
	

</script>
<?}?>


</body>
</html>



</body>
</html>



