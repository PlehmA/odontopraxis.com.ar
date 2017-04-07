
<!DOCTYPE HTML>
<html>
<head>
<title>Odontopraxis Americana s.a.</title>
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
		        <li class="active"><a href="contratacion-personal-aux.php">Contratación de personal Auxiliar </a></li>
	          </ul>
	        </li>
		    <li><a href="contacto.php">Contacto</a></li>
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


<!-- cuerpo texto y foto -->
<div class="contenedor-img-tex" id="contenedor-img-tex">

  <div class="enviocvp" id="enviocvp">
  
<div class="titulocv" id="titulocv">Personal Administrativo</div>
Buscamos personal administrativo. Indispensable predisposición para trabajar en equipo y experiencia en el rubro.<br>
<br>
  <form name='formulario' id='formulario' method='post' action='enviar4.php' target='_self' enctype="multipart/form-data"> 
<p>Nombre<br>
  <input type='text' name='Nombre' id='Nombre'></p> 
<p>E-mail<br>
  <input type='text' name='email' id='email'>
<p>Asunto<br>
<input name='asunto' type='text' id='asunto' value="CV Administrativo" />
<p><br>
  Adjuntar C.V. 
  <input type='file' name='archivo1' id='archivo1'></p> 
<p>
<input type='submit' value='Enviar'> 
</p> 
</form></div>
  <div class="enviocvp" id="enviocv2p">
    <div class="titulocv" id="titulocv">Personal  para Atención al Público</div>
    Buscamos personal con predisposición para atención al público, cordial  y proactivo.  Valoramos la experiencia en puestos similares. <br>
  <br>
  <form name='formulario' id='formulario2' method='post' action='enviar5.php' target='_self' enctype="multipart/form-data">
    <p>Nombre<br>
      <input type='text' name='Nombre2' id='Nombre2'>
    </p>
    <p>E-mail<br>
      <input type='text' name='email2' id='email2'>
<p>Asunto<br>
<input name='asunto' type='text' id='asunto' value="CV Atención al público" />
<p><br>
      Adjuntar C.V.
      <input type='file' name='archivo2' id='archivo2'>
    </p>
    <p>
      <input type='submit' value='Enviar'>
    </p>
  </form>
  </div>
</div> <!-- FIN contenedor>
<!-- FIN cuerpo texto y foto -->

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
				  
				  <li><a href="ctribunales.html"> Consultorios tribunales&nbsp;  </a></li>
				  <li><a href="contacto.php"> Contacto&nbsp;  </a></li>
				  
				  <li><a href="/entidades/gestion-prestadores.php">Gestión de prestadores&nbsp; &nbsp; </a></li>
				  <li><a href="contratacion-personal.php">Contratación de personal &nbsp; &nbsp; </a></li>
				  <li><a href="contratacion-prof.php"> Contratación de profesionales&nbsp; &nbsp;  </a></li>
				  <li><a href="contratacion-personal-aux.php"> Contratación de personal auxiliar&nbsp; &nbsp; </a></li>
                  
                  <li><a href="/intranet/" target="_blank">INGRESO A INTRANET&nbsp; &nbsp;</a></li>

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
            <img src="web/images/facebook.png" width="65" height="56"> <img src="web/images/mobilepublicinfo.jpg" width="63" height="59"></div>
            
			<div class="clear"></div>
            
		</div>
        

	</div>
</div>

<div class="separador" id="separador"></div>

<div class="piecopy" id="piecopy">Odontopraxis Americana 2014® Todos los derechos reservados I diseño <a href="http://www.estudiosendero.com.ar" target="_blank">Estudio Sendero</a></div>
</div>
</body>
</html>