<?
	include ('lib.php');
	include ('conect.php');
//	$buscar= isset($_GET['b']) ? $_GET['b'] : "";
	
	$ITEMS_POR_PAGINA = 3;
	$buscar = null;
	if (isset($_GET['b']))
		$buscar = $_GET['b'];
	
	$pagina_param = ((isset($_GET['p'])) && (is_numeric($_GET['p']))) ? $_GET['p'] : '1';
	
	/*
	$sql = "SELECT COUNT(*) AS cant FROM " . DB_PREFIX . "noticias ";
	$sql.= " WHERE publicado = 'S' ";
	$sql.= " AND titulo LIKE '%$buscar%'";
	$res = mysql_query($sql);
	$cant = mysql_result($res, 0, 'cant');
	mysql_free_result($res);
	*/
	
	$cant = 0;
	if (is_null($buscar))
	{
		$sql = "SELECT COUNT(*) AS cant FROM " . DB_PREFIX . "noticias ";
		$sql.= " WHERE publicado = 'S' ";
	//	print "sql: $sql<br>";
		$res = mysql_query($sql);
		$cant = mysql_result($res, 0, 'cant');
		mysql_free_result($res);
	} else {
		$sql = "(";
		$sql.=   "SELECT COUNT(*) AS cant FROM " . DB_PREFIX . "noticias ";
		$sql.=   " WHERE publicado = 'S' ";
		$sql.=   " AND titulo LIKE '%$buscar%'";
		$sql.= ") UNION (";
		$sql.=   "SELECT COUNT(*) AS cant FROM " . DB_PREFIX . "paginasidx ";
		$sql.=   " WHERE habilitado = 'S' ";
		$sql.=   " AND (texto LIKE '%$buscar%' OR texto LIKE '%$buscar%') ";
		$sql.= ")";
	//	print "sql: $sql<br>";
		$res = mysql_query($sql);
		$total = mysql_num_rows($res);
		for ($i = 0; $i < $total; $i++)
			$cant += mysql_result($res, $i, 'cant');
		mysql_free_result($res);
		
	}
//	print "cant: $cant<br>";
	
	
	$pageInfo = getPageSettings(NOTICIAS_ITEMS_POR_PAGINA, $cant, $pagina_param);
//	$pageInfo = getPageSettings(3, $cant, $pagina_param);
//	print_r ($pageInfo);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        
<link href="css-d/style2.css" rel="stylesheet" type="text/css" media="all" />

<?

include ('checks.php');


$MAX_NEWS = 2;
$RED_FONT = "font-family: Arial, Helvetica, sans-serif; font-size: 11px; color: red";





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
<div class="header-logo" id="header-logo">
  <img src="img-d/logo.png" width="316" height="100" /></div>
  
<div class="header-placa" id="header-placa">
  <img src="img-d/banners2.jpg" width="601" height="100" />
</div>

<div class="titulo-sector-autogestion" id="titulo-sector-autogestion">INTRANET ODONTOPRAXIS
</div>


<div class="col-iz2" id="col-iz2">
<div class="menu-iz2" id="menu-iz2">
    
<?php include"col-der.php"?>
<?php include"lat_izq.php"?>

</div>
</div>


<div class="contenedor-centro" id="contenedor-centro"> <!--contenedor-->

      

  
                            <td></table>&nbsp; 
                      <font face="Verdana, Arial, Helvetica, sans-serif" size="2"><b><font color="9699AA">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Todos los Destacados</font></b></font>                            <td valign="top" background="main_izq.jpg"><table width="90%" border="0" cellspacing="0" cellpadding="0" align="center">
                        <tr></tr>
                        <tr>
                          
                        </tr>
                        <!--<tr> 
                            <td> 
                              <div align="center"><img src="banners_soluciones.jpg" width="501" height="125"></div>
                            </td>
                          </tr>-->
                        <tr>
                          <td valign="top"><table width="94%" border="0" cellspacing="0" cellpadding="0" align="center">
                            <tr>
                              <td><div align="right"></div></td>
                            </tr>
                            <tr>
                              <td height="8"></td>
                            </tr>
                            <tr>
                              <td valign="top"><div align="left">
                                <?
	
	/*
	$sql = "SELECT * FROM " . DB_PREFIX . "noticias ";
	$sql.= " WHERE publicado = 'S'";
	$sql.= " AND titulo LIKE '%$buscar%'";
	$sql.= " ORDER BY fecha DESC, id DESC";
//	$sql.= " LIMIT " . $pageInfo['FIRST_ITEM'] . "," . $pageInfo['LAST_ITEM'] ;
	
	$res = mysql_query($sql);
	$total = mysql_num_rows($res);
	*/

	if (is_null($buscar))
	{
		$sql = "SELECT id, fecha, titulo, SUBSTRING(bajada, 1, 200) AS bajada,  '' AS url, 'noticia' AS tipo ";
		$sql.= " FROM " . DB_PREFIX . "noticias ";
		$sql.= " WHERE publicado = 'S'";
		$sql.= " AND titulo LIKE '%$buscar%'";
		$sql.= " ORDER BY fecha DESC, id DESC";
	}
	else {
		$sql = "(";
		$sql.=   "SELECT id, fecha, titulo, SUBSTRING(bajada, 1, 200) AS bajada, '' AS url, 'noticia' AS tipo ";
		$sql.=   " FROM " . DB_PREFIX . "noticias ";
		$sql.=   " WHERE publicado = 'S' ";
		$sql.=   " AND titulo LIKE '%$buscar%'";
		$sql.= ") UNION (";
		$sql.=   "SELECT id, '' AS fecha, titulo, SUBSTRING(texto, 1, 200) AS bajada, fullurl AS url, 'pagina' AS tipo ";
		$sql.=   " FROM " . DB_PREFIX . "paginasidx ";
		$sql.=   " WHERE habilitado = 'S' ";
		$sql.=   " AND (texto LIKE '%$buscar%' OR texto LIKE '%$buscar%') ";
		$sql.= ")";
	}
//	print "sql: $sql<br>";
	$res = mysql_query($sql);
	$total = mysql_num_rows($res);
//	print "pageInfo: "; print_r($pageInfo); print("<br>");


//	$idx = 0;
//	while ($idx < $total)	{
	$idx = $pageInfo['FIRST_ITEM']-1;
	while ($idx < $pageInfo['LAST_ITEM'])	{

		$id = mysql_result($res, $idx,'id');
		$fecha = mysql_result($res, $idx,'fecha');
		$titulo = mysql_result($res, $idx,'titulo');
		$bajada = mysql_result($res, $idx,'bajada');
		$url = mysql_result($res, $idx,'url');
		$tipo = mysql_result($res, $idx,'tipo');
		
		$fecha_str = substr($fecha,6,2).'-'.substr($fecha,4,2).'-'.substr($fecha,0,4);
		
		if ($tipo == 'noticia')
			$url = "nota.php?id=" . $id ;
		
		if ($idx > 0)	{
?>
                                <?
		}
?>
                                <table width="90%" border="0" cellspacing="0" cellpadding="0" align="center">
                                  <tr>
                                    <td colspan="2"><font face="Verdana, Arial, Helvetica, sans-serif" size="2"><b><font color="9699AA">
                                    </font></b></font></td>
                                  </tr>
                                  <tr>
                                    <td valign="top"><img src="bullet.jpg" width="7" height="7" /><font face="Verdana, Arial, Helvetica, sans-serif" size="1"><b><font color="#000000"><a href="nota.php?id=<?=$id?>"> <span class="contenido"><font color="#000000">
                                      <?=$titulo?>
                                      </font></span></a></font></b></font><br />
                                      <font color="#000000" face="Verdana, Arial, Helvetica, sans-serif" size="1"><span class="contenido">
                                        <?=$bajada?>
                                        </span></font><font face="Verdana, Arial, Helvetica, sans-serif" size="1"><br />
                                          <b><font color="9699AA"><a href="nota.php?id=<?=$id?>"><font color="9699AA"><span class="contenido">Ver 
                                            mas [+]</span></font></a></font></b></font></td>
                                  </tr>
                                  <tr>
                                    <td colspan="2" height="10"></td>
                                  </tr>
                                  <tr bgcolor="#CCCCCC">
                                    <td colspan="2" height="1"></td>
                                  </tr>
                                  <tr>
                                    <td colspan="2" height="10"></td>
                                  </tr>
                                </table>
                                <?
		$idx++;
	}
	mysql_free_result($res);
?>
                              </div></td>
                            </tr>
                            <tr>
                              <td valign="top" height="10"><div align="right"></div></td>
                            </tr>
                          </table>
                            <table width="80%" border="0" cellspacing="0" cellpadding="0" align="center">
                              <tr>
                                <td width="10">&nbsp;</td>
                                <td><!--
                    <div align="center">&lt;&lt;anterior 1 2 3 4 5 6 7 8 9 10 siguiente&gt;&gt;</div>
                  -->
                                  <div align="center"><font face="Verdana, Arial, Helvetica, sans-serif" size="1">
                                    <?
				        $buscar_param = "";
				        if (!is_null($buscar))
				        	$buscar_param = "b=" . $buscar . "&";
				        
				        if ($pageInfo['ITEM_NUMBER'] > 0)
				        {
					        if ($pageInfo['CURR_PAGE'] > $pageInfo['FIRST_PAGE'])
					        	echo "<a href=\"" . $_SERVER['PHP_SELF'] . "?" . $buscar_param . "p=" . ($pageInfo['CURR_PAGE'] - 1) . "\">&lt;&lt;anterior</a>";
					        else
					        	echo "&lt;&lt;anterior";
					        echo "&nbsp;";
					        
					        for ($i = $pageInfo['FIRST_PAGE']; $i <= $pageInfo['LAST_PAGE']; $i++)
					        {
					        	if ($i != $pageInfo['CURR_PAGE'])
					        		echo "&nbsp;<a href=\"" . $_SERVER['PHP_SELF'] . "?" . $buscar_param . "p=" . $i . "\">" . $i . "</a>";
								else
									echo "&nbsp;<b>" . $i . "</b>";
					        }
					        echo "&nbsp;&nbsp;";
					        if ($pageInfo['CURR_PAGE'] < $pageInfo['LAST_PAGE'])
					        	echo "<a href=\"" . $_SERVER['PHP_SELF'] . "?" . $buscar_param . "p=" . ($pageInfo['CURR_PAGE'] + 1) . "\">siguiente&gt;&gt;</a>";
					        else
					        	echo "siguiente&gt;&gt;";
				    	}
				    	?>
                                  </font></div></td>
                                <td width="10">&nbsp;</td>
                              </tr>
                            </table>
                            <p><font face="Verdana, Arial, Helvetica, sans-serif" size="1"></font></p></td>
                        </tr>
                      </table>
                        <br>
<br>                      </td>
                  </table>
                  
                  <!--final contenedor--></div>

</body>
</html>
