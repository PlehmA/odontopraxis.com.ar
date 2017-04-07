<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        
<link href="css-d/style2.css" rel="stylesheet" type="text/css" media="all" />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="contenido.css" type="text/css">

<title>Odontopraxis</title>

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
	
	$sql = "SELECT * FROM " . DB_PREFIX . "noticias ";
	$sql.= " WHERE publicado = 'S' ";
	$sql.=   " AND id = '$id' ";
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

</head>

<body bgcolor="#FFFFFF" text="#000000" topmargin="0" leftmargin="0">

  <!--<tr> 
    <td> 
      <?php include"menu_ac.php"?>
    </td>
  </tr>-->





















    <td valign="top"><table width="100%" style="background:white" border="0" cellspacing="0" cellpadding="0" align="center">
      <tr>

          <tr>
            <td><table width="90%" border="0" cellspacing="0" cellpadding="0" align="center">
              <tr>
                <td height="10"></td>
              </tr>
              <tr>
                <td><font face="Verdana, Arial, Helvetica, sans-serif" size="2"><b><font color="9699AA">DESTACADOS</font></b></font></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
      <tr>

          <tr>
            <td valign="top" ><table width="90%" border="0" cellspacing="0" cellpadding="0" align="center">
              <tr>
                  <td><table width="90%" border="0" cellspacing="0" cellpadding="0" align="center">
                    <tr>
                      <td colspan="5"></td>
                      </tr>
                    <tr>
                      <td valign="top"><?if ($imagen != ''){?>
                        <img src="<?=NOTICIAS_DIR . $imagen?>" width="228" height="170" />
                        <?}?></td>
                      <td width="20">&nbsp;</td>
                      <td bgcolor="9699AA" width="1"></td>
                      <td width="20">&nbsp;</td>
                      <td width="50%" valign="top"><font face="Verdana, Arial, Helvetica, sans-serif" size="2"><img src="bullet.jpg" width="7" height="7" /><b>
                        <?=$titulo?>
                        </b></font><br />
                        <br />
                        <span class="contenido">
                          <?=nl2br($bajada)?>
                          <br />
                          <?=nl2br($texto)?>
                          <br />
                          <br />
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
                  <p><font face="Verdana, Arial, Helvetica, sans-serif" size="1"></font></p></td>
                  </tr>
                <!-- <tr> 
                            <td> 
                              <div align="center"><img src="banners_soluciones.jpg" width="501" height="125"></div>
                            </td>
                         </tr>-->
                </table>
              <br />
            <br />              <div align="right"></div></td>
</tr>
        </td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
    </table>
      <img src="pixel.gif" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table></td></tr>
</table>
</body>
</html>
