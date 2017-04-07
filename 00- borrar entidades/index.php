<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

    <html xmlns="http://www.w3.org/1999/xhtml">
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        

<link href="css/style3.css" rel="stylesheet" type="text/css" media="all" />
<title>Odontopraxis Americana s.a.</title>


<?
// session_start();
 session_unset();
 //session_destroy();
include ('lib.php');
?>


</head>

<body>
<div class="header" id="header"><img src="img/logo.png" width="342" height="104" /><br />
  Bienvenidos al sistema de autogestión de Odontopraxis Americana<br />
</div>
<br />
<div class="wrap2" id="wrap2">


  <div class="col-iz3" id="col-iz3">
  <div class="menu-iz3" id="menu-iz3"><strong>
  
  <!--**************************************************-->
 
      <br />
<?      if (isset($_GET['g'])) {    ?> 
        <h2 align="center"> Gracias por utilizar el sistema de gestión de Odontopraxis  </h2>
<?      }   ?>        

      <br />
<?      if (isset($_GET['i'])) {    ?> 
        <h2 align="center"> Su usuario aun se encuentra en proceso de ser activado. <br /> Por favor intentelo m&aacutes tarde</h2>
<?      }   ?>     

      <h2 align="center"> Ingreso al sistema</h2>
 <br />
 <form  method="POST" action="validarEntidad.php">
Usuario:
        <input type="text" class="menu2_abm" name="usuario">
        <br />
        
        Contrase&ntilde;a:

        <input type="password" class="menu2_abm" name="password">
        <br />
<br />

        <p align="center">
          <input type="submit" value=" Aceptar " >
    &nbsp;&nbsp;&nbsp;    
    <input type="button" name="boton" value="Nuevo usuario" onclick="location='registroEntidad.php?accion=ALTA';" style="width:120px"/>
    <br />

    <a href="olvidoPassEntidad.php" style="color: grey;">Olvid&eacute mi contrase&ntilde;a </a>
</p>
</form >
<!--**************************************************--

</strong><br />
    <br />

    <!--**************************************************-->
 

</div>
</div>



</div>
</br>

<div class="pie" id="pie">Odontopraxis Americana 2014® Todos los derechos reservados  diseño Sendero</div>
</body>
    </html>

