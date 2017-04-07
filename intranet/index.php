<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="css-d/style.css" type="text/css">
<title>INTRANET - Odontopraxis Americana</title>


</head>

<body>
<div class="logo-ingreso" id="logo-ingreso"><img src="logo.png" alt="logo-odontopraxis" width="354" height="112" /></div>

<div class="texto-ingreso" id="texto-ingreso">Bienvenidos a la <strong> INTRANET</strong> de Odontopraxis</div>

<div class="banner-ingreso" id="banner-ingreso"><img src="img-d/banner1.jpg" width="100%" />
</div><br />

<form  method="POST" action="validar.php">
  <table width="304" border="0" align="center" cellpadding="0" cellspacing="5">
    <tr> 
      <td align="right" class="tex-form-ingreso">Nro Documento:</td>
      <td width="166"> 
        <input type="text" class="menu2_abm" name="usuario">
      </td>
    </tr>
    <tr> 
      <td align="right" class="tex-form-ingreso">Contraseña:</td>
      <td> 
        <input type="password" class="menu2_abm" name="password">
      </td>
    </tr>
  </table>
  <p align="center">
    <input type="submit" value=" Aceptar " >
    &nbsp;&nbsp;&nbsp;
    
    <input type="button" name="boton" value="Nuevo usuario" onclick="location='registro.php?accion=ALTA';" style="width:120px"/>
  </p>
  <div class="centrado">
  <a href="olvidoPass.php" class="tex-form-ingreso">Olvidé mi contraseña</a></div>
</form>


</body>
</html>
