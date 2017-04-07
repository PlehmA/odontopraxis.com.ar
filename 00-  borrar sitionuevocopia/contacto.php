
<!DOCTYPE HTML>
<html>
<head>
<title>boceto odontopraxis</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro' rel='stylesheet' type='text/css'>
<link href="web/css/style.css" rel="stylesheet" type="text/css" media="all" />
<!--start slider -->
    <link rel="stylesheet" href="web/css/fwslider.css" media="all">
    <script src="web/js/jquery.min.js"></script>
    <script src="web/js/jquery-ui.min.js"></script>
    <script src="web/js/css3-mediaqueries.js"></script>
    <script src="web/js/fwslider.js"></script>
<!--end slider -->
<script type="text/javascript" src="web/js/jquery-hover-effect.js"></script>
<script type="text/javascript">
//Image Hover
jQuery(document).ready(function(){
jQuery(function() {
	jQuery('ul.da-thumbs > li').hoverdir();
});
});
</script>
<!-- Add fancyBox main JS and CSS files -->
<script src="web/js/jquery.magnific-popup.js" type="text/javascript"></script>
<link href="web/css/magnific-popup.css" rel="stylesheet" type="text/css">
<style type="text/css">
.titulos {
	color: rgba(109,207,246,1);
	font-size: 1.3em;
}
</style>
<script>
			$(document).ready(function() {
				$('.popup-with-zoom-anim').magnificPopup({
					type: 'inline',
					fixedContentPos: false,
					fixedBgPos: true,
					overflowY: 'auto',
					closeBtnInside: true,
					preloader: false,
					midClick: true,
					removalDelay: 300,
					mainClass: 'my-mfp-zoom-in'
			});
		});
		</script>
<!--nav-->
<script>
$(function() {
			var pull 		= $('#pull');
				menu 		= $('nav ul');
				menuHeight	= menu.height();

			$(pull).on('click', function(e) {
				e.preventDefault();
				menu.slideToggle();
			});

			$(window).resize(function(){
        		var w = $(window).width();
        		if(w > 320 && menu.is(':hidden')) {
        			menu.removeAttr('style');
        		}
    		});
		});
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
if (!isset($_POST['email'])) {
?>
          
          
          
          
  <form action="<?=$_SERVER['PHP_SELF']?>" method="post">
    
</br><div class="mod-contacto01">
Ud. es  profesional:
  <input type="radio" name="Departamento" value="profesionales@odontopraxis.com.ar" id="Departamento_0" checked />
<br />
Ud. es  paciente:
<input type="radio" name="Departamento" value="coordinación@odontopraxis.com.ar" id="Departamento_1" /></div>
  
        
   <div class="mod-contacto"> Nombre:<input name="nombre" type="text"  id="nombre" size="28" /></div>
   
   
<div class="mod-contacto">Apellido:<input name="apellido" type="text" id="apellido" size="28" /></div>

<div class="mod-contacto">Correo:<input name="email" type="text" id="email" size="28" /></div>

<div class="mod-contacto">Teléfono:<input name="telefono" type="text"  id="telefono" size="28" /></div>
        <br />
<div class="mod-contacto2">Su consulta:<br />
        <div class="txtcontacto" id="txtcontacto"></div>
        <textarea name="mensaje" cols="45" rows="6"></textarea><br /><br />
            <input type="reset" value="Borrar" />
    <input type="submit" onclick="MM_validateForm('nombre','','R','apellido','','R','email','','NisEmail','telefono','','R');return document.MM_returnValue" value="Enviar" /></div>

    
    
    <label></label>
    
    <br />


    </form>
  <?php
}else{
  $mensaje="Mensaje de contacto de Odontopraxis.com.ar";
  $mensaje.= "\nNombre: ". $_POST['nombre'];
  $mensaje.= "\nApellido: ". $_POST['apellido'];
  $mensaje.= "\nEmail: ".$_POST['email'];
  $mensaje.= "\nTelefono: ". $_POST['telefono'];
  $mensaje.= "\nMensaje: \n".$_POST['mensaje'];

  $remitente = $_POST['email'];
  $asunto = "Mensaje enviado por: ".$_POST['nombre'];
  
  
  $email = $_POST['Departamento'];
mail($email, $asunto, $mensaje, "FROM: formulario@odontopraxis.com<formulario@odontopraxis.com>\n");


?>
          <p class="textogeneral2"><strong>Mensaje enviado.</strong></p>
  <?php
}
?>
    
    
    
  </div>

<div class="imgcuerpotxt3" id="imgcuerpotxt3"><img src="web/images/fotocontacto01.jpg"></div>


</div> <!-- FIN contenedor>
<!-- FIN cuerpo texto y foto -->

<!-- start mian --></p>
</div>




<div class="main_bg">
<div class="wrap">
	<div class="grids_1_of_3">
	  <div class="grid_1_of_3 images_1_of_3"><a href="http://www.odontopraxis.com.ar/entidades/gestion-prestadores.php" target="black">
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
				  
				  <li><a href="ctribunales.html"> Consultorios tribunales&nbsp;  </a></li>
				  <li><a href="contacto.php"> Contacto&nbsp;  </a></li>
				  
				  <li><a href="http://www.odontopraxis.com.ar/entidades/gestion-prestadores.php">Gestión de prestadores&nbsp; &nbsp; </a></li>
				  <li><a href="contratacion-personal.php">Contratación de personal &nbsp; &nbsp; </a></li>
				  <li><a href="contratacion-prof.php"> Contratación de profesionales&nbsp; &nbsp;  </a></li>
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
              <p><img src="web/images/facebook.png" width="65" height="56"> <img src="web/images/mobilePublicInfo.jpg" width="63" height="59">&nbsp;&nbsp; </p>
              <div class="clear"></div>
            
		</div>
        

	</div>
</div>

<div class="separador" id="separador"></div>

<div class="piecopy" id="piecopy">Odontopraxis Americana 2014® Todos los derechos reservados I diseño Sendero</div>
</div>
</body>
</html>