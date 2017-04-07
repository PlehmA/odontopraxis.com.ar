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
  <div class="titulo-sector-autogestion" id="titulo-sector-autogestion">Formulario de Solicitud&nbsp;de seguros de malapraxis</div>
</div>
<br />
<div class="wrap2" id="wrap2">
  <div class="col-iz2" id="col-iz2">
    <div class="menu-iz2" id="menu-iz2">
      <div class="titulos-autogestion" id="titulos-autogestion"><strong>Gestión online</strong></div>
      <div class="titulo-autogestion2" id="titulo-autogestion2">UTILIDADES</div>
      <p>&gt; <a href="cartilla.php">Solicitud de cartilla</a></p>
      <p>&gt; <a href="datos-contacto.php">Actualizar datos de contacto</a></p>
      <div class="inhibido" id="inhibido">&gt; Envío de seguros de mala praxis </div>
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


<!-- form -->


<br />
<div class="enviocvp" id="enviocvp">

  <form name='formulario' id='formulario' method='post' action='enviar6.php' target='_self' enctype="multipart/form-data">
    <p>Nombre y apellido<br />
      <input type='text' name='Nombre' id='Nombre' />
    </p>
    
        <p>MP:<br />
      <input type='text' name='MP' id='MP' />
    </p>
    
            <p>Domicilo:<br />
      <input type='text' name='Domicilio' id='Domicilio' />
    </p>
    
            <p>Localidad:<br />
      <input type='text' name='Localidad' id='Localidad' />
    </p>
    
                <p>Provincia:<br />
      <input type='text' name='Provincia' id='Provincia' />
    </p>
    
    
    <p>E-mail<br />
      <input type='text' name='email' id='email' />
    </p>
    <p>Asunto<br />
      <input name='asunto' type='text' id='asunto' value="Comprobantes con vencimiento" />
    </p>

    <p><br />
    
    Documentación a enviar: <br />
  <select name="Documentacion-a-enviar">
<option selected>Comprobante de Cobertura de Responsabilidad Civil (Mala praxis)
</option>
<option>Comprobante Registro de S.S.Salud.</option>

</select>
<br />

      Adjuntar archivo:
        <input type='file' name='archivo1' id='archivo1' />
    </p>
    


    <br />
    Observaciones:</br>

<textarea name="observaciones" cols="25" rows="6" class="textogeneral" id="observaciones"></textarea>



      <br /><br />
      <input type='submit' value='Enviar' />
    </p>
  </form>
</div>

<!-- form -->


<br />
<br />
<br />
<div class="pie" id="pie">Odontopraxis Americana 2014® Todos los derechos reservados  diseño Sendero </div>
</body>
    </html>

