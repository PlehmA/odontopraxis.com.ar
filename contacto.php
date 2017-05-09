<!DOCTYPE HTML>
<html>
<head>
<title>Odontopraxis Americana s.a.</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro' rel='stylesheet' type='text/css'>
<link href="web/css/style.css" rel="stylesheet" type="text/css" media="all" />

</head>
<body>
<div class="header_bg">
<div class="wrap">
	<div class="header">
		<div class="logo">
			<a href="index.html"><img src="web/images/logo.png" alt="" /></a>
	  </div>
		<div class="cssmenu">
		  <ul>
		    <li><a href="index.html">Home</a></li>
		    <li><a href="empresa.html">Empresa</a></li>
		    <li><a href="servicios.html">Servicios</a></li>
		    <li><a href="brindamos.html">Brindamos</a></li>
		    <li><a href="">Consultorios Tribunales</a>
		      <ul>
		        <li class="has-sub"><a href="ctribunales.html">Consultorios</a></li>
		        <li class="has-sub"><a href="contratacion-personal-aux.php">Contratación de personal Auxiliar </a></li>
	          </ul>
	        </li>
		    <li class="active"><a href="contacto.php">Contacto</a></li>
		    </li>
		    <div class="clear"></div>
	      </ul>
	  </div>


		<div class="clear"></div>
		<div class="top-nav">
		<nav class="clearfix">
				<ul>
		   <li class="active"><a href="index.html">Inicio</a></li>
           <li><a href="empresa.html">Empresa</a></li>
           <li><a href="servicios.html">Servicios</a></li>
           <li><a href="brindamos.html">Brindamos</a></li>
           <li><a href="ctribunales.html">Consultorios Tribunales</a>
                                     		      <ul>
		         <li class="has-sub"><a href="contratacion-personal-aux.php">Contratación de personal Auxiliar </a></li>
		      </ul> </li>
           <li><a href="contacto.php">Contacto</a></li>
				</ul>
				<a href="#" id="pull">Menú</a>
			</nav>
		</div>
	<div class="clear"></div>
	</div>
</div>
</div>

 <div class="titulocontacto" id="titulocontacto">Envíenos sus datos y su consulta.
Nos comunicaremos con usted inmediatamente. 
   </div> 
<!-- cuerpo texto y foto -->
<div class="contenedor-img-tex" id="contenedor-img-tex">
      
          
          <div class="bloquetxt4contacto" id="bloquetxt4contacto">
          
          
 <?php 
session_start();
if (!isset($_POST['email'])) {

?>
          
          
          
          
  <form action="<?=$_SERVER['PHP_SELF']?>" method="POST">
    
</br><div class="mod-contacto01">
Ud. es  profesional:
  <input type="radio" name="Departamento" value="profesionales@odontopraxis.com.ar" id="Departamento_0" checked />
<br />
Ud. es  paciente:
<input type="radio" name="Departamento" value="coordinación@odontopraxis.com.ar" id="Departamento_1" /></div>
  
        
   <div class="mod-contacto"> Nombre:<input name="nombre" type="text"  id="nombre" size="28" required /></div>
   
   
<div class="mod-contacto">Apellido:<input name="apellido" type="text" id="apellido" size="28" required /></div>

<div class="mod-contacto">Correo:<input name="email" type="text" id="email" size="28" required /></div>

<div class="mod-contacto">Teléfono:<input name="telefono" type="text"  id="telefono" size="28" required /></div>
        <br />
<div class="mod-contacto2">Su consulta:<br />
        <div class="txtcontacto" id="txtcontacto"></div>
        <textarea name="mensaje" cols="45" rows="6"></textarea><br /><br />
        <img id="captcha" src="securimage/securimage_show.php" alt="CAPTCHA Image" />
        <input type="text" name="captcha_code" size="10" maxlength="6" required />
<a href="#" onclick="document.getElementById('captcha').src = 'securimage/securimage_show.php?' + Math.random(); return false">[ Different Image ]</a>
            <br>
            <input type="reset" value="Borrar" />
    		<input type="submit" value="Enviar" /></div>

    
    
    <label></label>
    
    <br />


    </form>
  <?php
  
}else{
//primero incluimos el script de securimage
include_once("securimage/securimage.php");
//creo un objeto securimage
$img = new securimage();
//valido el campo input del formulario donde se había escrito el texto de la imagen
$valido_captcha = $img->check($_POST['captchacode']);
if ($valido_captcha){
   $mensaje="Mensaje de contacto de www.odontopraxis.com.ar";
  $mensaje.= "\nNombre: ". $_POST['nombre'];
  $mensaje.= "\nApellido: ". $_POST['apellido'];
  $mensaje.= "\nEmail: ".$_POST['email'];
  $mensaje.= "\nTelefono: ". $_POST['telefono'];
  $mensaje.= "\nMensaje: \n".$_POST['mensaje'];

  $remitente = $_POST['email'];
  $asunto = "Mensaje enviado por: ".$_POST['apellido']." ".$_POST['nombre'];
  
  
  $email = $_POST['Departamento'];
mail($email, $asunto, $mensaje, "FROM: formulario@odontopraxis.com\n");
}else{
  echo "<script>alert('Captcha incorrecto');</script>";
  echo "<script>window.location.assign('contacto.php')</script>";
}
echo "<script>window.location.assign('contacto.php')</script>";
}
?>
    
    
    
  </div>

<div class="imgcuerpotxt3" id="imgcuerpotxt3"><img src="web/images/fotocontacto01.jpg"></div>


</div> <!-- FIN contenedor>
FIN cuerpo texto y foto -->

<!-- start mian --></p>
</div>




<div class="main_bg">
<div class="wrap">
	<div class="grids_1_of_3">
	  <div class="grid_1_of_3 images_1_of_3"><a href="/entidades/gestion-prestadores.php" target="black">
	    <h3>GESTIÓN DE PRESTADORES </h3>
	    </a></div>
	  <div class="grid_1_of_3 images_1_of_3"><a href="contratacion-personal.php" target="_self">
	    <h3>CONTRATACIÓN DE PERSONAL<br>
</h3></a></div>
        
        		<div class="grid_1_of_3 images_1_of_3"><a href="contratacion-prof.php" target="black">
	  <h3>cONTRATACIÓN DE PROFESIONALES<br>
    </h3></a></div>
   		<div class="clear"></div>
	</div>
</div>
</div>
<!-- start top_grid -->
<div class="top_grid_bg">
<!-- start mid_grid --><!-- start mid_grid -->
<div class="btm_grid_bg"></div>
<!-- start testimonial  --><!-- start testimonial  -->
<div class="clear"></div>
<!-- start testimonial  --><!-- start footer_top  --><!-- start footer  -->
<div class="footer_bg">

<div class="separador" id="separador"></div>


<div class="wrap">
	<div class="footer">
		<div class="span_of_4">
		  <div class="span1_of_4">
		    <h2>Mapa del sitio</h2>
		    <ul class="f_nav1">
		      <li><a href="empresa.html">Empresa&nbsp; &nbsp; </a></li>
		      <li><a href="servicios.html">Servicios&nbsp; &nbsp; </a></li>
		      <li><a href="brindamos.html"> Brindamos&nbsp; &nbsp; </a></li>
		      <li><a href="ctribunales.html"> Consultorios tribunales&nbsp; </a></li>
		      <li><a href="contacto.php"> Contacto&nbsp; </a></li>
		      <li><a href="/entidades/seleccion.php">Exclusivo prestadores&nbsp; &nbsp; </a></li>
		      <li><a href="contratacion-personal.php">Contratación de personal &nbsp; &nbsp; </a></li>
		      <li><a href="contratacion-prof.php"> Contratación de profesionales&nbsp; &nbsp; </a></li>
		      <li><a href="contratacion-personal-aux.php"> Contratación de personal auxiliar&nbsp; &nbsp; </a></li>
		      <li><a href="http://www.odontopraxis.com.ar/intranet/" target="_blank">INGRESO A INTRANET&nbsp; &nbsp;</a></li>
		      <li></li>
	        </ul>
	      </div>
		  <div class="span1_of_4">
	    <h2>Dónde estamos?</h2>
				<ul class="f_nav1">
					<li>
					  <h2>Av. Córdoba 1345 Piso 13 º A
					    C.A.B.A. <br>
					    Tel / Fax: 011 4811-5555 (líneas rotativas) </a></h2>
				  </li>
					<li><a href="">informes@odontopraxis.com.ar</a></li>
					<li></li>
					<li></li>
					<li></li>
				</ul>
			</div>
		  
			<div class="span1_of_3b ">
              <p><img src="web/images/facebook.png" width="65" height="56"> <img src="web/images/mobilepublicinfo.jpg" width="63" height="59">&nbsp;&nbsp; </p>
              <div class="clear"></div>
            
		</div>
        

	</div>
</div>

<div class="separador" id="separador"></div>

<div class="piecopy" id="piecopy">Odontopraxis Americana <?php echo date('Y'); ?> Todos los derechos reservados</div>
</div>
<script
  src="https://code.jquery.com/jquery-3.2.1.min.js"
  integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
  crossorigin="anonymous"></script>
</body>
</html>
