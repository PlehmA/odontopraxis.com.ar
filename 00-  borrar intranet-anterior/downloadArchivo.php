<?php
include ('lib.php');
include ('conect.php');

if (isset($_GET['id'])) {
        $id = $_GET['id'];
    //  print $id;
    
  
    $sql = "SELECT archivo FROM archivos where id= ".$id." and activo='S'";
   // print $sql;
    $res = mysql_query($sql);
    $total = mysql_num_rows($res);
    if($total == 1){
        $archivo = mysql_result($res, $idx,'archivo');
        $target_path = CARPETAS_DIR.OS_FILE_SEPARATOR;
      //  print($archivo);
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
    }else{
    ?>
    
        <META HTTP-EQUIV="Refresh" CONTENT="0; URL=listadoCarpetas.php">
        
    <?
        return;
    }
}else{    ?>
    
        <META HTTP-EQUIV="Refresh" CONTENT="0; URL=listadoCarpetas.php">
        
    <?
        return;
}

?>