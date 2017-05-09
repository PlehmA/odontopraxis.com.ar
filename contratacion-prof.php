<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

    <html xmlns="http://www.w3.org/1999/xhtml">
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        

<link href="web/css/style5.css" rel="stylesheet" type="text/css" media="all" />
<title>Odontopraxis Americana s.a.</title>
<script type="text/javascript">
function MM_validateForm() { //v4.0
  if (document.getElementById){
    var i,p,q,nm,test,num,min,max,errors='',args=MM_validateForm.arguments;
    for (i=0; i<(args.length-2); i+=3) { test=args[i+2]; val=document.getElementById(args[i]);
      if (val) { nm=val.name; if ((val=val.value)!="") {
        if (test.indexOf('isEmail')!=-1) { p=val.indexOf('@');
          if (p<1 || p==(val.length-1)) errors+='- '+nm+' must contain an e-mail address.\n';
        } else if (test!='R') { num = parseFloat(val);
          if (isNaN(val)) errors+='- '+nm+' must contain a number.\n';
          if (test.indexOf('inRange') != -1) { p=test.indexOf(':');
            min=test.substring(8,p); max=test.substring(p+1);
            if (num<min || max<num) errors+='- '+nm+' must contain a number between '+min+' and '+max+'.\n';
      } } } else if (test.charAt(0) == 'R') errors += '- '+nm+' is required.\n'; }
    } if (errors) alert('The following error(s) occurred:\n'+errors);
    document.MM_returnValue = (errors == '');
} }
</script>
    </head>

<body>
<div class="header" id="header"><img src="web/images/logo.png" width="342" height="104" /><br />
  CONTRATACIÓN DE PROFESIONALES<br />
  Por favor complete con sus datos<br />
</div>
<br />
<div class="wrap2" id="wrap2">
<?php
if (!isset($_POST['email'])) {
?>
</p>
<form action="<?=$_SERVER['PHP_SELF']?>" method="post">




<div class="mod-contacto1" id="mod-contacto1">
Nombre:
<input name="nombre" type="text" id="nombre" size="28" />  </div>

<div class="mod-contacto1" id="mod-contacto1">
Apellido:
<input name="apellido" type="text" id="apellido" size="28" /> </div>

<div class="mod-contacto1" id="mod-contacto1">
Fecha de Nacimiento:
<input name="nacimiento" type="text" id="nacimiento" size="28" /> </div>

<div class="mod-contacto1" id="mod-contacto1">
Especialidades Acreditadas:
<input name="especialidades" type="text" id="especialidades" size="28" /> </div>

<div class="mod-contacto1" id="mod-contacto1">
Domicilio Particular:
<input name="domicilio" type="text" id="domicilio" size="28" /></div>

<div class="mod-contacto1" id="mod-contacto1">
C&oacute;digo Postal:
<input name="cpostal" type="text" id="cpostal" size="28" /></div>

<div class="mod-contacto1" id="mod-contacto1">
Localidad:
<input name="ciudad" type="text" id="ciudad" size="28" /></div>

<div class="mod-contacto1" id="mod-contacto1">
Provincia:
<input name="provincia" type="text" id="provincia" size="28" /></div>

<div class="mod-contacto1" id="mod-contacto1">
Tel&eacute;fono Celular:
<input name="cel" type="text" id="cel" size="28" /></div>

<div class="mod-contacto1" id="mod-contacto1">
Tel&eacute;fono Particular:
<input name="tel" type="text" id="tel" size="28" /></div>

<div class="mod-contacto1" id="mod-contacto1">Tel&eacute;fono Consultorio:
<input name="tel-laboral" type="text" id="tel-laboral" size="28" /></div>

<div class="mod-contacto1" id="mod-contacto1">
E-mail:<input name="email" type="text" id="mail" size="28" /></div>

<div class="mod-contacto1" id="mod-contacto1">
A&ntilde;o de Graduaci&oacute;n:
<input name="anio-graduacion" type="text" id="anio-graduacion" size="28" /></div>

<div class="mod-contacto1" id="mod-contacto1">
Universidad:
<input name="uiversidad" type="text" id="uiversidad" size="28" /></div>

<div class="mod-contacto1" id="mod-contacto1">
Consultorio propio:
<input type="radio" name="Departamento" value="si" id="Consultorio_si" />
SI</span>
<input type="radio" name="Departamento" value="no" id="Consultorio_no" />
NO</span></div>

<div class="mod-contacto1" id="mod-contacto1">
Domicilio Consultorio:
<input name="domicilio" type="text" id="domicilio" size="28" /></div>

<div class="mod-contacto1" id="mod-contacto1">
Localidad:
<input name="localidad" type="text" id="localidad" size="28" /></div>

<div class="mod-contacto1" id="mod-contacto1">
Experiencia Laboral:ejercida en cada uno</br>
<textarea name="experexp-lab" cols="28" rows="6" class="textogeneral" id="experexp-lab"></textarea></div>

<div class="mod-contacto1" id="mod-contacto1">
Matr&iacute;cula Nacional N&ordm;:
<input name="matricula-nac" type="text" id="matricula-nac" size="28" /></div>

<div class="mod-contacto1" id="mod-contacto1">
Matr&iacute;cula Provincial
<input name="matricula-prov" type="text" id="matricula-prov" size="28" /></div>

<div class="mod-contacto1" id="mod-contacto1">
Seguro de mala praxis:
<input name="seguro-malapraxis" type="text" id="seguro-malapraxis" size="28" /></div>

<div class="mod-contacto1" id="mod-contacto1">
CUIT:
<input name="cuit" type="text" id="cuit" size="28" /></div>

<div class="mod-contacto1" id="mod-contacto1">
ANSSAL:
<input name="anssal" type="text" id="anssal" size="28" /></div>

<div class="mod-contacto1" id="mod-contacto1">
Comentarios:<br />
<textarea name="comentarios" cols="28" rows="4" class="textogeneral" id="comentarios"></textarea></div>

<div class="mod-contacto1" id="mod-contacto1">
<img id="captcha" src="securimage/securimage_show.php" alt="CAPTCHA Image" />
        <input type="text" name="captcha_code" size="10" maxlength="6" required />
<a href="#" onclick="document.getElementById('captcha').src = 'securimage/securimage_show.php?' + Math.random(); return false">[ Different Image ]</a>
<input type="reset" value="Borrar" /> 
<input type="submit" onclick="MM_validateForm('nombre','','R','apellido','','R','nacimiento','','R','especialidades','','R','domicilio','','R','ciudad','','R','mail','','RisEmail');return document.MM_returnValue" value="Enviar" />
    </div>
  
 
</form>
<?php
}else{
  include_once("securimage/securimage.php");
//creo un objeto securimage
$img = new securimage();
//valido el campo input del formulario donde se había escrito el texto de la imagen
$valido_captcha = $img->check($_POST['captchacode']);
if ($valido_captcha){
  $mensaje="Mensaje del formulario de contacto de Odontopraxis Contratacion de profesionales";
  $mensaje.= "\nNombre: ". $_POST['nombre'];
  $mensaje.= "\nApellido: ". $_POST['apellido'];
  $mensaje.= "\nNacimiento: ". $_POST['nacimiento'];
  $mensaje.= "\nEspecialidades: ". $_POST['especialidades2'];
  $mensaje.= "\nDomicilio: ". $_POST['domicilio'];
  $mensaje.= "\nCodigo-postal: ". $_POST['cpostal'];
  $mensaje.= "\nCiudad: ". $_POST['ciudad'];
  $mensaje.= "\nProvincia: ". $_POST['provincia'];
  $mensaje.= "\nCelular: ". $_POST['cel'];
  $mensaje.= "\nTelefono: ". $_POST['tel'];
  $mensaje.= "\nTel-laboral: ". $_POST['tel-laboral'];
  $mensaje.= "\nMail: ". $_POST['email'];
  $mensaje.= "\nAnio-graduacion: ". $_POST['anio-graduacion'];
  $mensaje.= "\nUniversidad: ". $_POST['universidad'];
  
  $mensaje.= "\nConsultorio: ". $_POST['Departamento'];
  
  $mensaje.= "\nDomicilio: ". $_POST['domicilio'];
  $mensaje.= "\nLocalidad: ". $_POST['localidad'];
  $mensaje.= "\nExperexp-lab: ". $_POST['Experexp-lab'];
  $mensaje.= "\nMatricula-nac: ". $_POST['matricula-nac'];
  $mensaje.= "\nMatricula-prov: ". $_POST['matricula-prov'];
  $mensaje.= "\nSeguro-malapraxis: ". $_POST['seguro-malapraxis'];
  $mensaje.= "\nCuit: ". $_POST['cuit'];
  $mensaje.= "\nANSSAL: ". $_POST['anssal'];
  $mensaje.= "\nComentarios: ". $_POST['comentarios'];
  $destino= "profesionales@odontopraxis.com.ar";
  $remitente = $_POST['email'];
  $asunto = "WEB - Contrat de Profesionales - enviado por: ".$_POST['nombre'];
  mail($destino,$asunto,$mensaje,"FROM: $remitente");
 }else{
  echo "<script>alert('Captcha incorrecto');</script>";
  echo "<script>window.location.assign('contacto.php')</script>";
}
echo "<script>window.location.assign('contacto.php')</script>";
}
?>
</p>
</body>
    </html>

