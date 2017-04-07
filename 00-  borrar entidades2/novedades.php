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
  Bienvenidos al sistema de autogestión de Odontopraxis Americana</p>
  <div class="titulo-sector-autogestion" id="titulo-sector-autogestion">NOVEDADES<br />
  Descargue las últimas novedades</div>
</div>
<br />
<div class="wrap2" id="wrap2">


  <div class="col-iz2" id="col-iz2">
    <div class="menu-iz2" id="menu-iz2">
      <div class="titulos-autogestion" id="titulos-autogestion"><strong>Gestión online</strong></div>
      <div class="titulo-autogestion2" id="titulo-autogestion2">UTILIDADES</div>
      <p>&gt; <a href="http://200.68.69.229:8080/PREPAGA/" target="blank">Acceso a prestadores</a></p>
      <p>&gt; <a href="entidades-home.php">Consulta de liquidación</a></p>
      <p>&gt; <a href="resumen-liquidacion.php">Resúmen de liquidación</a></p>
      <div class="titulo-autogestion2" id="titulo-autogestion">SOLICITUDES</div>
      <p>&gt; <a href="cartilla.php">Solicitud de cartilla</a></p>
      <p>&gt; <a href="datos-contacto.php">Actualizar datos de contacto</a></p>
      <p>&gt; <a href="form-malapraxis.php">Envío de seguros de mala praxis</a></p>
      <div class="titulo-autogestion2" id="titulo-autogestion3"> NOVEDADES </div>
      <div class="inhibido" id="inhibido">&gt; Novedades</div>
      <p>&nbsp;</p>
      <p><a href="novedades.html"><br />
        </a><br />
      </p>

      <tr>
    <td valign="top" bgcolor="#FFFFFF"><br />
     <input type="button" value="Salir" onclick="location='index.php?g=1'" style="width:80px"></div></td>
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
  $target_path = CARPETAS_DIR.OS_FILE_SEPARATOR.CARPETA_NOV.OS_FILE_SEPARATOR;
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
  $target_path = CARPETAS_DIR.OS_FILE_SEPARATOR.CARPETA_NOV.OS_FILE_SEPARATOR;
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
      <h2 align="center"> Aun no hay novedades disponibles, por favor intentelo más tarde. </h2>
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
        <td><a class="fileDownloadCustomRichExperience" href="downloadArchivo.php?d=n&id='<?=$nombre?>'"  > <img src="download-icon.png"></a></td>
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

