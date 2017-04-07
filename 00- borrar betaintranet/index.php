<?
session_start();
session_unset();
session_destroy();
include ('lib.php');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title><?=TITLE?> | Intranet </title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="indexStyles.css" type="text/css">
</head>
<body bgcolor="#EBEBEB" link="#153579" vlink="#153579" alink="#153579" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
  <? include ('header2.php');?>
<p align=center><b><font face="Arial, Helvetica, sans-serif" size="3">Ingreso a la Intranet</b></p>
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
    
     <input type="button" name="boton" value="Nuevo usuario" onclick="location='registro.php?accion=ALTA';" style="width:90px"/>
  </p>
  <div style="margin: 0 auto; width: 180px;"><a href="olvidoPass.php">Olvidé mi contraseña</a></div>
</form>
</body>
</html>