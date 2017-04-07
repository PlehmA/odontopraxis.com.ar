<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

    <html xmlns="http://www.w3.org/1999/xhtml">
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        

<link href="css/style3.css" rel="stylesheet" type="text/css" media="all" />




<?
  include ('lib.php');
  include ('checks.php');
  include ('conect.php');
 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<link rel="stylesheet" href="css/jquery.dataTables.css" type="text/css">

<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/jquery.dataTables.js"></script>
<script src="js/jquery.fileDownload.js"></script>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-42854179-1', 'opam.com.ar');
  ga('send', 'pageview');

</script>


<title>Documento sin título</title>
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
  Bienvenidos al sistema de Utilidades de Odontopraxis Americana 
  
  p= <?=$_SESSION['prestador']?> <br />
  c=<?=$_SESSION['cuit']?> <br />
  e=<?=$_SESSION['email']?> <br />
  e=<?=$_SESSION['codigo']?> <br />
  

  
  
  
  </p>
  <div class="titulo-sector-autogestion" id="titulo-sector-autogestion"><br />
  </div>
</div>
<br />
<div class="wrap2" id="wrap2">
  <div class="col-iz2" id="col-iz2">
    <div class="menu-iz2" id="menu-iz2">
      <div class="titulos-autogestion" id="titulos-autogestion"><strong>Perfil</strong></div>
      <div class="titulo-autogestion2" id="titulo-autogestion2">UTILIDADES</div>
      <p>&gt;<a href="actualizar-datos.php"> Actualizar datos personales</a></p>
      <p>&gt; <a href="abm-consultorio.php">ABM de consultorio</a><a href="datos-contacto.php"></a></p>
      <p>&gt; <a href="abm-impositivos.php">ABM datos impositivos</a><a href="datos-contacto.php"></a></p>
      <p>&gt; <a href="comprobantes-vencimiento.php">Comprobantes con vencimiento</a><a href="form-malapraxis.php"></a></p>
      <div class="titulo-autogestion2" id="titulo-autogestion3"> NOVEDADES </div>
      <p>&gt; <a href="novedades.php">Novedades</a></p>
      <p><a href="novedades.html"><br />
      </a> </p>
      <tr>
        <td valign="top" bgcolor="#FFFFFF"><input type="button" value="Salir" onclick="location='index.php?g=1'" style="width:80px" /></td>
      </tr>
    </div>
    </td>
    </tr>
  </div>
</div>
  
<br />
<br />
<br />
<br />
<div class="pie" id="pie">Odontopraxis Americana 2014® Todos los derechos reservados  diseño Sendero </div>
</body>
    </html>

