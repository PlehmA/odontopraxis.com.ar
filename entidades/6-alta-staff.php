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
</style>
    </head>

<body>
<div class="header" id="header">
  <p><img src="img/logo.png" width="342" height="104" /><br />
  Sistema de autogestion de Odontopraxis Americana</p>
  <div class="titulo-sector-autogestion" id="titulo-sector-autogestion">
    <p>Actualizacion de Staff<br />
      </p>
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
      <p>&gt; <a href="3-actualizar-impositivos.php">Actualizar datos impositivos</a><a href="datos-contacto.php"></a></p>
      <p>&gt; <a href="4-envio-registro-nac-sss.php">Envio del Registro Nacional de Prestador de la SSS</a><a href="form-malapraxis.php"></a></p>
      <p>&gt; <a href="5-envio-cob-malapraxis.php">Envio de Cobertura Resp. Civil (Mala Praxis)</a><a href="form-malapraxis.php"></a></p>
      <p>
      <div class="inhibido" id="inhibido">&gt; Alta / Baja de Staff</a></div><a href="form-malapraxis.php"></a></p>
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

  <form name='formulario' id='formulario' method='post' action='enviar8.php' target='_self' enctype="multipart/form-data">
  
    Alta:
<input type="radio" name="Tipo-de-informe" value="Alta" id="Monotributo" checked/>
baja: </span>
<input type="radio" name="Tipo-de-informe" value="Baja" id="Respon-Insc" />
</span>
<br />


<br />
 <p>Prestador:<br />
 <input name='prestador' type='text' id='prestador' value="<?=$_SESSION['prestador']?>" size="30" readonly="readonly" />
<br />

   <p>CUIT:<br />
    <input name='cuit' type='text' id='cuit' value="<?=$_SESSION['cuit']?>" size="30" readonly="readonly" />
    <br />
    
        <p>e-mail:<br />
      <input name='email' type='text' id='email' value="<?=$_SESSION['email']?>" size="30" readonly="readonly" />
      <br />
      
    <p>*Nombre  y Apellido del integrante de su staff:<br />
      <input name='nombre-nuevo-integrante' type='text' id='nombre-nuevo-integrante' size="30" required/>
    </p>
    
            <p>*Especialidad:<br />
      <input name='Especialidad' type='text' id='Especialidad' size="30" required/>
    </p>
    
            <ul>
              <li>Matricula Nacional:            </li>
            </ul>
            <p>
              <input name='Matricula-nacional' type='text' id='Matricula-nacional' size="30" >
</p>
    
                <ul>
                  <li>Matricula Provincia:</li>
                </ul>
                <p>
                  <input name='Matricula-provincia' type='text' id='Matricula-provincia' size="30" >
    </p>
    
      <ul>
                  <li>Número de la SSS:</li>
                </ul>
                <p>
                  <input name='Número-de-SSS' type='text' id='Número-de-SS' size="30" >
    </p>
    
    
 
    
    <ul>
                  <li>*CUIT/CUIL:</li>
    </ul>
    <p>
      <input name='cuit' type='text' id='cuit' size="30" required/>
      <br />
    </p>

    <p>

      <br />
      Adjuntar archivo para ALTAS (Titulo/Matricula/SSS/Mala Praxis/DNI):
<input type='file' name='archivo1' id='archivo1' />
  </p>
    

    <br />
    Observaciones:</br>

<textarea name="Observaciones" cols="25" rows="6" class="textogeneral" id="observaciones"></textarea>


<br />
<br />
* Datos obligatorios <br /><br />

<div class="mod-contacto1" id="mod-contacto1">Fecha de actualización:  
        <input name='fecha' type='text' id='fecha' value="<?php 
echo date("d-m-Y h:i:s A"); 
?>" readonly="readonly" />
        <br />
    </div>

      <input type='submit' value='Enviar' />
      <br />
      <br />
    <br />
    <div class="centrado" id="centrado">La informacion estara sujeta a verificacion y aceptacion por parte de Odontopraxis Americana.
En breve personal de la Empresa se comunicara con Ud.,
a fin de formalizar la modificacion solicitada.<br />
<br />
<br />

<br />
  </form>
</div>

<!-- form -->



<!--**************************************************-->

<br />
<br />
<br />
<br />
<div class="pie" id="pie">Odontopraxis Americana 2015® Todos los derechos reservados  diseño Sendero </div>
</body>
    </html>

