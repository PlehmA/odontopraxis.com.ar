<html>
<head>
<title>Accusys</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<SCRIPT language="JavaScript" src="validations.js" 
type=text/javascript></SCRIPT>
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
                        <table width="95%" border="0" cellspacing="0" cellpadding="0" align="center">
                          <tr>
                            <td height="10"></td>
                          </tr>
                          <tr>
                            <td><font face="Verdana, Arial, Helvetica, sans-serif" size="2"><b><font color="9699AA">Recursos 
                              Humanos </font></b></font></td>
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
                              <div align="center"><img src="top_alianzas.jpg" width="500" height="125"></div>
                            </td>
                          </tr>
                          <tr>
                            <td>&nbsp;</td>
                          </tr>
                          <tr> 
                            <td valign="top">
                              <table width="95%" border="0" cellspacing="0" cellpadding="0" align="center">
                                <tr> 
                                  <td valign="top"> 
                                    <div class=cuerpoNota> 
                                      <form name="frm" action="rrhh_enviado.php" method="POST" enctype="multipart/form-data">
                                        <table width="100%" border="0" cellpadding="2">
                                          <tr> 
                                            <td width="219">&nbsp;</td>
                                            <td width="237">&nbsp;</td>
                                          </tr>
                                          <tr> 
                                            <td align="right" width="219"><font size="1" face="Verdana, Arial, Helvetica, sans-serif" color="#FF0000">*</font><font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 
                                              Nombre y Apellido:</font></td>
                                            <td width="237"> 
                                              <input type=text name="nombre" size=23>
                                            </td>
                                          </tr>
                                          <tr> 
                                            <td align="right" width="219"><font size="1" face="Verdana, Arial, Helvetica, sans-serif" color="#FF0000">*</font><font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 
                                              e-mail:</font></td>
                                            <td width="237"> 
                                              <input type=text name=email size=23>
                                            </td>
                                          </tr>
                                          <tr> 
                                            <td width="219"> 
                                              <div align="right"><font size="1" face="Verdana, Arial, Helvetica, sans-serif" color="#FF0000">*</font><font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 
                                                Tel&eacute;fono de contacto:</font></div>
                                            </td>
                                            <td width="237"><b> 
                                              <input type=text name="telefono" size=23>
                                              </b></td>
                                          </tr>
                                          <tr> 
                                            <td align="right" width="219"><font size="1" face="Verdana, Arial, Helvetica, sans-serif" color="#FF0000">*</font><font size="1" face="Verdana, Arial, Helvetica, sans-serif"></font> 
                                              <font size="1" face="Verdana, Arial, Helvetica, sans-serif">Perfil:</font></td>
                                            <td width="237"><b> 
                                              <input type=text name="puesto" size=23>
                                              </b></td>
                                          </tr>
                                          <tr> 
                                            <td width="219"> 
                                              <div align="right"><font size="1" face="Verdana, Arial, Helvetica, sans-serif">Remuneraci&oacute;n 
                                                pretendida:</font></div>
                                            </td>
                                            <td width="237"> 
                                              <input type=text name="remuneracion" size=23>
                                            </td>
                                          </tr>
                                          <tr> 
                                            <td align="left" valign="middle"> 
                                              <div align="right"><font face="Verdana, Arial, Helvetica, sans-serif" size="1" color="#000000">Adjuntar 
                                                C.V.</font></div>
                                            </td>
                                            <td> 
                                              <input type="file" name="ufile[]">
                                            </td>
                                          </tr>
                                          <tr>
                                            <td align="left" valign="top"> 
                                              <div align="right"><font face="Verdana, Arial, Helvetica, sans-serif" size="1">Comentarios:</font></div>
                                            </td>
                                            <td valign="top"> 
                                              <textarea name="comentarios"></textarea>
                                            </td>
                                          </tr>
                                          <tr> 
                                            <td valign="top" width="219" rowspan="2"> 
                                              <div align="right"></div>
                                            </td>
                                            <td width="237"></td>
                                          </tr>
                                          <tr> 
                                            <td> <font face="Verdana, Arial, Helvetica, sans-serif" size="1" color="#9c254f"><b> 
                                              <input type="button" value="Enviar" name="submit1" onClick="enviar(this.form)">
                                              </b></font> 
                                              <input class=btn id=Enviar2 type=reset value=Borrar name=Enviar2>
                                            </td>
                                          </tr>
                                          <tr> 
                                            <td valign="top" colspan="2"> 
                                              <div align="CENTER"><font size="1" face="Verdana, Arial, Helvetica, sans-serif" color="#FF0000">*</font><font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 
                                                Estos campos son obligatorios</font></div>
                                            </td>
                                          </tr>
                                        </table>
                                      </form>
                                      <p><br>
                                      </p>
                                    </div>
                                    <div class=cuerpoNota></div>
                                  </td>
                                </tr>
                              </table>
                              <p>&nbsp;</p>
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
 <script>
	
		function enviar(form)
		{
			var field;
			
			
			field = form.elements['nombre'];
			if (field.value == '')
			{
				field.focus();
				alert('Por favor ingrese su nombre y apellido.');
				return;
			}
			field = form.elements['puesto'];
			if (field.value == '')
			{
				field.focus();
				alert('Por favor ingrese su perfil.');
				return;
			}
			
			field = form.elements['email'];
			if (field.value == '')
			{
				field.focus();
				alert('Por favor ingrese su dirección de e-mail.');
				return;
			}
			if (!checkEmail(field.value))
			{
				field.focus();
				alert('Su dirección de e-mail no es válida.');
				return;
			}
			field = form.elements['telefono'];
			if (field.value == '')
			{
				field.focus();
				alert('Por favor ingrese su número de teléfono.');
				return;
			}
		
			
			/////////////////////////////////////////
			
			
			
			//////////////////////////////////////////
			
			
			
			//////////////////////////////////////////

			form.submit();
		}
	</script>
</table>
</body>
</html>
