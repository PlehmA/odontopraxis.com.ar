
      <table width="900" border="0" cellspacing="0" cellpadding="0"><script language="JavaScript">
<!--
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
//-->
</script>
        <tr> 
          <td width="500"><a href="home.php"><img src="logo.png" width="300" height="" border="0"></a></td>
          <td valign="bottom"> 
            <table width="650" border="0" cellspacing="0" cellpadding="0" align="right">
              <tr> 
                <td height="40" valign="top"> 
                  <div align="right"> <font color="#FFFFFF" face="Arial, Helvetica, sans-serif" size="1"><b>
                    <?
    $directorio = dirname($_SERVER['PHP_SELF']); 
    $erasebar = "/"; 
    $reemplazar = ''; 
//    $sindepurar = ereg_replace($directorio, $reemplazar, $_SERVER['REQUEST_URI']); 
    @$sindepurar = ereg_replace($directorio, $reemplazar, $_SERVER['PHP_SELF']); 
    $actualfile = ereg_replace($erasebar, $reemplazar, $sindepurar); 
?>
                    
                    </b></font>
                    <input type="button" value="Salir" onclick="location='index.php'" style="width:80px"></div>
                </td>
              </tr>
              <tr> 
                <td> 
                  <div align="left"> 
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                     <!-- <tr> 
                        <td width="230"></td>
                        <td>
                          <div align="right"><font face="Verdana, Arial, Helvetica, sans-serif" size="1"><b><a href="quienessomos.php"><font color="9298AB">Quienes 
                            somos</font></a> |<a href="contacto.php"> <font color="9298AB">Cont&aacute;ctenos</font></a>|<a href="rrhh.php"> 
                            <font color="9298AB">Recursos Humanos</font></a> </b></font> 
                            <font face="Verdana, Arial, Helvetica, sans-serif" size="1"><b> 
                            </b></font> </div>
                        </td>
                      </tr>-->
                    </table>
                  </div>
                </td>
              </tr>
              <tr> 
                <td height="20"> </td>
              </tr>
            </table>
          </td>
        </tr>
      </table>
      <form name="form2" id="form2" action="#" method="POST">
        <input type="hidden" name="startPage" value="0" />
      </form>
