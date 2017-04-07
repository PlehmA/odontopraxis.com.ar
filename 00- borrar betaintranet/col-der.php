<table width="130" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr> 
    <td><table class="col-der" width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="166"></td>
      </tr>
     
      <tr>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="135" align="right" > <?php include"datepickBasic.html"?></td>
            
          </tr>

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

          <div class="separador"></div>
           <tr>
           <td>	<div class="modulos" ><a href="agendaUsuarios.php">Agenda
           		</a><br></div></td>
          </tr>

          <div class="separador"></div>
           <tr>
           <td> 
<?
if($_SESSION['evento'] == "Y"){
  $classEvento= "moduloEvento";
}else{
$classEvento= "modulos";
}
?>
            <div class="<?=$classEvento?>" ><a href="calendario.php">Eventos
              </a><br></div></td>
          </tr>

          <div class="separador"></div>
           <tr>
           <td>	<div class="modulos" ><a href="telefonosUtiles.php">Tel&eacutefonos &uacutetiles
           		</a><br></div></td>
            
            
          </tr>
           <div class="separador"></div>
           <tr>
           <td>	<div class="modulos" ><a href="linksUtiles.php">Links
           		</a><br></div></td>
           		  <div class="separador"></div>
           <tr>
           <td>	<div class="modulos" ><a href="listadoCarpetas.php">Descarga de archivos
           		</a><br></div></td>
            
            
          </tr>
           </tr>

           <?
           if ($_SESSION['jerarquia'] == 3 || $_SESSION['jerarquia'] == 2)  {
             
            ?>
          <div class="separador"></div>
           <tr>
           <td> <div class="modulos" ><a href="pedido.php">Formulario de Pedidos
              </a><br></div></td>
           <?

            }

           if ($_SESSION['jerarquia'] == 1 || $_SESSION['jerarquia'] == 2)  {
             
            ?>
          <div class="separador"></div>
           <tr>
           <td> <div class="modulos" ><a href="listadoPedidos.php">Bandeja de Entrada de Pedidos
              </a><br></div></td>
           <?}?> 
          </tr> 
            
          </tr>
        </table></td>
      </tr>
     
     
    </table></td>
  </tr>
</table>
