<?

include ('lib.inc');
include ('checks.inc');


$accion="LISTA";
if (isset($_GET['accion'])) 	{
	$accion=$_GET['accion'];
}

if (($accion != 'LISTA') &&
	($accion != 'MOD') &&
	($accion != 'MOD_UPD')
	)	{
	?><META HTTP-EQUIV="Refresh" CONTENT="0; URL=<?=MAIN_PAGE?>"><?
	return;
}



// verificar id para los casos necesarios
if (($accion != 'LISTA') &&
	(!isset($_GET['id'])))	{
	?><META HTTP-EQUIV="Refresh" CONTENT="0; URL=<?=MAIN_PAGE?>"><?
	return;
}

include ('conect.inc');



///////////////////////////////////////////////
// Actualización de registro
if ($accion == 'MOD_UPD')	{
	$id=$_GET['id'];

	$clave_actual=$_POST['clave_actual'];
	$clave=$_POST['clave'];
	
	/////////////////////////////
	
	$sql = "SELECT * from " . DB_PREFIX . "usuarios where clave='$clave_actual' and id='$id'";
	$res=mysql_query($sql);
	if (mysql_num_rows($res)<1) {	// clave actual incorrecta
		mysql_free_result($res);
		?><META HTTP-EQUIV="Refresh" CONTENT="0; URL=usuarios.php?accion=MOD&id=<?=$id?>&res=ERROR"><?
		return;	
	}
	
	$sql = "update " . DB_PREFIX . "usuarios set clave='$clave' where id='$id'";
	mysql_query($sql);

	?><META HTTP-EQUIV="Refresh" CONTENT="0; URL=usuarios.php?accion=MOD&id=<?=$id?>&res=OK"><?
	return;
}


///////////////////////////////////////////////
// Actualización de registro
if ($accion == 'MOD')	{
	
	$id=$_GET['id'];
	$targetAction="MOD_UPD";

	$sql="select * from " . DB_PREFIX . "usuarios where id='$id'";
	$res=mysql_query($sql);
	if (mysql_num_rows($res)<1) {
		mysql_free_result($res);
		?><META HTTP-EQUIV="Refresh" CONTENT="0; URL=<?=MAIN_PAGE?>"><?
		return;	
	}
	$page_title = "Cambio de Contraseña";
	
	$usuario = mysql_result($res,0,'usuario');
	$clave = mysql_result($res,0,'clave');
	$adm = mysql_result($res,0,'adm');
	
	mysql_free_result($res);
		
?>
<html>
<head>
<title><?=$page_title?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="styles.css" type="text/css">
<script src="util/validations.js"></script>
</head>

<body bgcolor="#EBEBEB" link="#153579" vlink="#153579" alink="#153579" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
  <? include ('header.php');?>
<p align=center><b><font face="Arial, Helvetica, sans-serif" size="3"><?=$page_title?></b></p>

 <form method="post" action="usuarios.php?accion=<?=$targetAction?>&id=<?=$id?>" name="data" enctype="multipart/form-data">
 <input type="hidden" name="id" value="<?=$id?>">
 
   <table border="0" cellspacing="0" cellpadding="0" align="center">
      <tr> 
        <td valign="top" align="right" class="menu2_abm">Nombre de usuario&nbsp;&nbsp;</td>
        <td valign="top" class="menu2_abm"><b><?=$usuario?><b></td>
      </tr>
      <tr><td height="10"></td></tr>
      <tr> 
        <td valign="top" align="right" class="menu2_abm" nowrap>Tipo de usuario&nbsp;&nbsp;</td>
        <td valign="top" class="menu2_abm">
	    	<?if ($adm == 'S')	{?>
	    	Usuario para acceso al<br>Administrador de Contenidos
	    	<?}else{?>
	    	Otro tipo de usuario
	    	<?}?>
        </td>
      </tr>
      <tr><td height="15"></td></tr>

      <tr> 
        <td valign="middle" align="right" class="menu2_abm">Contraseña actual&nbsp;&nbsp;</td>
        <td valign="top" > 
          <input type="password" class="menu2_abm" name="clave_actual" size="30" maxlength="25" value="">
        </td>
      </tr>
      <tr><td height="10"></td></tr>
      <tr> 
        <td valign="middle" align="right" class="menu2_abm">Nueva contraseña&nbsp;&nbsp;</td>
        <td valign="top" > 
          <input type="password" class="menu2_abm" name="clave" size="30" maxlength="25" value="">
        </td>
      </tr>
      <tr> 
        <td valign="middle" align="right" class="menu2_abm">Repetición de contraseña&nbsp;&nbsp;</td>
        <td valign="top" > 
          <input type="password" class="menu2_abm" name="clave_rep" size="30" maxlength="25" value="">
        </td>
      </tr>
      <tr><td height="10"></td></tr>

	<?if (isset($_GET['res']))	{?>
      <tr> 
        <td valign="top" align="center" colspan="2">
        	<b><font face="Arial, Helvetica, sans-serif" size="3" color="red">
        	<?if ($_GET['res'] == 'OK')	{?>
        		Se ha cambiado la contraseña.
        	<?}?>
        	<?if ($_GET['res'] == 'ERROR')	{?>
        		La contraseña actual es incorrecta.<br>No se cambió la contraseña.
        	<?}?>
        	</font></b>
        </td>
      </tr>
      <tr><td height="10"></td></tr>

	<?}?>

      
    </table>
  </form>

<p align=center>
	<input type="button" name="boton" value="Volver" onclick="location='usuarios.php';" style="width:150px"/>
	&nbsp;&nbsp;&nbsp;
	<input type="button" name="boton" value="Cambiar contraseña" onclick="return verificar()" style="width:150px"/>
</p>


<br>
<br>
<script language="JavaScript">

	function verificar()	{
		var form = document.forms['data'];

		if (form.elements['clave'].value != form.elements['clave_rep'].value)	{
			alert("La nueva contraseña ingresada y su repetición son diferentes.");
			return false;
		}
		
		form.submit();
		return true;
	}
</script>

</body>
</html>

<?}?>

<?
///////////////////////////////////////////////
// Listaaaaaa
if ($accion == 'LISTA')	{
?>
<html>
<head>
<title>Listado de Usuarios</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="styles.css" type="text/css">
</head>

<body bgcolor="#EBEBEB" link="#153579" vlink="#153579" alink="#153579" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
  <? include ('header.php');?>
<p align=center><b><font face="Arial, Helvetica, sans-serif" size="3">Listado de usuarios</b></p>

<br>
<table width="80%" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr bgcolor="#BCCCCC"> 
    <td class="txt2_abm">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td class="txt2_abm">&nbsp;&nbsp;</td>
    <td class="txt2_abm">Nombre de usuario</td>
    <td class="txt2_abm">&nbsp;&nbsp;</td>
    <td class="txt2_abm" nowrap>Tipo de usuario</td>
  </tr>
 <tr bgcolor="#BCCCCC">
 	<td colspan="5"></td>
 </tr>
 
<?
$sql="select * from " . DB_PREFIX . "usuarios order by usuario";
$res=mysql_query($sql);
$total=mysql_num_rows($res);
$i=0;
while ($i < $total)	{
?>
<tr>
    <td class="txt_abm" valign="middle" height="25">
    	<img src="img/icon_password_required.gif" class="menu_abm" style="cursor:hand" onclick="javascript:location='usuarios.php?accion=MOD&id=<?=mysql_result($res,$i,'id')?>'" alt="Cambiar contraseña">
    </td>
    <td class="txt_abm">&nbsp;&nbsp;</td>
    <td class="txt_abm">
    	<?=mysql_result($res,$i,'usuario')?>
    </td>
    <td class="txt_abm">&nbsp;&nbsp;</td>
    <td class="txt_abm">
    	<?if (mysql_result($res,$i,'adm') == 'S')	{?>
    	Usuario para acceso al Administrador de Contenidos
    	<?}else{?>
    	Otro tipo de usuario
    	<?}?>
    </td>
</tr>
  <tr bgcolor="#CCCCCC">
    <td colspan="9"><img src="../../img/pixel.gif" width="1" height="1"></td>
  </tr>
<?
$i++;
}
mysql_free_result($res);
?>
</table>

<br>
<br>
<p align=center>
	<input type="button" name="boton" value="Menú" onclick="location='<?=MAIN_PAGE?>';" style="width:150px"/>
</p>

<?}?>

