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
  Bienvenidos al sistema de autogestión de Odontopraxis Americana</p>
  <div class="titulo-sector-autogestion" id="titulo-sector-autogestion">
    <p>Modificación de  datos  personales<br />
      Por favor  complete solo los datos a ampliar / modificar.</p>
  </div>
</div>
<br />
<div class="wrap2" id="wrap2">


  <div class="col-iz2" id="col-iz2">
    <div class="menu-iz2" id="menu-iz2">
      <div class="titulos-autogestion" id="titulos-autogestion"><strong>Gestión online</strong></div>
      <div class="titulo-autogestion2" id="titulo-autogestion2">UTILIDADES</div>
      <p>&gt; <a href="http://200.68.69.229:8080/PREPAGA/pages/login.faces" target="blank">Validación / Carga de  Prestaciones</a></p>
      <p>&gt; <a href="entidades-home.php">Consulta de liquidación</a></p>
      <p>&gt; <a href="resumen-liquidacion.php">Resúmen de liquidación</a></p>
      <div class="titulo-autogestion2" id="titulo-autogestion">SOLICITUDES</div>
      <div class="inhibido" id="inhibido">&gt;Actualizar Datos Personales</div>
      <p>&gt; <a href="abm-consultorio.php">ABM de consultorio</a><a href="datos-contacto.php"></a></p>
      <p>&gt; <a href="abm-impositivos.php">ABM datos impositivos</a><a href="datos-contacto.php"></a></p>
      <p>&gt; <a href="comprobantes-vencimiento.php">Comprobantes con vencimientos</a><a href="form-malapraxis.php"></a></p>
      <div class="titulo-autogestion2" id="titulo-autogestion3"> NOVEDADES </div>
      <p>&gt; <a href="novedades.php">Novedades</a></p>
      <p><a href="novedades.html">
        </a>
      </p>
      
                <tr>
   <td valign="top" bgcolor="#FFFFFF"><br />
    <input type="button" value="Salir" onclick="location='index.php?g=1'" style="width:80px"></div></td>
   </tr>
   
    </div>
    </td>
    </tr>
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




<div class="mod-contacto1" id="mod-contacto1">Apellido,  Nombre / Razón Social
  :  xxxxxxxxxxxxxxxxxxxxxxxxx </div>
  
  
    <div class="mod-contacto1" id="mod-contacto1">Teléfono particular:
      <input name="tel" type="text" id="tel" />  </div>
  

  <div class="mod-contacto1" id="mod-contacto1">Teléfono celular:
    <input name="tipodoc" type="text" id="tipodoc" />  </div>

  <div class="mod-contacto1" id="mod-contacto1">Número de documento:
  <input name="numerodoc" type="text" id="numerodoc" />  </div>
  
    <div class="mod-contacto1" id="mod-contacto1">C.U.I.T.:   xxxxxxxxxxxxxxxxxx   </div>
  
  <div class="mod-contacto1" id="mod-contacto1">e-mail:
  <input name="email" type="text" id="email" />  </div>
 
 
       <div class="mod-contacto1" id="mod-contacto1">Domicilio Particular Av./Calle:  
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

      <div class="mod-contacto1" id="mod-contacto1">Fecha de actualización:  
        <?
 echo date("G:H:s");
 ?> </div>
 
 <div class="mod-contacto1" id="mod-contacto1">NOTA: La información estará sujeta a verificación y aceptación por parte de Odontopraxis Americana.</div>
 
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

