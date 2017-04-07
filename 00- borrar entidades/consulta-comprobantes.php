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
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        

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
  <div class="titulo-sector-autogestion" id="titulo-sector-autogestion">CONSULTA DE COMPROBANTES</div>
</div>
<br />
<div class="wrap2" id="wrap2">


  <div class="col-iz2" id="col-iz2">
    <div class="menu-iz2" id="menu-iz2">
      <div class="titulos-autogestion" id="titulos-autogestion"><strong>Gestión online</strong></div>
      <div class="titulo-autogestion2" id="titulo-autogestion2">UTILIDADES</div>
      <p>&gt; <a href="https://prepaga.odontopraxis.com.ar/PREPAGA/pages/login.faces" target="blank">Validación / Carga de  Prestaciones</a></p>
      <p>&gt; <a href="entidades-home.php">Consulta de liquidación</a></p>
      <p>&gt; <a href="resumen-liquidacion.php">Resúmen de liquidación</a><br />
<div class="inhibido" id="inhibido">&gt; Consulta de comprobantes</div>
      <div class="titulo-autogestion2" id="titulo-autogestion">SOLICITUDES</div>
      <p>&gt;<a href="actualizar-datos.php"> Actualizar datos personales</a></p>
      <p>&gt; <a href="abm-consultorio.php">ABM de consultorio</a><a href="datos-contacto.php"></a></p>
      <p>&gt; <a href="abm-impositivos.php">ABM datos impositivos</a><a href="datos-contacto.php"></a></p>
      <p>&gt; <a href="comprobantes-vencimiento.php">Comprobantes con vencimiento</a><a href="form-malapraxis.php"></a></p>
<div class="titulo-autogestion2" id="titulo-autogestion3"> NOVEDADES </div>
<a href="novedades.php">&gt; Novedades</a>
      <p>&nbsp;</p>
      <p><a href="novedades.html">
        </a>
      </p>
      
         <td valign="top" bgcolor="#FFFFFF">
    <input type="button" value="Salir" onclick="location='index.php?g=1'" style="width:80px"></div></td>
    
    </div>
    </td>
    </tr>

    </div>
  </div>
</div>

<div class="col-der2" id="col-der2">


<!--**************************************************-->
 
      <br />
      <br /> 
<?

function downloadFileEntidad($archivo){
  $target_path = CARPETAS_DIR.OS_FILE_SEPARATOR.$codigo.OS_FILE_SEPARATOR.CARPETA_CONTABLE.OS_FILE_SEPARATOR;
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



  // open this directory 
  $codigo = $_SESSION['codigo'];
  $target_path = CARPETAS_DIR.OS_FILE_SEPARATOR.$codigo.OS_FILE_SEPARATOR.CARPETA_CONTABLE.OS_FILE_SEPARATOR;
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

if ($indexCount < 3){
  ?>
      <h2 align="center"> Aun no tiene archivos disponibles. </h2>
<?
}else{

//Print ("$indexCount files<br>\n");
//sort 'em
sort($dirArray);

?>

 
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
        <td><a class="fileDownloadCustomRichExperience" href="downloadArchivo.php?d=r&id='<?=$nombre?>'"  > <img src="download-icon.png"></a></td>
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
<br />
<br />
<div class="pie" id="pie">Odontopraxis Americana 2014® Todos los derechos reservados  diseño Sendero </div>
</body>
    </html>

