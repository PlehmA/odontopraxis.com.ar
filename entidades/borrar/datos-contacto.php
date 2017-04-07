<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

    <html xmlns="http://www.w3.org/1999/xhtml">
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        

<link href="css/style3.css" rel="stylesheet" type="text/css" media="all" />
<title>Odontopraxis Americana s.a.</title>
<style type="text/css">
a:link {
	color: #036;
}
a:visited {
	color: #036;
}
a:hover {
	color: #036;
}
a:active {
	color: #036;
}
</style>
    </head>

<body>
<div class="header" id="header">
  <p><img src="img/logo.png" width="342" height="104" /><br />
  Bienvenidos al sistema  de Utilidades de Odontopraxis Americana</p>
  <div class="titulo-sector-autogestion" id="titulo-sector-autogestion">
    <p>Formulario para la actualización de datos de contacto</p>
  </div>
</div>
<br />
<div class="wrap2" id="wrap2">
  <div class="col-iz2" id="col-iz2">
    <div class="menu-iz2" id="menu-iz2">
      <div class="titulos-autogestion" id="titulos-autogestion"><strong>Perfil</strong></div>
      PRESTADOR: XXXXXX XXXX<br />
      CUIT: XXXXXXXXXX<br />
      e-Mail: XXXXXXXXXXXXXXXXXXXXXXXX<br />
      <br />
      <div class="titulo-autogestion2" id="titulo-autogestion2">UTILIDADES</div>
      <p>&gt;<a href="actualizar-datos.php"> Actualizar datos personales</a></p>
      <p>&gt; <a href="abm-consultorio.php">Actualizar  consultorio</a><a href="datos-contacto.php"></a></p>
      <p>&gt; <a href="abm-impositivos.php">Actualizar datos impositivos</a><a href="datos-contacto.php"></a></p>
      <p>&gt; <a href="comprobantes-vencimiento.php">Envío del Registro Nacional de Prestador de la SSS</a><a href="form-malapraxis.php"></a></p>
      <p>&gt; <a href="comprobantes-vencimiento-m-praxis.php">Envío de Cobertura Resp. Civil (Mala Praxis)</a><a href="form-malapraxis.php"></a></p>
      <p>&gt; <a href="alta-staff.php">Alta de staff</a><a href="form-malapraxis.php"></a></p>
      <div class="titulo-autogestion2" id="titulo-autogestion3"> NOVEDADES </div>
      <p>&gt; <a href="novedades.php">Novedades</a></p>
      <p><a href="novedades.html"><br />
      </a></p>
      <tr>
        <td valign="top" bgcolor="#FFFFFF"><input type="button" value="Salir" onclick="location='index.php?g=1'" style="width:80px" /></td>
      </tr>
    </div>
    </td>
    </tr>
  </div>
</div>
</div>
</div>


<!--**************************************************-->


<div class="wrap2" id="wrap2">
<?php
if (!isset($_POST['email'])) {
?>
</p>
<form action="<?=$_SERVER['PHP_SELF']?>" method="post">




<div class="mod-contacto1" id="mod-contacto1">Apellido / Razón social:
  <input name="apellido-razon" type="text" id="apellido-razon" />  </div>
  
  <div class="mod-contacto1" id="mod-contacto1">Nombre:
  <input name="nombre" type="text" id="nombre" />  </div>
  
    <div class="mod-contacto1" id="mod-contacto1">Teléfono:
  <input name="tel" type="text" id="tel" />  </div>
  

  <div class="mod-contacto1" id="mod-contacto1">Tipo de documento:
  <input name="tipodoc" type="text" id="tipodoc" />  </div>

  <div class="mod-contacto1" id="mod-contacto1">Número de documento:
  <input name="numerodoc" type="text" id="numerodoc" />  </div>
  
    <div class="mod-contacto1" id="mod-contacto1">E-mail:
  <input name="email" type="text" id="email" />  </div>
  
  
      <div class="mod-contacto1" id="mod-contacto1">Domicilio Av./Calle:
  <input name="domicilio" type="text" id="domicilio" />  </div>
  
  
      <div class="mod-contacto1" id="mod-contacto1">Código postal:  
        <input name="cp" type="text" id="cp" />  </div>
  
        <div class="mod-contacto1" id="mod-contacto1">Localidad / Barrio:      
  <input name="loc-barrio" type="text" id="loc-barrio" />  </div>
  
        <div class="mod-contacto1" id="mod-contacto1">Provincia:  
  <input name="provincia" type="text" id="provincia" />  </div>
  
  


<div class="mod-contacto1" id="mod-contacto1">
Observaciones:</br>
<textarea name="observaciones" cols="25" rows="6" class="textogeneral" id="observaciones"></textarea></div>




<div class="mod-contacto1" id="mod-contacto1">
<input type="reset" value="Borrar" /> 
<input type="submit" onclick="MM_validateForm('nombre','','R','tipodoc','','R','numerodoc','','email','','RisEmail');return document.MM_returnValue" value="Enviar" />
    </div>
  
 
</form>
<?php
}else{
  $mensaje="WEB modificacion de datos de particulares\n";
  $mensaje.= "\nApellido Razón social: ". $_POST['apellido-razon'];
  $mensaje.= "\nNombre: ". $_POST['nombre'];
  $mensaje.= "\nTeléfono: ". $_POST['tel'];
  $mensaje.= "\nTipo de documento: ". $_POST['tipodoc'];
  $mensaje.= "\nNro. Documento: ". $_POST['numerodoc'];
  $mensaje.= "\nEmail: ". $_POST['email'];
  $mensaje.= "\nDomicilio: ". $_POST['domicilio'];
  $mensaje.= "\nCod. postal: ". $_POST['cp'];
  $mensaje.= "\nLocalidad / Barrio: ". $_POST['loc-barrio'];
  $mensaje.= "\nProvincia: ". $_POST['provincia'];
  $mensaje.= "\nObservaciones: ". $_POST['observaciones'];
  
  $destino= "profesionales@odontopraxis.com.ar";
  $remitente = $_POST['email'];
  $asunto = "WEB - Mod datos particulares Enviado por: ".$_POST['nombre'];
  mail($destino,$asunto,$mensaje,"FROM: $remitente");
  


?>



  <div class="titulo-sector-autogestion" id="titulo-sector-autogestion">
    <p>Mensaje enviado.</p>
  </div>
  
  
  <?php
}
?>
</p>


<!--**************************************************-->

<br />
<br />
<br />
<br />
<div class="pie" id="pie">Odontopraxis Americana 2014® Todos los derechos reservados  diseño Sendero </div>
</body>
    </html>

