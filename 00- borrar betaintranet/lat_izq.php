<table width="130" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr> 
    <td> 
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr> 
          <td> 
            <table class="lat-izq" width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td width="166"> 
                  <div align="center"> 
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr> 
                        <td>
                        	Bienvenido/a <br>
                         <span class="nombreusuario"> <?
                          echo $_SESSION['nombre'];
                          ?></span>
                          <br>
                          <? 
                           if ($_SESSION['imageProfile'] != ""){
                            ?>
                              <img src="<?=PROFILE_DIR?><?=$_SESSION['imageProfile']?>" width="" height="">
                             <? 
                            }else{
                            ?>
                              <img src="defaultProfile.png" width="" height="">
                            <? 
                            }
                            ?>
                            <a href="perfil.php?accion=MOD">Editar mi perfil</a>

                      </tr>
                     
                      
                      <tr> 
                        <td>&nbsp;</td>
                      </tr>
                      <tr> 
                        <td> 
                         
                        </td>
                      </tr>
                    </table>
                  </div>
                </td>
              </tr>
            </table>
          </td>
        </tr>
      </table>
    </td>
  </tr>
</table>
