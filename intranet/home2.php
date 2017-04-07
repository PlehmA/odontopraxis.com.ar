<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        
<link href="css-d/style2.css" rel="stylesheet" type="text/css" media="all" />

<?
include ('lib.php');
include ('checks.php');


$MAX_NEWS = 2;
$RED_FONT = "font-family: Arial, Helvetica, sans-serif; font-size: 11px; color: red";


include ('conect.php');


$TABLA = DB_PREFIX . "usuarios" ;

function getSector($id){
	$sql = "SELECT nombre AS nombre FROM sector WHERE id = $id";
	//print $sql."</br>";
	$sector = null;
	$res = mysql_query($sql);
	if ($res){
		$sector = mysql_result($res,0,'nombre');
		mysql_free_result($res);
	}
	return $sector;
}



function getEdificio($id){
	$sql = "SELECT nombre AS nombre FROM edificio WHERE id = $id";
	//print $sql."</br>";
	$edificio = null;
	$res = mysql_query($sql);
	if ($res){
		$edificio = mysql_result($res,0,'nombre');
		mysql_free_result($res);
	}
	return $edificio;
}

?>

<title>Documento sin t&iacute;tulo</title>
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
<div class="col-iz2" id="col-iz2">
  <div class="menu-iz2" id="menu-iz2">
    

<?php include"lat_izq2.php"?>

</div>
</div>


<div class="contenedor-centro" id="contenedor-centro"> <!--contenedor-->


            <td width="15"></td>
            <!--<td><font face="Verdana, Arial, Helvetica, sans-serif" size="2"><b><a href="prensa.php"><font color="#FFFFFF" size="1">PRENSA 
                              Y EVENTOS</font></a></b></font></td>-->
          </tr>
          <tr>
            
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="12" valign="top" background="main_izq.jpg"></td>
        <td>

<tr> </tr>
            <tr>
              <td height="10"></td>
            </tr>
<tr>
              <td height="1" valign="top"><?
	$col2_sql = "SELECT * FROM " . DB_PREFIX . "noticias ";
	$col2_sql.= " WHERE publicado = 'S' ";
	$col2_sql.= " ORDER BY fecha DESC, id DESC ";
	$col2_sql.= " LIMIT 3 ";
	
	$col2_res = mysql_query($col2_sql);
	$col2_total = mysql_num_rows($col2_res);

	$col2_idx = 0;
	while ($col2_idx < $col2_total)	{

		$col2_id = mysql_result($col2_res, $col2_idx,'id');
		$col2_fecha = mysql_result($col2_res, $col2_idx,'fecha');
		$col2_titulo = mysql_result($col2_res, $col2_idx,'titulo');
		$col2_bajada = mysql_result($col2_res, $col2_idx,'bajada');
		$col2_imagen = mysql_result($col2_res, $col2_idx,'imagen');
		$col2_fecha_str = substr($col2_fecha,6,2).'-'.substr($col2_fecha,4,2).'-'.substr($col2_fecha,0,4);
		
		if ($col2_idx > 0)	{
?>
                <?
		}
?>
<?
		$col2_idx++;
	}
	mysql_free_result($col2_res);
?></td>
            </tr>

<!--final contenedor-->
</div>


</body>
</html>

