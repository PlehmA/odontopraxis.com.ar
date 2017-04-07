<?
include ('lib.inc');
include ('checks.inc');


$here = "usuariosweb.php";
$accion = "LISTA";
$RED_FONT = "font-family: Arial, Helvetica, sans-serif; font-size: 11px; color: red";

if (isset($_GET['accion'])) 	{
	$accion=$_GET['accion'];
}


if (($accion != 'LISTA') &&
	($accion != 'ALTA') &&
	($accion != 'BAJA') &&
	($accion != 'MOD') &&
	($accion != 'ALTA_UPD') &&
	($accion != 'MOD_UPD') &&
	($accion != 'ACTIVOSI') &&
	($accion != 'ACTIVONO') &&
	($accion != 'PERMISONO') &&
	($accion != 'PERMISOSI')
	)	{
	?><META HTTP-EQUIV="Refresh" CONTENT="0; URL=<?=MAIN_PAGE?>"><?
	return;
	}

include ('conect.inc');


$TABLA = DB_PREFIX . "usuarios" ;


//////////////////////////////////////////////////////////////////////////////////////////

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
/////////////////////////////////////////////////////////////////////////////////////////


?>

<?

///////////////////////////////////////////////
// Alta de registro
if ($accion == 'ALTA_UPD')	{

	$url = $here;

	$nombre = addSlashes($_POST['nombre']);
	$clave = addSlashes($_POST['clave']);
	$apellido = addSlashes($_POST['apellido']);
	$sector = addSlashes($_POST['sector']);
	$edificio = addSlashes($_POST['edificio']);
	$email = addSlashes($_POST['email']);
	$nro_doc = addSlashes($_POST['nro_doc']);
	$fecha_nac = addSlashes($_POST['fecha_nac']);
	$tel = addSlashes($_POST['tel']);
	$interno = addSlashes($_POST['interno']);
	
		list($year, $month, $day)=explode("-",$fecha_nac);
//	print $month." ".$year." ".$day;

	if( (! is_numeric($day)) or (!is_numeric($month)) or (!is_numeric($year)) or (! checkdate($month,$day,$year)))
	{
		?>
		<body onload="document.forms['data'].submit();">
				<form name="data" action="usuariosweb.php?accion=ALTA" method="POST">
					<input type="hidden" name="error" value="La fecha de nacimiento es inexistente. Intente nuevamente">
					<input type="hidden" name="clave" value="<?=$clave?>">
					<input type="hidden" name="nombre" value="<?=$nombre?>">
					<input type="hidden" name="apellido" value="<?=$apellido?>">
					<input type="hidden" name="sector" value="<?=$sector?>">
					<input type="hidden" name="email" value="<?=$email?>">
					<input type="hidden" name="edificio" value="<?=$edificio?>">
					<input type="hidden" name="nro_doc" value="<?=$nro_doc?>">		
					<input type="hidden" name="tel" value="<?=$tel?>">
					<input type="hidden" name="interno" value="<?=$interno?>">
				</form>
		</body>		
			
		<?
		return;
	
	}
	
	$activo = 'N';
	$adm = 'N';
	
	//////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////
	// buscar ese mail de usuario

	$sql = "SELECT COUNT(*) AS cant FROM $TABLA WHERE nro_doc = '$nro_doc' or email = '$email'";
	//print $sql;
	$res = mysql_query($sql);
	$cant = mysql_result($res,0,'cant');
	mysql_free_result($res);
	
	if ($cant > 0)	// el usuario ya existe
	{
		$url = $url."?accion=ALTA&error=1";
		
	}else{
	
	//////////////////////////////////////////////////////////
	$sql = "SELECT MAX(id)+1 AS indexId FROM $TABLA";
//	print $sql;
	$res = mysql_query($sql);
	$indexId = mysql_result($res,0,'indexId');
	mysql_free_result($res);
	
	//////////////////////////////////////////////////////////
	
	$sql = "INSERT INTO $TABLA (id, fecha_reg, ";
	$sql.= 						" nombre, clave, apellido, ";
	$sql.= 						" sector, edificio, email, nro_doc, ";
	$sql.= 						" activo, adm, fecha_nac, tel, interno) ";
	$sql.= 				"VALUES ('$indexId', NOW(), ";
	$sql.= 						"'$nombre', '$clave', '$apellido', ";
	$sql.= 						"'$sector', '$edificio', '$email', '$nro_doc', ";
	$sql.=						"'$activo', '$adm', '$fecha_nac', '$tel', '$interno')";
//	print $sql;
	mysql_query($sql);
	
	}

	?><META HTTP-EQUIV="Refresh" CONTENT="0; URL=<?=$url?>"><?
	return;
}

///////////////////////////////////////////////
// Actualizaci�n de registro
if ($accion == 'MOD_UPD')	{

	$url = $here;
	$id=$_GET['id'];

	$nombre = addSlashes($_POST['nombre']);
	$clave = addSlashes($_POST['clave']);
	$apellido = addSlashes($_POST['apellido']);
	$sector = addSlashes($_POST['sector']);
	$edificio = addSlashes($_POST['edificio']);
	$email = addSlashes($_POST['email']);
	$nro_doc = addSlashes($_POST['nro_doc']);
	$activo = addSlashes($_POST['activo']);
	$adm = addSlashes($_POST['adm']);
	$fecha_nac = addSlashes($_POST['fecha_nac']);
	list($day, $month, $year)=explode("-",$fecha_nac);
	$fecha_nac = $year."-".$month."-".$day;
	$tel = addSlashes($_POST['tel']);
	$interno = addSlashes($_POST['interno']);
	
	if( (! is_numeric($day)) or (!is_numeric($month)) or (!is_numeric($year)) or (! checkdate($month,$day,$year)))
	{
		$here = $here."?accion=MOD&id=$id&error=2";
	
	}else{
	
		$sql = "UPDATE $TABLA SET ";
		$sql.=			" nombre='$nombre', clave='$clave', apellido='$apellido',";
		//$sql.=			" clave='$clave', nombreext='$nombreext',";
		$sql.=			" sector='$sector', edificio='$edificio',";
		$sql.=			" email='$email', nro_doc='$nro_doc', fecha_nac ='$fecha_nac', tel ='$tel', interno ='$interno' ";
		$sql.= " WHERE id='$id'";
	//	print "sql: $sql<br>";
		mysql_query($sql);
	/////////////////////////////
	}
	?>
	<META HTTP-EQUIV="Refresh" CONTENT="0; URL=<?=$here?>">
	<?
	return;
}




///////////////////////////////////////////////

if ($accion == 'ACTIVOSI')	{
	$id=$_GET['id'];
	$sql = "UPDATE $TABLA SET activo='S' WHERE id='$id'";
	mysql_query($sql);
	?>
<META HTTP-EQUIV="Refresh" CONTENT="0; URL=<?=$here?>">
<?
	return;
}

///////////////////////////////////////////////
// Setear publicado -> N
if ($accion == 'ACTIVONO')	{
	$id=$_GET['id'];
	$sql = "UPDATE $TABLA SET activo='N' WHERE id='$id'";
	mysql_query($sql);
	?>
<META HTTP-EQUIV="Refresh" CONTENT="0; URL=<?=$here?>">
<?
	return;
}


///////////////////////////////////////////////
// Setear publicado -> N
if ($accion == 'PERMISONO')	{
	$id=$_GET['id'];
	$sql = "UPDATE $TABLA SET adm='N' WHERE id='$id'";
	mysql_query($sql);
	?>
<META HTTP-EQUIV="Refresh" CONTENT="0; URL=<?=$here?>">
<?
	return;
}

///////////////////////////////////////////////

if ($accion == 'PERMISOSI')	{
	$id=$_GET['id'];
	$sql = "UPDATE $TABLA SET adm='S' WHERE id='$id'";
	mysql_query($sql);
	?>
<META HTTP-EQUIV="Refresh" CONTENT="0; URL=<?=$here?>">
<?
	return;
}







///////////////////////////////////////////////
// Actualizaci�n de registro
if (($accion == 'MOD') || ($accion == 'ALTA'))	{
	
	$id = "";
	$targetAction = "ALTA_UPD";
	$page_title = "Alta de Usuario-Web";
	$err = "";

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
	$fecha_nac = "";
	$tel = "";
	$interno = "";
	
	$backpage = "usuariosweb.php";

	if (isset($_POST['error'])) 	{
		$err="La fecha de nacimiento es inexistente. Intente nuevamente";
		$accion=addSlashes($_POST['accion']);
		$nombre = addSlashes($_POST['nombre']);
		$clave = addSlashes($_POST['clave']);
		$apellido = addSlashes($_POST['apellido']);
		$sector = addSlashes($_POST['sector']);
		$edificio = addSlashes($_POST['edificio']);
		$email = addSlashes($_POST['email']);
		$nro_doc = addSlashes($_POST['nro_doc']);
		$tel = addSlashes($_POST['tel']);
		$interno = addSlashes($_POST['interno']);
	}

	$error = $_GET['error'];
	if($error == 1){
		$err="Ya existe un usuario con el mismo email o nro de documento </br> Por favor intente nuevamente";
	}
	if($error == 2){
		$err="La fecha de nacimiento es inexistente. Intente nuevamente";
	}
	
	if ($accion == 'MOD')	{
		
		$id = $_GET['id'];
		$targetAction = "MOD_UPD";

		$sql="SELECT * FROM $TABLA WHERE id='$id'";
		$res = mysql_query($sql);
		if (mysql_num_rows($res) < 1) {
			mysql_free_result($res);
			?><META HTTP-EQUIV="Refresh" CONTENT="0; URL=usuariosweb.php"><?
			return;	
		}
		$page_title = "Edici&oacute;n de Usuario-Web";
		$backpage = "usuariosweb.php";

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
		$fecha_nac =  substr(mysql_result($res,0,'fecha_nac'),0,10);
		list($year, $month, $day)=explode("-",$fecha_nac);
		$fecha_nac = $day."-".$month."-".$year;
		$tel = mysql_result($res,0,'tel');
		$interno = mysql_result($res,0,'interno');
		
		mysql_free_result($res);
	}
	else if ($accion == 'ALTA')
	{
		$fecha_reg = date("d-m-Y  H:m:s");
		
		
	}
	else	{
		$fecha_reg = date("d-m-Y  H:m:s");
	}

	$resSector = mysql_query('SELECT id,nombre FROM sector');
	$totalSector = mysql_num_rows($resSector);
	$idxSector = 0;
               

	$resEdificio = mysql_query('SELECT id,nombre FROM edificio');
	$totalEdificio= mysql_num_rows($resEdificio);
	$idxEdificio = 0; 
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

<title><?=$page_title?></title>

<link rel="stylesheet" href="styles.css" type="text/css">
<script src="util/validations.js"></script>
</head>

<body bgcolor="#EBEBEB" link="#153579" vlink="#153579" alink="#153579" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
  <? include ('header.php');?>
<p align=center><b><font face="Arial, Helvetica, sans-serif" size="3"><?=$page_title?></b></p>


<br>
<?if ($err != ''){?><p align="center" class="menu2_abm"><font color="red">Error: <b><?=$err?></b></font></p><?}?>


 <form method="post" action="usuariosweb.php?accion=<?=$targetAction?>&id=<?=$id?>" name="data" enctype="multipart/form-data">
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
        <td valign="middle" align="right" class="menu2_abm">Contrase&ntilde;a&nbsp;&nbsp;</td>
        <td valign="top" > 
          <input type="text" class="menu2_abm" name="clave" size="30" maxlength="25" value="">
        </td>
      </tr>
      
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
        <td valign="top" align="right" class="menu2_abm">Fecha de nacimiento&nbsp;&nbsp;</td>
         <td valign="top" > 
          <input type="text" class="menu2_abm" name="fecha_nac" size="10" maxlength="10" value="" onblur="this.value=Trim(this.value);"> (DD-MM-AAAA)
        </td>
       
      </tr>
       <tr> 
        <td valign="middle" align="right" class="menu2_abm">Telefono&nbsp;&nbsp;</td>
        <td valign="top" > 
          <input type="text" class="menu2_abm" name="tel" size="30" maxlength="35" value="" onblur="this.value=Trim(this.value);">
        </td>
      </tr>
       <tr> 
        <td valign="middle" align="right" class="menu2_abm">Int&nbsp;&nbsp;</td>
        <td valign="top" > 
          <input type="text" class="menu2_abm" name="interno" size="30" maxlength="35" value="" onblur="this.value=Trim(this.value);">
        </td>
      </tr>
      <tr><td height="10"></td></tr>
   
     
      <tr><td height="10"></td></tr>
      <input type="hidden" name="activo" value="">
      <input type="hidden" name="adm" value="">
	  <tr bgcolor="#BCCCCC"><td colspan="3"></td></tr>
   
   </table>
 
  </form>
<br>
<p align=center>
	<input type="button" name="boton" value="Volver" onclick="location='<?=$backpage?>';" style="width:100px"/>
	&nbsp;&nbsp;&nbsp;
	<input type="button" name="boton2" value="Guardar" onclick="return verificar()" style="width:100px"/>
</p>


<br>
<br>

<script language="JavaScript">

	function verificar()	{

	//	alert("validando");
		
		var form = document.forms['data'];
		
		if (form.elements['nombre'].value == "")	{
			form.elements['nombre'].focus();
			alert("Debe ingresar el nombre.");
			return false;
		}
		/*
		if (form.elements['clave'].value != form.elements['clave_rep'].value)	{
			alert("La nueva contrase�a ingresada y su repetici�n no son iguales.");
			return false;
		}
		*/
		if (form.elements['apellido'].value == "")	{
			form.elements['apellido'].focus();
			alert("Debe ingresar el apellido.");
			return false;
		}
		if (form.elements['sector'].value == "")	{
			form.elements['sector'].focus();
			alert("Debe ingresar el sector.");
			return false;
		}
		if (form.elements['edificio'].value == "")	{
			form.elements['edificio'].focus();
			alert("Debe ingresar el edificio.");
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
		//alert("todo bien");
		form.submit();
		return true;
	}
	
	// s�lo en el caso de caracteres especiales
	document.forms['data'].elements['nombre'].value = "<?=$nombre?>";
	document.forms['data'].elements['clave'].value = "<?=$clave?>";
	document.forms['data'].elements['apellido'].value = "<?=$apellido?>";
	document.forms['data'].elements['email'].value = "<?=$email?>";
	document.forms['data'].elements['nro_doc'].value = "<?=$nro_doc?>";
	document.forms['data'].elements['sector'].value = "<?=$sector?>";
	document.forms['data'].elements['edificio'].value = "<?=$edificio?>";
	document.forms['data'].elements['activo'].value = "<?=$activo?>";
	document.forms['data'].elements['adm'].value = "<?=$adm?>";
	document.forms['data'].elements['fecha_nac'].value = "<?=$fecha_nac?>";
	document.forms['data'].elements['tel'].value = "<?=$tel?>";
	document.forms['data'].elements['interno'].value = "<?=$interno?>";
	
</script>

</body>
</html>

<?}?>





<?
if ($accion == "LISTA")	{

	$listHeaders = Array(
					Array("titulo" => "Registro", "campo" => "fecha_reg", "celdas" => "1"),
					Array("titulo" => "DNI", "campo" => "nro_doc", "celdas" => "1"),
					Array("titulo" => "Nombre", "campo" => "nombre", "celdas" => "1"),
					Array("titulo" => "Apellido", "campo" => "apellido", "celdas" => "1"),
					Array("titulo" => "Sector", "campo" => "sector", "celdas" => "1"),
					Array("titulo" => "Edificio", "campo" => "edificio", "celdas" => "1"),
					Array("titulo" => "mail", "campo" => "email", "celdas" => "1"),
					Array("titulo" => "Nacimiento", "campo" => "fecha_nac", "celdas" => "1"),
					Array("titulo" => "Telefono", "campo" => "tel", "celdas" => "1"),
					Array("titulo" => "interno", "campo" => "interno", "celdas" => "1")
				);
	//$orderby = (isset($_GET['orderby'])) ? $_GET['orderby'] : "nombre";
	//$order = (isset($_GET['order'])) ? $_GET['order'] : "0";

	$filtro_orderby = "0";	// Usuario
	if ((isset($_GET['orderby'])) && (is_numeric($_GET['orderby'])))
	{
		$orderby = $_GET['orderby'];
		if (($orderby >= 0) && ($orderby < sizeof($listHeaders)))
			$filtro_orderby = $orderby;
	}
	$filtro_order = "1";	//ASC
	if ((isset($_GET['order'])) && (is_numeric($_GET['order'])))
	{
		$order = $_GET['order'];
		if (($order == 0) || ($order == 1))
			$filtro_order = $order;
	}



?>

<html>
<head>
<title>Listado de usuarios registrados</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="styles.css" type="text/css">
</head>

<body bgcolor="#EBEBEB" link="#153579" vlink="#153579" alink="#153579" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
  <? include ('header.php');?>

<p align=center><b><font face="Arial, Helvetica, sans-serif" size="3">Listado de usuarios registrados</b></p>

<p align=center>
	<input type="button" name="boton" value="Nuevo usuario" onclick="location='usuariosweb.php?accion=ALTA';" style="width:150px"/>
	&nbsp;&nbsp;&nbsp;
	<input type="button" name="boton2" value="Menu" onclick="location='<?=MAIN_PAGE?>';" style="width:150px"/>
</p>

<div style=" width:980px; margin-left:152px;">
<table border="0" cellspacing="0" cellpadding="0" align="center">

		<tr bgcolor="#BCCCCC" height="25px">
		<?
			echo "<td></td>";
			echo "<td></td>";
			echo "<td></td>";
				for($i = 0; $i < sizeof($listHeaders); $i++)
			{
				echo "<td class=\"txt2_abm\"";
				echo " colspan=\"" . $listHeaders[$i]["celdas"] . "\"";
				if ($filtro_orderby == $i) echo " bgcolor=\"#5ecccc\"";
				echo " nowrap>";
				
				if ($filtro_orderby == $i)
				{
					echo "<table width=\"100%\"><tr>";
						echo "<td class=\"txt2_abm\" width=\"90%\" nowrap>";
						echo $listHeaders[$i]["titulo"];
						echo "</td>";
						
						echo "<td>";
						echo "&nbsp";
						if ($filtro_order == 0)	// ASC
							echo "<a href=\"javascript:ordenar('1')\" title=\"Ordenar descendente esta columna\"><img src=\"img/sort_dn.gif\"/ border=\"0\"></a>";
						else	// DESC
							echo "<a href=\"javascript:ordenar('0')\" title=\"Ordenar ascendente esta columna\"><img src=\"img/sort_up.gif\"/ border=\"0\"></a>";
						echo "</td>";
						
					echo "</tr></table>";
				}
				else
				{
					echo "<a href=\"javascript:ordenarCampo('" . $i . "')\" title=\"Ordenar por esta columna\">";
					echo $listHeaders[$i]["titulo"];
					echo "</a";
				}
				echo "</td>";
				echo "<td></td>";
			}
			?>

		<td>&nbsp;&nbsp;</td>
	    <td class="txt2_abm" nowrap colspan="2" align="center">Activo</td>
	    <td>&nbsp;</td>
	    <td class="txt2_abm" nowrap align="center">Activar</td>
	   <td>&nbsp;&nbsp;</td>
	    <td class="txt2_abm" nowrap colspan="2" align="center">Admin</td>
	   <td>&nbsp;</td>
	   <td class="txt2_abm" nowrap align="center">Permiso admin</td>
	   <td>&nbsp;</td>	
		</tr>

		<tr>
		    <td bgcolor="#CCCCCC" colspan="20" height="1"></td>
		</tr>

<?
	
	$sql = "SELECT * FROM $TABLA ";
//	$sql.= " ORDER BY fecha, id";

		$sql.= " ORDER BY " . $listHeaders[$filtro_orderby]["campo"] . ( ($filtro_order == 0)? " ASC" : " DESC" );

	/*
	if ($filtro_orderby != '')
	{
		$sql .= "ORDER BY " . $filtro_orderby . " " . (($filtro_order == '1') ? "ASC" : "DESC");
	}
	else
		$sql.= "ORDER BY id";
	*/

	//print $sql;

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
	$fecha_nac = substr(mysql_result($res, $idx,'fecha_nac'),0,10);	
	$tel = mysql_result($res, $idx,'tel');
	$interno = mysql_result($res, $idx,'interno');
	

?>
		<tr height="25">
		    <td class="txt_abm">&nbsp;</td>
		    <td nowrap>
		    	<img src="img/edit_icon.gif" style="cursor:hand" onclick="javascript:location='usuariosweb.php?accion=MOD&id=<?=$id?>'" alt="Editar">
		    </td>
		     <td class="txt_abm">&nbsp;&nbsp;&nbsp;</td>
		    
		    <td class="txt_abm" nowrap>
		    	<?=substr($fecha_reg,0,10)?>
		    </td>
		    <td class="txt_abm">&nbsp;&nbsp;</td>
		    <td class="txt_abm" >
		    	<?=$nro_doc?>
		    </td>
		    <td class="txt_abm">&nbsp;&nbsp;</td>
		    
		    <td class="txt_abm" >
		    	<?=$nombre?>
		    </td>
		    <td class="txt_abm">&nbsp;&nbsp;</td>
		    <td class="txt_abm">
		    	<?=$apellido?>
		    </td>
		    <td class="txt_abm">&nbsp;&nbsp;</td>
		     
		    <td class="txt_abm">
		    	<?=stripslashes($sector)?>
		    </td>
		    <td class="txt_abm">&nbsp;&nbsp;</td>

 			<td class="txt_abm">
		    	<?=stripslashes($edificio)?>
		    </td>
		    <td class="txt_abm">&nbsp;&nbsp;</td>

		    <td class="txt_abm" >
		    	<?=$email?>
		    </td>
		    <td class="txt_abm">&nbsp;&nbsp;</td>
		     <td class="txt_abm" nowrap>
		    	<?=$fecha_nac?>
		    </td>
		     <td class="txt_abm">&nbsp;&nbsp;</td>
		     <td class="txt_abm" nowrap>
		    	<?=$tel?>
		    </td>
		     <td class="txt_abm">&nbsp;&nbsp;</td>
		     <td class="txt_abm" nowrap>
		    	<?=$interno?>
		    </td>
		    <td class="txt_abm">&nbsp;&nbsp;</td>
		   
			<td class="txt_abm">&nbsp;&nbsp;</td>
		    <td class="txt_abm" align="center">
		    	<?if ($activo == 'S') {?>SI<?}else{?>No<?}?>
		    </td>
		    <td class="txt_abm">&nbsp;&nbsp;</td>
			<td class="txt_abm">&nbsp;&nbsp;</td>
		    <td class="txt_abm" align="center">
		    	&nbsp;&nbsp;
		    	<?if ($activo == 'S') {?>
		    		<input type="button" class="boton" name="pub1" value="Desactivar" onclick="location='<?=$here?>?accion=ACTIVONO&id=<?=$id?>'" style="height:17px">
		    	<?}else{?>
		    		<input type="button" class="boton" name="pub2" value="Activar"  onclick="location='<?=$here?>?accion=ACTIVOSI&id=<?=$id?>'" style="height:17px">
		    	<?}?>
		    </td>
			<td class="txt_abm">&nbsp;&nbsp;</td>
			<td class="txt_abm">&nbsp;&nbsp;</td>
 			<td class="txt_abm" align="center">
		    	<?if ($adm == 'S') {?>SI<?}else{?>No<?}?>
		    </td>
		    <td class="txt_abm">&nbsp;&nbsp;</td>
		    <td class="txt_abm" align="center">
		    	&nbsp;&nbsp;
		    	<?if ($adm == 'S') {?>
		    		<input type="button" class="boton" name="pub1" value="Revocar" onclick="location='<?=$here?>?accion=PERMISONO&id=<?=$id?>'" style="height:17px">
		    	<?}else{?>
		    		<input type="button" class="boton" name="pub2" value="Dar Permiso"  onclick="location='<?=$here?>?accion=PERMISOSI&id=<?=$id?>'" style="height:17px">
		    	<?}?>
		    </td>


		

		    <td class="txt_abm">&nbsp;&nbsp;</td>
		  
		</tr>
		<tr>
		    <td bgcolor="#CCCCCC" colspan="20" height="1"></td>
		</tr>
<?
		$idx++;
	}
	mysql_free_result($res);
?>

</table>
</div>


<script language="Javascript">
	function ordenarCampo(param)
	{
		window.location = "usuariosweb.php?orderby=" + param + "&rnd=" + Math.random();
	}
	function ordenar(param)
	{
		window.location = "usuariosweb.php?orderby=<?=$filtro_orderby?>&order=" + param + "&rnd=" + Math.random();
	}
	function borrar(id)	{
		var conf = confirm("�Est� seguro que desea eliminar el usuario?");
		if (conf)	{
			window.location="usuariosweb.php?accion=BAJA&id="+id;
		}
	}
</script>

<br>
<br>
<p align=center>
	<input type="button" name="boton" value="Nuevo usuario" onclick="location='usuariosweb.php?accion=ALTA';" style="width:150px"/>
	&nbsp;&nbsp;&nbsp;
	<input type="button" name="boton2" value="Menu" onclick="location='<?=MAIN_PAGE?>';" style="width:150px"/>
</p>
<br>
</body>
</html>
<?
}

////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////

?>


