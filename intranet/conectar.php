<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        



<?
include ('lib.php');
include ('checks.php');


$MAX_NEWS = 2;
$RED_FONT = "font-family: Arial, Helvetica, sans-serif; font-size: 11px; color: red";


include ('conect.php');


$TABLA = DB_PREFIX . "usuarios" ;

function getSector($id){
	$sql = "SELECT nombre AS nombre FROM sector WHERE id = $id";
	//print $sql."</br>";
	$sector = null;
	$res = mysql_query($sql);
	if ($res){
		$sector = mysql_result($res,0,'email');
		mysql_free_result($res);
	}
	return $sector;
}

function getEdificio($id){
	$sql = "SELECT nombre AS nombre FROM edificio WHERE id = $id";
	//print $sql."</br>";
	$edificio = null;
	$res = mysql_query($sql);
	if ($res){
		$edificio = mysql_result($res,0,'email');
		mysql_free_result($res);
	}
	return $edificio;
}

?>







Bienvenido/a <br>
<span class="nombreusuario">
<?
echo $_SESSION['email'];
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
    
    
