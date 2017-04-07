<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        
<link href="css-d/style2.css" rel="stylesheet" type="text/css" media="all" />

Bienvenido/a <br>
<span class="nombreusuario">
<?
echo $_SESSION['nombre'];
?>
</span>
<br>
<? 
if ($_SESSION['imageProfile'] != ""){
                            ?>
                              <img src="<?=PROFILE_DIR?><?=$_SESSION['imageProfile']?>" width="" height="">
                             <? 
                            }else{
                            ?>
                              <img src="defaultProfile.png" width="140px" height="130px">
                            <? 
                            }
                            ?>
                            <a href="perfil.php?accion=MOD"><br />
                            Editar mi perfil</a>

</div>
                  
<div class="menu-iz2" id="menu-iz2">
    
    
    <p>&gt; <a href="home.php">HOME</a></p>
    <p>&gt; <a href="agendaUsuarios.php">AGENDA</a></p>

<?
if($_SESSION['evento'] == "Y"){
  $classEvento= "color: red;";
}
?>
            

        <p>&gt;<a style="<?=$classEvento?>" href="calendario.php"> EVENTOS</a></p>
        <p>&gt;<a href="telefonosUtiles.php"> TEL&Eacute;FONOS &Uacute;TILES</a></p>
      <p>&gt; <a href="linksUtiles.php">LINKS</a><a href="datos-contacto.php"></a></p>
      <p>&gt; <a href="listadoCarpetas.php">DESCARGA DE ARCHIVOS</a>
  </p>


           <?
           if ($_SESSION['hacerPedidos'] == "Y")  {
             
            ?>

           
           <div class="modulos" ><a href="pedido.php">
           <p>&gt; FORMULARIO DE PEDIDOS
</a></p></div>
           <? }

           if ($_SESSION['bandejaPedidos'] == "Y")  {
             
?>

            <div class="modulos" ><a href="listadoPedidos.php">
           <p>&gt; BANDEJA DE ENTRADA PEDIDOS<br /><br />
           </a></a></p></div>
           <?}?> 
           
         
        <td valign="top" bgcolor="#FFFFFF"><input type="button" value="Salir" onclick="location='index.php?g=1'" style="width:80px" />
      
</div>
</div>
    
    
