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
    <p align="center">Formulario para la solicitud de cartilla<br />
  </p></div>
</div>
<br />
<div class="wrap2" id="wrap2">
  <div class="col-iz2" id="col-iz2">
    <div class="menu-iz2" id="menu-iz2">
      <div class="titulos-autogestion" id="titulos-autogestion"><strong>Gestión online</strong></div>
      <div class="titulo-autogestion2" id="titulo-autogestion2">UTILIDADES </div>
      <div class="inhibido" id="inhibido">&gt; Solicitud de cartilla </div>
      <p>&gt; <a href="datos-contacto.php">Actualizar datos de contacto</a></p>
      <p>&gt; <a href="form-malapraxis.php">Envío de seguros de mala praxis</a></p>
      <div class="titulo-autogestion2" id="titulo-autogestion3"> NOVEDADES </div>
      <p>&gt; <a href="novedades.php">Novedades</a></p>
      <p><a href="novedades.html"><br />
        </a><br />
      </p>
      <td valign="top" bgcolor="#FFFFFF"><br />
        <input type="button" value="Salir" onclick="location='index.php?g=1'" style="width:80px" /></td>
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


<div class="mod-contacto1" id="mod-contacto1">
Tipo de informe:
<input type="radio" name="tipo-informe" value="ALTA" id="alta" />
ALTA&nbsp; &nbsp; </span>
<input type="radio" name="tipo-informe" value="BAJA" id="baja" />
BAJA</span>
&nbsp; 
&nbsp; 
<input type="radio" name="tipo-informe" value="Modificación" id="modificacion" />
MODIFICACIÓN</span></div>




<div class="mod-contacto1" id="mod-contacto1">Domicilio del consultorio, Avenida / calle:
  <input name="domicilio" type="text" id="domicilio" />  </div>

      <div class="mod-contacto1" id="mod-contacto1">Número / Piso:
        <input name="numero-piso" type="text" id="numero-piso" />  
  </div>
  
  <div class="mod-contacto1" id="mod-contacto1">
E-mail:<input name="email" type="text" id="email" /></div>
  
        <div class="mod-contacto1" id="mod-contacto1">Prestador:
        <input name="entidad" type="text" id="entidad" />  
  </div>
  
          <div class="mod-contacto1" id="mod-contacto1">Teléfono:
        <input name="tel" type="text" id="tel" />  
  </div>
  
  
  
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
<input type="submit" onclick="MM_validateForm('domicilio','','R','tipo-informe','','R');return document.MM_returnValue" value="Enviar" />


    
    <br />
    <br />
    En breve personal de la Empresa se comunicará con Ud.,<br />
    a
      fin de formalizar la modificación por Ud. Solicitada.<br />
    
  

  
  </div>
  
  

  
  
  

 
</form>
<?php
}else{
  $mensaje="WEB ABM de consultorios\n";
  $mensaje.= "\nTipo de informe: ". $_POST['tipo-informe'];
  $mensaje.= "\nPrestador: ". $_POST['entidad'];
  $mensaje.= "\nTeléfono: ". $_POST['tel'];
  $mensaje.= "\nDomicilio, avenida o calle: ". $_POST['domicilio'];
  $mensaje.= "\nNúmero-piso: ". $_POST['numero-piso'];
  $mensaje.= "\nCod. postal: ". $_POST['cp'];
  $mensaje.= "\nLocalidad-Barrio: ". $_POST['loc-barrio'];
  $mensaje.= "\nProvincia: ". $_POST['provincia'];
  $mensaje.= "\nObservaciones: ". $_POST['observaciones'];
  
  $destino= "profesionales@odontopraxis.com.ar";
  $remitente = $_POST['email'];
  $asunto = "WEB - ABM consultorios - Enviado por: ".$_POST['entidad'];
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

