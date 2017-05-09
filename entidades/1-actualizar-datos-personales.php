<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?
  include ('lib.php');
  include ('checks.php');
  include ('conect.php');
 
?>
    <html xmlns="http://www.w3.org/1999/xhtml">
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link href="http://www.odontopraxis.com.ar/web/css/style.css" rel="stylesheet" type="text/css" media="all" />
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
.centrado {
	color: #036;
	text-align: center;
	font-family: Verdana, Geneva, sans-serif;
	font-size: 10px;
	display: block;
	float: left;
	width: 90%;
}
.enviado {
	text-align: center;
	font-family: Verdana, Geneva, sans-serif;
	color: #333;
	border: thin solid #3CF;
	height: 30px;
	width: 300px;
	float: left;
	margin: 10%;
	font-weight: bold;
	vertical-align: middle;
	font-size: 12px;
	padding: 1%;
}
</style>
    </head>

<body>
<div class="header" id="header">
  <p><img src="img/logo.png" width="342" height="104" /><br />
  Sistema de autogestion de Odontopraxis Americana</p>
  <div class="titulo-sector-autogestion" id="titulo-sector-autogestion">
    <p>Modificacion de  datos  personales<br />
      Por favor  complete solo los datos a ampliar / modificar.</p>
  </div>
</div>
<br />
<div class="wrap2" id="wrap2">
  <div class="col-iz2" id="col-iz2">
    <div class="menu-iz2" id="menu-iz2">
      <div class="titulos-autogestion" id="titulos-autogestion"><strong>Perfil</strong></div>
      PRESTADOR:
      <?=$_SESSION['prestador']?>
      <br />
CUIT:
<?=$_SESSION['cuit']?>
<br />
e-Mail:
<?=$_SESSION['email']?>
<br />
      <br />
      <div class="titulo-autogestion2" id="titulo-autogestion2">UTILIDADES</div>
      <p><div class="inhibido" id="inhibido">&gt; Actualizar datos personales</a></p></div>
      <p>&gt; <a href="2-actualizar-consultorio.php">Actualizar  consultorio</a><a href="datos-contacto.php"></a></p>
      <p>&gt; <a href="3-actualizar-impositivos.php">Actualizar datos impositivos</a><a href="datos-contacto.php"></a></p>
      <p>&gt; <a href="4-envio-registro-nac-sss.php">Envio del Registro Nacional de Prestador de la SSS</a><a href="form-malapraxis.php"></a></p>
      <p>&gt; <a href="5-envio-cob-malapraxis.php">Envio de Cobertura Resp. Civil (Mala Praxis)</a><a href="form-malapraxis.php"></a></p>
      <p>&gt; <a href="6-alta-staff.php">Alta / Baja de Staff</a><a href="form-malapraxis.php"></a></p>
      <p>&gt;<a href="liquidaciones/erp/PDF/index.php"> Liquidaciones</a></p>
      <div class="titulo-autogestion2" id="titulo-autogestion3"><a href="7-novedades.php"> Novedades </a></div>
      <br />
      <tr>
        <td valign="top" bgcolor="#FFFFFF"><input type="button" value="Salir" onclick="location='index.php?g=1'" style="width:80px" /></td>
      </tr>
    </div>
    </td>
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

<div class="enviocvp" id="enviocvp">


<div class="mod-contacto1" id="mod-contacto1">Apellido,  Nombre / Razon Social
  :<br />
  <input name='razonsocial' type='text' id='razonsocial' value="<?=$_SESSION['prestador']?>" size="30" readonly="readonly" />
</div>
  
    <div class="mod-contacto1" id="mod-contacto1">C.U.I.T.:<br />
      <input name='cuit' type='text' id='cuit' value="<?=$_SESSION['cuit']?>" size="30" readonly="readonly" />
    </div>
  
  
    <div class="mod-contacto1" id="mod-contacto1">Telefono particular:<br />
    <input name="tel" type="text" id="tel" size="30" />  </div>
  

  <div class="mod-contacto1" id="mod-contacto1">Telefono celular:<br />
    <input name="tipodoc" type="text" id="tipodoc" size="30" />  </div>

  <div class="mod-contacto1" id="mod-contacto1">Numero de documento:<br />
    <input name="numerodoc" type="text" id="numerodoc" size="30" />  </div>
  

  
  <div class="mod-contacto1" id="mod-contacto1">*e-mail:<br />
 <input name="email" type="text" id="email" size="30" required/>  </div>
 
 
    <div class="mod-contacto1" id="mod-contacto1">Domicilio Particular Av./Calle:<br />
    <input name="domicilio" type="text" id="domicilio" size="30" />  </div> 
        
  
  <div class="mod-contacto1" id="mod-contacto1">Codigo postal:<br />
<input name="cp" type="text" id="cp" size="30" />  </div>
        

    <div class="mod-contacto1" id="mod-contacto1">Localidad / Barrio:      
          <br />
<input name="loc-barrio" type="text" id="loc-barrio" size="30" />
    </div>
  <br /><br />
        <div class="mod-contacto1" id="mod-contacto1">Provincia:<br />
<select name="provincia" class="texto3 Estilo1 Estilo5 Estilo3" id="provincia" onChange="javascript: cbEspecilidadTurno_Change();">
        <option value="0">Seleccione</option>
                          <option value="Buenos Aires">Buenos Aires</option
                          ><option value="Ciudad Autonoma de Buenos Aires">Ciudad Autonoma de Buenos Aires</option>
                          <option value="Catamarca">Catamarca</option>
                          <option value="Chaco">Chaco</option>
                          <option value="Chubut">Chubut</option>
                          <option value="Córdoba">Córdoba</option>
                          <option value="Corrientes">orrientes</option>
                          <option value="Entre Ríos">Entre Ríos</option>
                          <option value="Formosa">Formosa</option>
                          <option value="Jujuy">Jujuy</option>
                          <option value="La Pampa">La Pampa</option>
                          <option value="La Rioja">La Rioja</option>
                          <option value="Mendoza">Mendoza</option>
                          <option value="Misiones">Misiones</option>
                          <option value="Neuquén">Neuquén</option>
                          <option value="Río negro">Río Negro</option>
                          <option value="Salta">Salta</option>
                          <option value="San Juan">San Juan</option>
                          <option value="San Luis">San Luis</option>
                          <option value="Santa Cruz">Santa Cruz</option>
                          <option value="Santa Fé">Santa Fé</option>
                          <option value="Santiago del estero">Santiago del estero</option>
                          <option value="Tierra del fuego">Tierra del fuego</option>
                          <option value="Tucumán">Tucumán</option>

    </select> </div>
  
  


<div class="mod-contacto1" id="mod-contacto1">
Observaciones:</br>
<textarea name="observaciones" cols="25" rows="6" class="textogeneral" id="observaciones"></textarea></div>

     <div class="mod-contacto1" id="mod-contacto1">Fecha de actualizacion:
        <input name='fecha' type='text' id='fecha' value="<?php 
echo date("d-m-Y h:i:s A"); 
?>" readonly="readonly" />
      </div>


 

 
  <div class="mod-contacto1" id="mod-contacto1">
<input type="reset" value="Borrar" /> 
<input type="submit" onclick="MM_validateForm('nombre','','R','tipodoc','','R','numerodoc','','email','','RisEmail');return document.MM_returnValue" value="Enviar" />
    </div>
  




</form>
<?php
}else{
  $mensaje="WEB modificacion de datos de particulares\n";
  $mensaje.= "\nRazonsocial: ". $_POST['razonsocial'];
    $mensaje.= "\nCUIT: ". $_POST['cuit'];
    $mensaje.= "\ne-Mail : ".$_SESSION['email'];
  $mensaje.= "\nTelefono: ". $_POST['tel'];
  $mensaje.= "\nTipo de documento: ". $_POST['tipodoc'];
  $mensaje.= "\nNro. Documento: ". $_POST['numerodoc'];
  $mensaje.= "\ne-Mail: ". $_POST['email'];
  $mensaje.= "\nDomicilio: ". $_POST['domicilio'];
  $mensaje.= "\nCod. postal: ". $_POST['cp'];
  $mensaje.= "\nLocalidad / Barrio: ". $_POST['loc-barrio'];
  $mensaje.= "\nProvincia: ". $_POST['provincia'];
  $mensaje.= "\nObservaciones: ". $_POST['observaciones'];
  $mensaje.= "\nFecha: ". $_POST['fecha'];
  
  $destino= "profesionales@odontopraxis.com.ar";
  $remitente = $_POST['email'];
  $asunto = "WEB - Mod datos particulares Enviado por: ".$_POST['razonsocial'];
  mail($destino,$asunto,$mensaje,"FROM: $remitente");
  


?>



  <div class="titulo-sector-autogestion" id="titulo-sector-autogestion">
<br />  <div class="enviado" id="enviado">
  <p>Su mensaje se envió correctamente. <br /> Muchas gracias</p></div><br />
  </div>
  
  
  <?php
}
?>
</p>

<div class="centrado" id="centrado">La informacion estara sujeta a verificacion y aceptacion por parte de Odontopraxis Americana.</div>

<div class="centrado" id="centrado">En breve personal de la Empresa se comunicara con Ud.,a fin de formalizar la modificacion solicitada.</div>
<!--**************************************************-->

<br />
<br />
<br />
<br />
<div class="pie" id="pie">Odontopraxis Americana 2015® Todos los derechos reservados  diseño Sendero </div>
</body>
    </html>

