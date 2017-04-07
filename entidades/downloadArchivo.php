<?php
  include ('lib.php');
  include ('checks.php');
  include ('conect.php');

if (isset($_GET['id']) and isset($_GET['d']) ){
        $archivo = $_GET['id'];
        $archivo = substr($archivo, 1, strlen($archivo)-2);
        $codigo = $_SESSION['codigo']; 
    //  print $id;
    
        $dir = $_GET['d'];
   //     print $dir;
   //     $target_path = CARPETAS_DIR.OS_FILE_SEPARATOR;
        switch ($dir) {
            case 'n':
            $target_path = CARPETAS_DIR.OS_FILE_SEPARATOR.CARPETA_NOV.OS_FILE_SEPARATOR;
            break;
            case 'l':
            $target_path = CARPETAS_DIR.OS_FILE_SEPARATOR.$codigo.OS_FILE_SEPARATOR.CARPETA_LIQ.OS_FILE_SEPARATOR;
            break;
            case 'r':
            $target_path = CARPETAS_DIR.OS_FILE_SEPARATOR.$codigo.OS_FILE_SEPARATOR.CARPETA_RES.OS_FILE_SEPARATOR;
            break;                          
        }   

  //  print($target_path.$archivo);
        $fichero = $target_path.$archivo;

        
        if (file_exists($fichero)) {
          //  print('el fichero existe');
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
        }else{
           // print ('el fichero no existe');
        }
}else{    ?>
    
        <META HTTP-EQUIV="Refresh" CONTENT="0; URL=entidades-home.php">
        
    <?
        return;
}

?>