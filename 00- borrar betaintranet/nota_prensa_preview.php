<?
	include ('lib.php');
	include ('conect.php');

	$backPage = ((isset($_SERVER['HTTP_REFERER'])) && (strpos($_SERVER['HTTP_REFERER'], 'noticias.php') !== FALSE)) ?
					$_SERVER['HTTP_REFERER'] : "novedades.php";
	
	if ((!isset($_GET['id'])) || ($_GET['id'] == ''))
	{
		header("Location: " . $backPage);
		return;
	}
	$id = $_GET['id'];
	
	$sql = "SELECT * FROM " . DB_PREFIX . "prensa ";
	$sql.= " WHERE id = '$id' ";
	$res = mysql_query($sql);
	if (mysql_num_rows($res) == 0)
	{
		mysql_free_result($res);
		header("Location: " . $backPage);
		return;
	}
	
	$idx = 0;

	$id = mysql_result($res, $idx,'id');
	$fecha = mysql_result($res, $idx,'fecha');
	$titulo = mysql_result($res, $idx,'titulo');
	$bajada = mysql_result($res, $idx,'bajada');
	$texto = mysql_result($res, $idx,'texto');
	$imagen = mysql_result($res, $idx,'imagen');
	$archivo = mysql_result($res, $idx,'archivo');

	$fecha_str = substr($fecha,6,2).'-'.substr($fecha,4,2).'-'.substr($fecha,0,4);

	
	mysql_free_result($res);
	
	

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
                              <table width="90%" border="0" cellspacing="0" cellpadding="0" align="center">
                                <tr> 
                                  <td colspan="5"></td>
                                </tr>
                                <tr> 
                                  <td valign="top">
                                    <?if ($imagen != ''){?>
                                    <img src="<?=EVENTOS_DIR . $imagen?>" width="70" height="53"> 
                                    <?}?>
                                  </td>
                                  <td width="10">&nbsp; </td>
                                  <td bgcolor="9699AA" width="1"></td>
                                  <td width="10">&nbsp;</td>
                                  <td valign="top"><font face="Verdana, Arial, Helvetica, sans-serif" size="2"><img src="bullet.jpg" width="7" height="7"><b>
                                    <?=$titulo?>
                                    </b></font><br>
                                    <br>
                                    <span class="contenido"> 
                                    <?=nl2br($bajada)?>
                                    <br>
                                    <?=nl2br($texto)?>
                                    <br>
                                    <?if ($archivo != ''){?>
                                    </span>
                                    <p class=bodytext><a href="<?=EVENTOS_DIR . $archivo?>" target="_blank"><font color="#FF9900" face="Verdana, Arial, Helvetica, sans-serif" size="2">Ver 
                                      mas informaci&oacute;n</font></a></p>
                                    <?}?>
                                    <span class="contenido"><br>
                                    <b><font color="9699AA"><a href="javascript:history.go(-1)"><font color="9699AA">Volver 
                                    [-]</font></a></font></b></span></td>
                                </tr>
                                <tr> 
                                  <td colspan="5" height="10"></td>
                                </tr>
                                <tr bgcolor="#CCCCCC"> 
                                  <td colspan="5" height="1"></td>
                                </tr>
                                <tr> 
                                  <td colspan="5" height="10"></td>
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
