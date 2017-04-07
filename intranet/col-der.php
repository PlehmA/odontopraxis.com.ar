<!-- Seccion de cumpleaños -->
          <? if ($_SESSION['CUMPLES'] != 0){ ?>
          <div class="separador"></div>
          <tr>
          <td>  <div class="bdaymodule"><h1>Hoy cumple a&ntilde;os: </h1><br>
          <? 
                $i = 0;
                while ($i < $_SESSION['CUMPLES']) {
          ?>
                  <a href="mailto:<?=$_SESSION['CUMPLE'.$i]['EMAIL']?>">
                    <?=$_SESSION['CUMPLE'.$i]['NOMBRE'].' '.$_SESSION['CUMPLE'.$i]['APELLIDO']?>
                  </a>
          
           <?   if ($_SESSION['CUMPLE'.$i]['IMAGE'] != ""){ ?>
                  
                  <img src="<?=PROFILE_DIR?><?=$_SESSION['CUMPLE'.$i]['IMAGE']?>" width="30" height="30">
           
           <?    }else{ ?>
                  
                  <img src="defaultProfile.png" width="30" height="30">
           <?    }
                 $i++;
           ?> 
               <br> 
           <?
                }
          ?>
        
          <br></div></td>
          </tr>
          <? 
              }
          ?>
          <!-- fin Seccion de cumpleaños -->
