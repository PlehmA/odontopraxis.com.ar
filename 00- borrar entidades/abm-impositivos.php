<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

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
  Bienvenidos al sistema de autogestión de Odontopraxis Americana</p>
  <div class="titulo-sector-autogestion" id="titulo-sector-autogestion">
    <p align="center">Alta / baja  / Modificación  de datos Impositivos.<br />
    Por favor complete solo los datos a actualizar o los datos completos para solicitar el alta de un nuevo consultorio.</p>
  </div>
</div>
<br />
<div class="wrap2" id="wrap2">


  <div class="col-iz2" id="col-iz2">
    <div class="menu-iz2" id="menu-iz2">
      <div class="titulos-autogestion" id="titulos-autogestion"><strong>Gestión online</strong></div>
      <div class="titulo-autogestion2" id="titulo-autogestion2">UTILIDADES</div>
      <p>&gt; <a href="http://200.68.69.229:8080/PREPAGA/pages/login.faces" target="blank">Validación / Carga de  Prestaciones</a></p>
      <p>&gt; <a href="entidades-home.php"><strong>Consulta de liquidación</strong></a></p>
      <p>&gt; <a href="resumen-liquidacion.php">Resúmen de liquidación</a></p>
      <div class="titulo-autogestion2" id="titulo-autogestion">SOLICITUDES</div>
      <p>&gt; <a href="actualizar-datos.php">Actualizar Datos Personales</a></p>
      <p>&gt; <a href="abm-consultorio.php">ABM de consultorio</a></p>
      <p class="inhibido">&gt; ABM datos impositivos</a><a href="datos-contacto.php"></a></p>
      <p>&gt; <a href="comprobantes-vencimiento.php">Comprobantes con vencimientos</a><a href="form-malapraxis.php"></a><a href="form-malapraxis.php"></a></p>
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



<!-- form -->


<br />
<div class="enviocvp" id="enviocvp">

  <form name='formulario' id='formulario' method='post' action='enviar7.php' target='_self' enctype="multipart/form-data">
  
  Monotributista:
<input type="radio" name="Tipo-de-informe" value="nonotributo" id="nonotributo" />
Responsable Inscripto: </span>
<input type="radio" name="Tipo-de-informe" value="respon-insc" id="respon-insc" />
</span>
<br />
 <br />
 
 
    <p>Apellido y Nombre  o Razón Social<br />
      <input type='text' name='Nombre' id='Nombre' />
    </p>
    
        <p>Domicilio:<br />
      <input type='text' name='Domicilio' id='domicilio' />
    </p>
    
            <p>Localidad:<br />
      <input type='text' name='Localidad' id='localidad' />
    </p>
    
            <p>CUIT:<br />
      <input type='text' name='CUIT' id='cuit' />
    </p>
    
 
Documentación a enviar: <br />
  <select name="Documentacion-a-enviar">
<option selected>Constancia de Monotributo.</option>
<option>Constancia de C.U.I.T.</option>
<option>Exención de ingresos brutos.</option>
<option>Exención de ganancias.</option>
<option>Otro documento impositivo.<option>
</select>

    <p>E-mail:<br />
      <input type='text' name='email' id='email' />
    </p>

    
    <p>Fecha de alta u modificación:<br />
      <input type='text' name='Fecha-alta-ultima-modificacion' id='fecha-alta-ultima-modificacion' />
    </p>
    
<br />
      Adjuntar archivo:
      <input type='file' name='archivo1' id='archivo1' />
    </p>
    

    <br />
    Observaciones:</br>

<textarea name="Observaciones" cols="25" rows="6" class="textogeneral" id="observaciones"></textarea>



      <br /><br />
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

