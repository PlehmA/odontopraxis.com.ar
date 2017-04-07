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
if ($accion == 'ALTA_UPD')	{

	$dni = addSlashes($_POST['dni']);
	$clave = addSlashes($_POST['clave']);
	$nombre = addSlashes($_POST['nombre']);
	$apellido = addSlashes($_POST['apellido']);
	$sector = addSlashes($_POST['sector']);
	$email = addSlashes($_POST['email']);
	$edificio = addSlashes($_POST['edificio']);
	$tel = addSlashes($_POST['tel']);
	$interno = addSlashes($_POST['interno']);
	$fecha_nac = addSlashes($_POST['fecha_nac']);

	list($year, $month, $day)=explode("-",$fecha_nac);
//	print $month." ".$year." ".$day;

	if( (! is_numeric($day)) or (!is_numeric($month)) or (!is_numeric($year)) or (! checkdate($month,$day,$year))){
	
		?>
		<body onload="document.forms['data'].submit();">
				<form name="data" action="registro.php?accion=ALTA" method="POST">
					<input type="hidden" name="err" value="La fecha de nacimiento es inexistente. Intente nuevamente">
					<input type="hidden" name="dni" value="<?=$dni?>">
					<input type="hidden" name="clave" value="<?=$clave?>">
					<input type="hidden" name="nombre" value="<?=$nombre?>">
					<input type="hidden" name="apellido" value="<?=$apellido?>">
					<input type="hidden" name="sector" value="<?=$sector?>">
					<input type="hidden" name="email" value="<?=$email?>">
					<input type="hidden" name="edificio" value="<?=$edificio?>">
					<input type="hidden" name="tel" value="<?=$tel?>">
					<input type="hidden" name="interno" value="<?=$interno?>">
				</form>
		</body>		
			
		<?
		return;
	
	}

	$fecha_nac = $year.'-'.$month.'-'.$day;

	
	$validado = 'N';
	$bloqueado = 'N';
	
	//////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////
	// buscar ese dni

	$sql = "SELECT COUNT(*) AS cant FROM $TABLA WHERE LOWER(nro_doc) = LOWER('$dni')";
	$res = mysql_query($sql);
	$cant = mysql_result($res,0,'cant');
	mysql_free_result($res);


	$sql = "SELECT COUNT(*) AS cant FROM $TABLA WHERE LOWER(email) = LOWER('$email')";
	$res = mysql_query($sql);
	$cant2 = mysql_result($res,0,'cant');
	mysql_free_result($res);
	//print $cant;

	if($cant > 0 && $cant2 > 0){
		$mensaje = "El número de documento y el email ya están registrados, por favor intente con otros.";
		$dni = "";
		$email = "";
	}
	if($cant > 0 && $cant2 == 0){
		$mensaje = "El número de documento ya está registrado.";
		$dni = "";
	}
	if($cant2 > 0 && $cant == 0){
		$mensaje = "El email ya está registrado, por favor elija otro email.";
		$email = "";
	}

	if ($cant > 0 || $cant2 > 0)	// el usuario ya existe
	{
		
		?>
		<body onload="document.forms['data'].submit();">
				<form name="data" action="registro.php?accion=ALTA" method="POST">
					<input type="hidden" name="err" value="<?=$mensaje?>">
					<input type="hidden" name="dni" value="<?=$dni?>">
					<input type="hidden" name="clave" value="<?=$clave?>">
					<input type="hidden" name="nombre" value="<?=$nombre?>">
					<input type="hidden" name="apellido" value="<?=$apellido?>">
					<input type="hidden" name="sector" value="<?=$sector?>">
					<input type="hidden" name="email" value="<?=$email?>">
					<input type="hidden" name="edificio" value="<?=$edificio?>">
					<input type="hidden" name="fecha_nac" value="<?=$fecha_nac?>">
					<input type="hidden" name="tel" value="<?=$tel?>">
					<input type="hidden" name="interno" value="<?=$interno?>">
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
	
	$sql = "INSERT INTO $TABLA (id, clave, adm, activo, nro_doc, email, edificio, sector, nombre, apellido, fecha_reg, fecha_nac, tel, interno) ";
	$sql.= 	"VALUES ($indexId,'$clave', 'N', 'S', '$dni', '$email', '$edificio', '$sector', '$nombre', '$apellido', NOW(), '$fecha_nac', '$tel', '$interno')";
//	print $sql;
	$res = mysql_query($sql);
	if ($res){
	
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
	}else{
		?>
		<div style="margin: 0 auto;width: 463px;">
			Se detectó un problema 
			</br>
			Por favor intente nuevamente
			<input type="button" name="boton" value="Inicio" onclick="location='index.php'" style="width:100px"/>
			</div>		
	<?

	}
		
	//return;
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
	$fecha_nac = "";
	$tel = "";
	$interno = "";
	
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
			$fecha_nac = $_POST['fecha_nac'];
			$tel = $_POST['tel'];
			$interno = $_POST['interno'];
		}

	$resSector = mysql_query('SELECT id,nombre FROM sector');
	$totalSector = mysql_num_rows($resSector);
	$idxSector = 0;
               

	$resEdificio = mysql_query('SELECT id,nombre FROM edificio');
	$totalEdificio= mysql_num_rows($resEdificio);
	$idxEdificio = 0; 

	
	
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
        <td valign="middle" align="right" class="menu2_abm">Contraseña&nbsp;&nbsp;</td>
        <td valign="top" > 
          <input type="text" class="menu2_abm" name="clave" size="30" maxlength="25" value="">
        </td>
      </tr>
      <tr> 
        <td valign="middle" align="right" class="menu2_abm">Repetición de contraseña&nbsp;&nbsp;</td>
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
        	<select name="sector">
                    
            <? 
                
               while ($idxSector < $totalSector)	{
	
					$idSector = mysql_result($resSector, $idxSector,'id');
					$nombreSector = mysql_result($resSector, $idxSector,'nombre');
					$opcion = "<option value='$idSector' ";
					//echo $idxSector;
                   	if($idxSector == 0){
                   		$opcion = $opcion." selected='selected' ";
                   		}	
                   	$opcion = $opcion." >$nombreSector</option>"; 
              		echo $opcion;
                    $idxSector++;
                } 
            ?> 
                </select> 
        </td>
      </tr>
      <tr> 
        <td valign="middle" align="right" class="menu2_abm">Edificio&nbsp;&nbsp;</td>
        <td valign="top" > 
          <select name="edificio">
                  
            <? 
                
               while ($idxEdificio < $totalEdificio)	{
	
					$idEdificio = mysql_result($resEdificio, $idxEdificio,'id');
					$nombreEdificio = mysql_result($resEdificio, $idxEdificio,'nombre');

                    echo "<option value='$idEdificio'>$nombreEdificio</option>"; 
                    $idxEdificio++;
                } 
            ?> 
                </select> 
       </td>
      </tr>
      <tr> 
        <td valign="middle" align="right" class="menu2_abm">E-mail&nbsp;&nbsp;</td>
        <td valign="top" > 
          <input type="text" class="menu2_abm" name="email" size="30" maxlength="35" value="" onblur="this.value=Trim(this.value);">
        </td>
      </tr>
       <tr> 
        <td valign="middle" align="right" class="menu2_abm">Fecha de nacimiento&nbsp;&nbsp;</td> 
        <td valign="top" > 
          <input type="text" class="menu2_abm" name="fecha_nac" size="10" maxlength="10" value="" onblur="this.value=Trim(this.value);"> (YYYY-MM-DD)
        </td>
      </tr>
      <tr> 
        <td valign="middle" align="right" class="menu2_abm">Telefono&nbsp;&nbsp;</td>
        <td valign="top" > 
          <input type="text" class="menu2_abm" name="tel" size="30" maxlength="35" value="" onblur="this.value=Trim(this.value);">
        </td>
      </tr>
      <tr> 
        <td valign="middle" align="right" class="menu2_abm">Interno&nbsp;&nbsp;</td>
        <td valign="top" > 
          <input type="text" class="menu2_abm" name="interno" size="30" maxlength="35" value="" onblur="this.value=Trim(this.value);">
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

		if (form.elements['edificio'].value == "")	{
			form.elements['edificio'].focus();
			alert("Debe ingresar el edificio.");
			return false;
		}
		form.elements['sector'].value = form.elements['sector'].value.toLowerCase();
		if (form.elements['sector'].value == "")	{
			form.elements['sector'].focus();
			alert("Debe ingresar el sector.");
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
		$date = form.elements['fecha_nac'].value;

		if ($date == "")	{
			form.elements['fecha_nac'].focus();
			alert("Debe ingresar la fecha de nacimiento");
			return false;
		}
		
		form.submit();
		return true;
	}
	
	// s�lo en el caso de caracteres especiales
	document.forms['data'].elements['dni'].value = "<?=$dni?>";
	document.forms['data'].elements['nombre'].value = "<?=$nombre?>";
	document.forms['data'].elements['clave'].value = "<?=$clave?>";
	document.forms['data'].elements['apellido'].value = "<?=$apellido?>";
	document.forms['data'].elements['sector'].value = "<?=$sector?>";
	document.forms['data'].elements['edificio'].value = "<?=$edificio?>";
	document.forms['data'].elements['email'].value = "<?=$email?>";
	document.forms['data'].elements['fecha_nac'].value = "<?=$fecha_nac?>";
	document.forms['data'].elements['tel'].value = "<?=$tel?>";
	document.forms['data'].elements['interno'].value = "<?=$interno?>";

</script>
<?}?>


</body>
</html>



</body>
</html>



