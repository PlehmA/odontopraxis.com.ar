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
	$sql = "SELECT COUNT(*) AS cant FROM " . DB_PREFIX . "prensa ";
	$sql.= " WHERE publicado = 'S' ";
	$sql.= " AND titulo LIKE '%$buscar%'";
	$res = mysql_query($sql);
	$cant = mysql_result($res, 0, 'cant');
	mysql_free_result($res);
	*/
	
	$cant = 0;
	if (is_null($buscar))
	{
		$sql = "SELECT COUNT(*) AS cant FROM " . DB_PREFIX . "prensa ";
		$sql.= " WHERE publicado = 'S' ";
	//	print "sql: $sql<br>";
		$res = mysql_query($sql);
		$cant = mysql_result($res, 0, 'cant');
		mysql_free_result($res);
	} else {
		$sql = "(";
		$sql.=   "SELECT COUNT(*) AS cant FROM " . DB_PREFIX . "prensa ";
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
<html>
<head>
<title>Accusys</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="contenido.css" type="text/css">
</head>
<body bgcolor="#FFFFFF" text="#000000" topmargin="0" leftmargin="0">
<table width="976" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr> 
    <td> 
      <?php include"header.php"?>
    </td>
  </tr>
  <tr> 
    <td height="5"> 
      
    </td>
  </tr>
  <tr> 
    <td> 
      <?php include"menu_ac.php"?>
    </td>
  </tr>
  <tr> 
    <td> 
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr> 
          <td width="130" valign="top"> 
            <?php include"lat_izq.php"?>
          </td>
          <td width="1" valign="top" bgcolor="9298AB"><img src="pixel.gif"></td>
          <td valign="top"> 
            <table width="593" border="0" cellspacing="0" cellpadding="0" align="center">
              <tr>
                <td background="main_top.jpg">
<table width="593" border="0" cellspacing="0" cellpadding="0" height="39">
                    <tr>
                      <td>
                        <table width="90%" border="0" cellspacing="0" cellpadding="0" align="center">
                          <tr>
                            <td height="10"></td>
                          </tr>
                          <tr>
                            <td><font face="Verdana, Arial, Helvetica, sans-serif" size="2"><b><font color="9699AA">PRENSA</font></b></font></td>
                          </tr>
                        </table>
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>
              <tr>
                <td>
                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td width="12" valign="top" background="main_izq.jpg"><img src="main_izq.jpg" width="12" height="22"></td>
                      <td valign="top"> 
                        <table width="90%" border="0" cellspacing="0" cellpadding="0" align="center">
                          <tr> 
                            <td>&nbsp;</td>
                          </tr>
                          <tr> 
                            <td> 
                              <div align="center"><img src="banners_soluciones.jpg" width="501" height="125"></div>
                            </td>
                          </tr>
                          <tr>
                            <td>&nbsp;</td>
                          </tr>
                          <tr> 
                            <td valign="top"> 
                              <table width="94%" border="0" cellspacing="0" cellpadding="0" align="center">
                                <tr> 
                                  <td height="10"></td>
                                </tr>
                                <tr> 
                                  <td height="2"> 
                                    <div align="right"></div>
                                  </td>
                                </tr>
                                <tr> 
                                  <td height="8"></td>
                                </tr>
                                <tr> 
                                  <td valign="top"> 
                                    <div align="left"> 
                                      <?
	
	/*
	$sql = "SELECT * FROM " . DB_PREFIX . "prensa ";
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
		$sql.= " FROM " . DB_PREFIX . "prensa ";
		$sql.= " WHERE publicado = 'S'";
		$sql.= " AND titulo LIKE '%$buscar%'";
		$sql.= " ORDER BY fecha DESC, id DESC";
	}
	else {
		$sql = "(";
		$sql.=   "SELECT id, fecha, titulo, SUBSTRING(bajada, 1, 200) AS bajada, '' AS url, 'noticia' AS tipo ";
		$sql.=   " FROM " . DB_PREFIX . "prensa ";
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
                                          <td colspan="2">&nbsp;</td>
                                        </tr>
                                        <tr> 
                                         
                                         
                                          <td valign="top"><img src="bullet.jpg" width="7" height="7"><font face="Verdana, Arial, Helvetica, sans-serif" size="1"><b><font color="#000000"><a href="nota_prensa.php?id=<?=$id?>"> 
                                            <span class="contenido"><font color="#000000"> 
                                            <?=$titulo?>
                                            </font> </span></a></font></b></font><br>
                                            <font color="#000000" face="Verdana, Arial, Helvetica, sans-serif" size="1"><span class="contenido"> 
                                            <?=$bajada?>
                                            </span> </font><font face="Verdana, Arial, Helvetica, sans-serif" size="1"><br>
                                            <b><font color="9699AA"><a href="nota_prensa.php?id=<?=$id?>"><font color="9699AA"><span class="contenido">Ver 
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
                                    </div>
                                  </td>
                                </tr>
                                <tr> 
                                  <td valign="top" height="10"> 
                                    <div align="right"></div>
                                  </td>
                                </tr>
                              </table>
                              <table width="80%" border="0" cellspacing="0" cellpadding="0" align="center">
                                <tr> 
                                  <td width="10">&nbsp;</td>
                                  <td> 
                                    <!--
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
                                      </font></div>
                                  </td>
                                  <td width="10">&nbsp;</td>
                                </tr>
                              </table>
                              <p><font face="Verdana, Arial, Helvetica, sans-serif" size="1"></font></p>
                              </td>
                          </tr>
                        </table>
                        <br>
                        <br>
                      </td>
                      <td width="10" valign="top" background="main_der.jpg"> 
                        <div align="right"><img src="main_der.jpg" width="10" height="19"></div>
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>
              <tr>
                <td><img src="main_bottom.jpg" width="593" height="29"></td>
              </tr>
            </table>
          </td>
          <td width="1" bgcolor="9298AB"><img src="pixel.gif"></td>
          <td valign="top" width="215"> 
            <div align="right">
              <?php include"casosnegocios.php"?>
            </div>
          </td>
        </tr>
      </table>
    </td>
  </tr>
  <tr>
    <td>
      <?php include"pie.php"?>
    </td>
  </tr>

</table>
</body>
</html>
