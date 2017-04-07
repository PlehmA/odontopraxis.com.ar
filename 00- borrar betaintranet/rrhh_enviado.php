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
                                      <p><br>
                                      </p>
                                    </div>
                                    <div class=cuerpoNota> 
                                      <div align="center">
                                        <? include ("enviar.inc.php"); ?>
                                      </div>
                                    </div>
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
				alert('Por favor ingrese su nombre.');
				return;
			}
			field = form.elements['apellido'];
			if (field.value == '')
			{
				field.focus();
				alert('Por favor ingrese su apellido.');
				return;
			}field = form.elements['puesto'];
			if (field.value == '')
			{
				field.focus();
				alert('Por favor ingrese su puesto.');
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
