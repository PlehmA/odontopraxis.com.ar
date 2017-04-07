<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-42854179-1', 'opam.com.ar');
  ga('send', 'pageview');

</script>

<meta name="Description" content="Odontopraxis Americana s.a. Una Institución dedicada a brindar atención odontológica a grandes grupos poblacionales (Obra Social, Empresas Prepagas, etc) con una red de consultorios y clínicas dispersas por todo el País.

Ofrecemos:
Gracias a nuestro exclusivo sistema de Historia Clínica Unificada podemos brindar atención, control y seguimiento de los tratamientos en cualquier punto de nuestro país donde sea necesario acceder a una consulta odontológica">


<meta name="keywords" content="opam, odontopraxis americana, ceo, prestaciones odontológicas,">
<?
include ('lib.inc');
include ('conect.inc');
$accion = null;
$here = "olvidoPassEntidad.php";
$RED_FONT = "font-family: Arial, Helvetica, sans-serif; font-size: 11px; color: red";
if (isset($_GET['accion']))   {
  $accion=$_GET['accion'];
}

$TABLA = "admin" ;
?>

<meta name="robots" content="index, follow, all">
<meta name="distribution" content="global">
<meta name="copyright" content="Estudio Sendero">
<meta http-equiv="Pragma" content="no-cache">
<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
<meta name="GOOGLEBOT" content="index, follow, all">
<meta http-equiv="content-language" content="es">
<meta name="AUTHOR" content="Estudio Sendero">


<script type="text/javascript" src="jquery-1.4.2.js"></script>
<script type="text/javascript" src="coin-slider.min.js"></script>
<script src="util/validations.js"></script>
<link rel="stylesheet" href="coin-slider-styles.css" type="text/css" />


<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Odontopraxis s.a.</title>

<link href="estilos-odontopraxis.css" rel="stylesheet" type="text/css" />
</head>

<style>
A:link {
  text-decoration: none;
  color: #FFFFFF;
} 


A:visited {
  text-decoration: none;
  color: #FFFFFF;
} 


A:active {
  text-decoration: none;
  color: #FFFFFF;
} 

A:hover {
  text-decoration: none;
  color: #666666;
} 


</style>
<body bgcolor="#7190BE">
<table width="920" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="135" bgcolor="#FFFFFF"><img src="img/header-odontopraxis.jpg" width="919" height="155" alt="Odontopraxis sa." /></td>
  </tr>
  <tr>
    <td valign="top" bgcolor="#FFFFFF"><br />
 
<!--**************************************************-->
 
      <br />
      <br /> 
      <h2 align="center"> Ingreso a la Administraci&oacuten de Contenidos  </h2>
 
 <?

///////////////////////////////////////////////
// Alta de registro
if ($accion == 'MAIL')  {

  $email = addSlashes($_POST['email']);
  $total = 0;
  $sql = "SELECT * FROM $TABLA WHERE email = LOWER('$email') and sitio = '".SITIO."'";
//  print $sql;
  $res = mysql_query($sql);
 // print $res;
  if($res){
    $total = mysql_num_rows($res);
    if ($total == 1){
      $usuario = mysql_result($res,0,'usuario');
      $clave = mysql_result($res,0,'clave');
          }
  }
  mysql_free_result($res);
 // print $total;
    
  if ($total != 1)  // el usuario no existe
  {
    
    ?>
    <body onload="document.forms['data'].submit();">
        <form name="data" action="<?=$here?>?error=1" method="POST">
          <input type="hidden" name="email" value="<?=$email?>">
        </form>
    </body>   
      
    <?
    return;
  }
    
  $bodyMail = "Se solicitó recuperar su clave, si usted no lo hizo, por favor contactarse con el administrador \n"; 
  $bodyMail = $bodyMail."Tus datos de acceso son: \n";
  $bodyMail = $bodyMail."Usuario: ".$usuario."\n";
  $bodyMail = $bodyMail."Contraseña: ".$clave."\n";

  mail($email,"Backend Clave Recuperada",$bodyMail,"From: odontopraxis");

  ?>
    <div style="margin: 0 auto;width: 463px;">
      Gracias! Se envió un mail con la contraseña</br> 
      <input type="button" name="boton" value="Seguir" onclick="location='index.php'" style="width:100px"/>
      </div>
  
    
  <?
    
//  return;
}



///////////////////////////////////////////////
// Formulario Registro
if (($accion == null))  {
  
  $id = "";
  $targetAction = "MAIL";
  $page_title = "Recuperar Contraseña";
  $err = "";

  
  $dni = "";
  $fecha_reg = "";
  $nombre = "";
  $clave = "";
  $apellido = "";
  $sector = "";
  $edificio = "";
  $email = "";
  $validado = "";
  $bloqueado = "";
  
  $backpage = $here;
  
    $fecha_reg = date("d-m-Y  H:m:s");
    
    if (isset($_GET['error']))
    {
      $err = "No existe usuario con el email, intente nuevamente";
    }
  
  
?>

<?if ($err != ''){?><p align="center" class="menu2_abm"><font color="red">Error: <b><?=$err?></b></font></p><?}?>


 <form method="post" action="<?=$here?>?accion=<?=$targetAction?>" name="data" enctype="multipart/form-data">
 
   <table border="0" cellspacing="0" cellpadding="0" align="center">

      <tr> 
        <td valign="middle" align="right" class="menu2_abm">E-mail&nbsp;&nbsp;</td>
        <td valign="top" > 
          <input type="text" class="menu2_abm" name="email" size="30" maxlength="25" value="" onblur="this.value=Trim(this.value);">
        </td>
      </tr>
      <tr><td height="10"></td></tr>
      <tr bgcolor="#BCCCCC"><td colspan="3"></td></tr>
   
   </table>
 
  </form>
<br>
<p align=center>
  
  <input type="button" name="boton2" value="Enviar" onclick="return verificar()" style="width:100px"/>
</p>


<br>
<br>

<script language="JavaScript">

  function verificar()  {
    
    var form = document.forms['data'];
    
      
    if (form.elements['email'].value == "") {
      form.elements['email'].focus();
      alert("Debe ingresar la direcci&oacuten de e-mail.");
      return false;
    }
    else
    {
      if (!checkEmail(form.elements['email'].value))
      {
        form.elements['email'].focus();
        alert("La direcci&oacuten de e-mail no es v&aacutelida.");
        return false;
      }
    }
    
    form.submit();
    return true;
  }
  
  

</script>
<?}?>


    <br />
    <br />    
    
    
    
<!--**************************************************-->

    
    </td>
  </tr>
  <tr>
    <td align="center" bgcolor="#7190BE"><table width="920" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td width="116" align="center" bgcolor="#CCCCCC"><a href="http://www.facebook.com/opamsa?fref=ts" target="_blank"><img src="img/facebook.png" width="46" height="45" alt="facebook link odontopraxis" /></a></td>
        <td width="665" height="140" align="center" bgcolor="#CCCCCC"><span class="textofooter">Av. Córdoba 1345  Piso 13 º  A - C.A.B.A. Tel / Fax: 011 4811-5555 (líneas rotativas) <br />
          mail: <a href="mailto:coordinacion@odontopraxis.com.ar">informes@odontopraxis.com.ar</a></span><br />
          <br />
          <span class="mapadelsitio">Mapa del sitio: &nbsp; <a href="index.html">Empresa&nbsp; I&nbsp; </a><a href="servicios.html">Servicios</a><a href="index.html">&nbsp;I&nbsp; </a><a href="brindamos.html">Brindamos</a><a href="index.html">&nbsp;I&nbsp; </a><a href="consultorios-tribunales.html">Consultorios   tribunales</a><a href="index.html">&nbsp;I&nbsp; </a><a href="contacto.php">Contacto</a><a href="index.html">&nbsp;I&nbsp;Prestadores  I&nbsp; Personal&nbsp; I&nbsp; </a><a href="contratacion-prof.php">Contratación de <br />
profesionales</a> <a href="index.html">I</a> <a href="contratacion-pers.html">Contratación de personal auxiliar</a></span></td>
        <td width="125" align="center" bgcolor="#CCCCCC"><img src="img/mobilePublicInfo.jpg" width="74" height="74" alt="afip codigo" /></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td align="center" bgcolor="#7190BE"><span class="derechos">Odontopraxis Americana 2012 / 2013® Todos los derechos reservados I <a href="http://www.estudiosendero.com.ar" target="_blank">diseño Sendero</a></span></td>
  </tr>
</table>
</body>
</html>
