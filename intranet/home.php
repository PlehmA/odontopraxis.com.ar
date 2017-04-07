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

<title>Intranet Odontopraxis Americana</title>
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

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="styles.css" type="text/css">
<link rel="stylesheet" href="css-d/contenido.css" type="text/css">
<link rel="stylesheet" href="css/jquery.dataTables.css" type="text/css">

<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/jquery.dataTables.js"></script>
</head>


<body>
<div class="header-logo" id="header-logo">
  <img src="img-d/logo.png" width="316" height="100" /></div>
  
<div class="header-placa" id="header-placa">
  <img src="img-d/banners2.jpg" width="601" height="100" />
</div>

<div class="titulo-sector-autogestion" id="titulo-sector-autogestion">INTRANET ODONTOPRAXIS
</div>

<div class="wrap2" id="wrap2">

<div class="col-iz2" id="col-iz2">
<div class="menu-iz2" id="menu-iz2">
    
<?php include"col-der.php"?>
<?php include"lat_izq.php"?>

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

                
                
                <table width="750" cellspacing="0" cellpadding="0" align="center">

                  <tr>
                    <td width="120" height="7" valign="top"><?if ($col2_imagen != ''){?>
                      <a href="nota.php?id=<?=$col2_id?>"><img src="<?=NOTICIAS_DIR . $col2_imagen?>" width="88%" height="90" border="0" align="absmiddle" /></a></td>
                    <td width="3" height="7"></td>
                    <td width="1" height="7" bgcolor="9699AA"></td>
                    <td width="6" height="7"></td>
                    <?}?>
                  <td width="501" height="7" valign="top"><img src="bullet.jpg" width="7" height="6" /><font face="Verdana, Arial, Helvetica, sans-serif" size="1"><b><font color="#000000"><a href="nota.php?id=<?=$col2_id?>"> <span class="contenido"><font color="#000000">
                      <?=$col2_titulo?>
                      </font></span></a></font></b></font><br />
                      <font color="#000000" face="Verdana, Arial, Helvetica, sans-serif" size="1"><span class="contenido">
                        <?=$col2_bajada?>
                        </span></font><font face="Verdana, Arial, Helvetica, sans-serif" size="1"><br />
                          <b><font color="9699AA"><a href="nota.php?id=<?=$col2_id?>"><font color="9699AA"><span class="contenido">Ver 
                            mas [+]</span></font></a></font></b></font></td>
                  </tr>
                  <tr>
                    <td colspan="5" height="6"></td>
                  </tr>
                  <tr bgcolor="#CCCCCC">
                    <td colspan="5" height="1"></td>
                  </tr>
                  <tr>
                    <td colspan="5" height="6"></td>
                  </tr>
                  
        
        
        
                  
                  
                </table>
               
  <?
		$col2_idx++;
	}
	mysql_free_result($col2_res);
?></td>
            </tr>


<table width="80%">
  <tr>
    <td></td>
      
    <td height="25" width="30%"><div align="right"><font face="Verdana, Arial, Helvetica, sans-serif" size="2"><b><font size="1"><a href="novedades.php"><font color="#000000">Ver 
                todas las noticias &gt;&gt;</font></a></font></b></font></div></td>
</table>

        
<tr>
    <td>
      <?php include"pie.php"?>
    </td>
</tr>

              

<!--final contenedor--></div>


</body>
</html>

