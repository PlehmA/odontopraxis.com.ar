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
</style>
    </head>

<body>
<div class="header" id="header">
  <p><img src="img/logo.png" width="342" height="104" /><br />
  Sistema de autogestion de Odontopraxis Americana</p>
  <div class="titulo-sector-autogestion" id="titulo-sector-autogestion">
    <p align="center">Solo Modificacion de Datos Impositivos.</p>
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
      <p>&gt;<a href="1-actualizar-datos-personales.php"> Actualizar datos personales</a></p>
      <p>&gt; <a href="2-actualizar-consultorio.php">Actualizar  consultorio</a><a href="datos-contacto.php"></a></p>
      <p>
      <div class="inhibido" id="inhibido">&gt; Actualizar datos impositivos</a></div>
      <a href="datos-contacto.php"></a></p>
      <p>&gt; <a href="4-envio-registro-nac-sss.php">Envio del Registro Nacional de Prestador de la SSS</a><a href="form-malapraxis.php"></a></p>
      <p>&gt; <a href="5-envio-cob-malapraxis.php">Envio de Cobertura Resp. Civil (Mala Praxis)</a><a href="form-malapraxis.php"></a></p>
      <p>&gt; <a href="6-alta-staff.php">Alta / Baja de Staff</a><a href="form-malapraxis.php"></a></p>
      <div class="titulo-autogestion2" id="titulo-autogestion3"> NOVEDADES </div>
      <p>&gt; <a href="7-novedades.php">Instructivos - Formularios</a></p>
      <p><a href="novedades.html"><br />
      </a></p>
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



<!-- form -->



<div class="enviocvp" id="enviocvp">

  <form name='formulario' id='formulario' method='post' action='enviar7.php' target='_self' enctype="multipart/form-data">
  
  Monotributista:
<input type="radio" name="Tipo-de-informe" value="Monotributo" id="Monotributo" checked/>
Responsable Inscripto: </span>
<input type="radio" name="Tipo-de-informe" value="Respon-Insc" id="Respon-Insc" />
</span>
<br />
 <br />
 
Apellido,  Nombre / Razon Social
  :  
<br />
  <input name='prestador' type='text' id='prestador' value="<?=$_SESSION['prestador']?>" size="30" readonly="readonly" />
<br />
  
   
 CUIT:  
 <br />
    <input name='cuit' type='text' id='cuit' value="<?=$_SESSION['cuit']?>" size="30" readonly="readonly" />
 
 <p>Domicilio:<br />
      <input name='Domicilio' type='text' id='domicilio' size="30" />
</p>
    
            <p>*Localidad:<br />
      <input name='Localidad' type='text' id='localidad' size="30" required/>
      
                     <p>Provincia:<br />
<select name="provincia" class="texto3 Estilo1 Estilo5 Estilo3" id="provincia" onChange="javascript: cbEspecilidadTurno_Change();">
  <option value="0">Seleccione</option>
                          <option value="Buenos Aires">Buenos Aires</option
                          ><option value="Ciudad Autónoma de Buenos Aires">Ciudad Autónoma de Buenos Aires</option>
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

</select><br />


    </p>
    
    <p>e-mail:<br />
      <input name='email' type='text' id='email' value="<?=$_SESSION['email']?>" size="30" readonly="readonly" />
      <br />
    </p>
    
 
Documentación a enviar: <br />
  <select name="Documentacion-a-enviar">
<option selected>Constancia de Monotributo.</option>
<option>Constancia de C.U.I.T.</option>
<option>Exencion de ingresos brutos.</option>
<option>Exencion de ganancias.</option>
<option>Otro documento impositivo.<option>
</select>


    

    
<br />
      * Adjuntar archivo:
      <input type='file' name='archivo1' id='archivo1' required/>
    </p>
    

    <br />
    Observaciones:</br>

<textarea name="Observaciones" cols="25" rows="6" class="textogeneral" id="observaciones"></textarea>

     <div class="mod-contacto1" id="mod-contacto1">Fecha de actualizacion:
        <input name='fecha' type='text' id='fecha' value="<?php 
echo date("d-m-Y h:i:s A"); 
?>" readonly="readonly" />
      </div>


  <br />
  <br />
  <br />


      * Datos obligatorios

<br />
    <div class="centrado" id="centrado">La informacion estara sujeta a verificacion y aceptacion por parte de Odontopraxis Americana.
En breve personal de la Empresa se comunicara con Ud.,a fin de formalizar la modificacion solicitada.<br />
<br />
      <input type='submit' value='Enviar' />
    </p>
  </form>
 
</div>


<!-- form -->




<br />
<br />
<br />
<br />
<div class="pie" id="pie">Odontopraxis Americana 2014® Todos los derechos reservados  diseño Sendero </div>
</body>
    </html>

