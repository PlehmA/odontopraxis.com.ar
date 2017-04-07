<?
session_start();
session_unset();
session_destroy();
include ('lib.inc');
?>

<html>
<head>
<title><?=TITLE?> | Administración de Contenidos</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="styles.css" type="text/css">
</head>
<body bgcolor="#EBEBEB" link="#153579" vlink="#153579" alink="#153579" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
  <? include ('header.php');?>
<p align=center><b><font face="Arial, Helvetica, sans-serif" size="3">Ingreso a la Administración de Contenidos</b></p>
  <br>
<form  method="POST" action="validar.php">
  <table border="0" cellspacing="0" cellpadding="0" align="center">
    <tr> 
      <td align="right" class="menu2_abm">Nro Documento</td>
      <td>&nbsp;&nbsp;</td>
      <td> 
        <input type="text" class="menu2_abm" name="usuario">
      </td>
    </tr>
    <tr> 
      <td align="right" class="menu2_abm">Contraseña</td>
      <td></td>
      <td> 
        <input type="password" class="menu2_abm" name="password">
      </td>
    </tr>
  </table>
  <p align="center">
    <input type="submit" value=" Aceptar " >
    &nbsp;&nbsp;&nbsp;
    <input type="button" value="    Salir    "  onclick="location='..'">
  </p>
</form>
</body>
</html>