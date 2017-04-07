<?
include ('lib.inc');
include ('checks.inc');
?>
<html>
<head>
<title><?=TITLE?> | Administraci&oacuten de Contenidos</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="styles.css" type="text/css">
</head>
<body bgcolor="#EBEBEB" link="#153579" vlink="#153579" alink="#153579" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<? include ('header.php');?>
<p align=center><b><font face="Arial, Helvetica, sans-serif" size="3">Men&uacute Principal</b></p>


<table width="50%" border="0" cellspacing="0" cellpadding="0" align="center">
  <!--<tr height="30px"> 
    <td width="100%" class="txt2_abm" colspan="3" bgcolor="#153579"><font color="#FFFFFF"><b><font color="#FFFFFF">&nbsp;</font>Administraci&oacuten interna</b></font></td>
  </tr>
  <tr height="20px"> 
    <td align="center" class="menu2_abm" colspan="3"> <a href="usuarios.php">Cambio 
      de contraseñas</a> </td>
  </tr>-->
  <tr height="20"> 
    <td></td>
  </tr>
  <tr height="30px"> 
    <td width="100%" class="txt2_abm" colspan="3" bgcolor="#153579"><font color="#FFFFFF"><b><font color="#FFFFFF">&nbsp;</font>Administraci&oacuten 
      de Contenidos</b></font></td>
  </tr>
  <tr height="20px"> 
    <td align="center" class="menu2_abm" width="200"> <a href="noticias.php">Noticias </a> </td>
    <td align="center" class="menu2_abm" width="10">&nbsp; </td>
    <!--<td align="center" class="menu2_abm" width="200"> <a href="prensa.php">Prensa 
      espa&ntilde;ol</a> | <a href="prensa_ing.php">Prensa ingl&eacute;s</a> </td>-->
  </tr>
   <tr height="20px"> 
    <td align="center" class="menu2_abm" width="200"> <a href="usuariosweb.php">Usuarios </a> </td>
    <td align="center" class="menu2_abm" width="10">&nbsp; </td>
    </tr>
    <tr height="20px"> 
    <td align="center" class="menu2_abm" width="200"> <a href="abmTelefonosUtiles.php">Tel&eacutefonos &uacutetiles </a> </td>
    <td align="center" class="menu2_abm" width="10">&nbsp; </td>
    </tr>
     <tr height="20px"> 
    <td align="center" class="menu2_abm" width="200"> <a href="abmLinks.php">Links </a> </td>
    <td align="center" class="menu2_abm" width="10">&nbsp; </td>
    </tr>
     <tr height="20px"> 
    <td align="center" class="menu2_abm" width="200"> <a href="carpetas.php">Carpetas </a> </td>
    <td align="center" class="menu2_abm" width="10">&nbsp; </td>
    </tr>
     <tr height="20px"> 
    <td align="center" class="menu2_abm" width="200"> <a href="archivos.php">Archivos </a> </td>
    <td align="center" class="menu2_abm" width="10">&nbsp; </td>
    </tr>

  <tr height="20"> 
    <td></td>
  </tr>
  <tr height="20"> 
    <td></td>
  </tr>
  <tr height="2px"> 
    <td colspan="3" bgcolor="#153579"></td>
  </tr>
  <tr height="10"> 
    <td></td>
  </tr>
</table>
  <p align="center">
    <input type="button" value="Salir" onclick="location='<?=LOGIN_PAGE?>'" style="width:150px">
  </p>
  <br>
</body>
</html>