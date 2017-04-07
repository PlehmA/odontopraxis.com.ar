<?
	include ('lib.php');
	include ('conect.php');
//	session_start();
?>
<html>
<head>
<title>Accusys</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="contenido.css" type="text/css">
<script src="Scripts/swfobject_modified.js" type="text/javascript"></script>
</head>
<body bgcolor="#FFFFFF" text="#000000" topmargin="0" leftmargin="0">
<table width="976" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr> 
    <td>
      <?php include"header.php"?>
    </td>
  </tr>
  <tr> 
    <td> 
      <object id="FlashID" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="976" height="284">
      <param name="movie" value="banner_AST.swf">
      <param name="quality" value="high">
      <param name="wmode" value="opaque">
      <param name="swfversion" value="8.0.35.0">
      <!-- This param tag prompts users with Flash Player 6.0 r65 and higher to download the latest version of Flash Player. Delete it if you don't want users to see the prompt. -->
      <param name="expressinstall" value="Scripts/expressInstall.swf">
      <!-- Next object tag is for non-IE browsers. So hide it from IE using IECC. -->
      <!--[if !IE]>-->
      <object type="application/x-shockwave-flash" data="banner_AST.swf" width="976" height="284">
        <!--<![endif]-->
        <param name="quality" value="high">
        <param name="wmode" value="opaque">
        <param name="swfversion" value="8.0.35.0">
        <param name="expressinstall" value="Scripts/expressInstall.swf">
        <!-- The browser displays the following alternative content for users with Flash Player 6.0 and older. -->
        <div>
          <h4>Content on this page requires a newer version of Adobe Flash Player.</h4>
          <p><a href="http://www.adobe.com/go/getflashplayer"><img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Get Adobe Flash player" width="112" height="33" /></a></p>
        </div>
        <!--[if !IE]>-->
      </object>
      <!--<![endif]-->
    </object> 
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
          <td>
            <table width="593" border="0" cellspacing="0" cellpadding="0" align="center">
              <tr>
                <td background="main_top_home.jpg"> 
                  <table width="593" border="0" cellspacing="0" cellpadding="0" height="39">
                    <tr>
                      <td>
                        <table width="80%" border="0" cellspacing="0" cellpadding="0" align="center">
                          <tr> 
                            <td height="2" colspan="3"></td>
                          </tr>
                          <tr> 
                            <td width="100"><font face="Verdana, Arial, Helvetica, sans-serif" size="2"><b><font color="9699AA" size="1">NOTICIAS</font></b></font></td>
                            <td width="15">&nbsp;</td>
                            <td><font face="Verdana, Arial, Helvetica, sans-serif" size="2"><b><a href="prensa.php"><font color="#FFFFFF" size="1">PRENSA 
                              Y EVENTOS</font></a></b></font></td>
                          </tr>
						  <tr> 
                            <td height="5" colspan="3"></td>
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
                      <td> <br>
                        <table width="95%" border="0" cellspacing="0" cellpadding="0" align="center">
                          <tr> </tr>
                          <tr> 
                            <td height="10"></td>
                          </tr>
                          <tr> 
                            <td height="9" valign="top"> 
                              <?
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
                              <font color="#666666" class="bodytext"><font face="Verdana, Arial, Helvetica, sans-serif" size="1"><font color="#003366" face="Verdana, Arial, Helvetica, sans-serif" size="2"><font color="#999999" size="1"> 
                              <b> </b></font></font></font></font><b></b><font face="Verdana, Arial, Helvetica, sans-serif" size="1"> 
                              <b><a href="nota.php?id=<?=$col2_id?>"><font color="#666666" class="bodytext"> 
                              </font></a></b></font> 
                              <table width="90%" border="0" cellspacing="0" cellpadding="0" align="center">
                                <tr> 
                                  <td colspan="5">&nbsp;</td>
                                </tr>
                                <tr> 
                                  <td valign="top"> 
                                    <?if ($col2_imagen != ''){?>
                                    <a href="nota.php?id=<?=$col2_id?>"><img src="<?=NOTICIAS_DIR . $col2_imagen?>" width="70" height="53" border="0"></a> 
                                  </td>
                                  <td width="10"></td>
                                  <td bgcolor="9699AA" width="1"></td>
                                  <td width="10"></td>
                                  <?}?>
                                  <td valign="top" width="80%"><img src="bullet.jpg" width="7" height="7"><font face="Verdana, Arial, Helvetica, sans-serif" size="1"><b><font color="#000000"><a href="nota.php?id=<?=$col2_id?>"> 
                                    <span class="contenido"><font color="#000000"> 
                                    <?=$col2_titulo?>
                                    </font> </span></a></font></b></font><br>
                                    <font color="#000000" face="Verdana, Arial, Helvetica, sans-serif" size="1"><span class="contenido"> 
                                    <?=$col2_bajada?>
                                    </span> </font><font face="Verdana, Arial, Helvetica, sans-serif" size="1"><br>
                                    <b><font color="9699AA"><a href="nota.php?id=<?=$col2_id?>"><font color="9699AA"><span class="contenido">Ver 
                                    mas [+]</span></font></a></font></b></font></td>
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
                              <br>
                              <?
		$col2_idx++;
	}
	mysql_free_result($col2_res);
?>
                            </td>
                          </tr>
                          <tr> 
                            <td height="25" width="80%">
                              <div align="right"><font face="Verdana, Arial, Helvetica, sans-serif" size="2"><b><font size="1"><a href="novedades.php"><font color="#000000">Ver 
                                todas las noticias &gt;&gt;</font></a></font></b></font></div>
                            </td>
                          </tr>
                        </table>
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
