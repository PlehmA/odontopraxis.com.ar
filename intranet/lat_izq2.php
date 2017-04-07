<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        
<link href="css-d/style2.css" rel="stylesheet" type="text/css" media="all" />

Bienvenido/a <br>
<span class="nombreusuario">
<?
echo $_SESSION['nombre'];
echo $_SESSION['clave'];

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
</div>
    
    
