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

<meta name="Description" content="Odontopraxis Americana s.a. Una Institución dedicada a brindar atención odontológica a grandes grupos poblacionales (Obra Social, Empresas Prepagas, etc) con una red de consultorios y clínicas dispersas por todo el País.

Ofrecemos:
Gracias a nuestro exclusivo sistema de Historia Clínica Unificada podemos brindar atención, control y seguimiento de los tratamientos en cualquier punto de nuestro país donde sea necesario acceder a una consulta odontológica">


<meta name="keywords" content="opam, odontopraxis americana, ceo, prestaciones odontológicas,">
<meta name="robots" content="index, follow, all">
<meta name="distribution" content="global">
<meta name="copyright" content="Estudio Sendero">
<meta http-equiv="Pragma" content="no-cache">
<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
<meta name="GOOGLEBOT" content="index, follow, all">
<meta http-equiv="content-language" content="es">
<meta name="AUTHOR" content="Estudio Sendero">


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
     <input type="button" value="Salir" onclick="location='index.php'" style="width:80px"></div></td>
  </tr>

  <tr>
    <td valign="top" bgcolor="#FFFFFF"><br />
 
<!--**************************************************-->
 
      <br />
      <br /> 
<?

function downloadFileEntidad($archivo){
  $target_path = CARPETAS_DIR.OS_FILE_SEPARATOR.$codigo.OS_FILE_SEPARATOR;
  $fichero = $target_path.$archivo;
  
  if (file_exists($fichero)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename='.basename($fichero));
            header('Content-Transfer-Encoding: binary');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($fichero));
            ob_clean();
            flush();
            readfile($fichero);
            exit;
  }

}

$codigo = $_SESSION['codigo'];

//print ('codigo: '|| $codigo);

if (isset($codigo) and $codigo !='' and $codigo != null){
  
  // open this directory 
  $target_path = CARPETAS_DIR.OS_FILE_SEPARATOR.$codigo.OS_FILE_SEPARATOR;
  if (file_exists($target_path)){
    if(! $myDirectory = opendir($target_path)){

    }else{
    // get each entry
    while(($entryName = readdir($myDirectory)) !== FALSE  ){
      $dirArray[] = $entryName;
    }
    // close directory
    closedir($myDirectory);
    //  count elements in array
    $indexCount = count($dirArray);

    }
  }
}
if ($indexCount < 3){
  ?>
      <h2 align="center"> Aun no tiene archivos disponibles, por favor intentelo más tarde. </h2>
<?
}else{

//Print ("$indexCount files<br>\n");
//sort 'em
sort($dirArray);

?>

 <h2 align="center"> Archivos disponibles:  </h2>
 
 <table id="tablaArchivos" border="0" cellspacing="0" cellpadding="0" align="center">
<thead>
  <tr bgcolor="#BCCCCC" height="25px">
      <td>Nombre</td>
      <td>Fecha</td>
      <td>Tamaño en KB</td>
      <td>Descargar</td>
   </tr>
</thead>
<tbody>


<?
  
  for($index=0; $index < $indexCount; $index++) {

  
    $nombre = $dirArray[$index];
    $tamanio = filesize($target_path.$nombre);
    if($nombre != '.' and $nombre != '..' ){
    $fecha = date ("Y/M/d H:i:s.", filemtime($target_path.$nombre));
    
    //$fecha_str = substr($fecha_actualizacion,6,2).'/'.substr($fecha_actualizacion,4,2).'/'.substr($fecha_actualizacion,0,4);
    //<a href=\"$dirArray[$index]\">$dirArray[$index]</a>
?>
    <tr>
       
        <td><?=$nombre?></td>
        <td><?=$fecha?></td>
        <td><?=$tamanio?></td>
        <td><a class="fileDownloadCustomRichExperience" href="downloadArchivo.php?id='<?=$nombre?>'"  > <img src="download-icon.png"></a></td>
    </tr>
    
<?
    }
  }
//  mysql_free_result($res);
?>
</tbody>
</table>

<?  } ?>

<script language="Javascript">

  $(document).ready(function(){
      var oTable = $('#tablaArchivos').dataTable();
  });

  
</script>

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
