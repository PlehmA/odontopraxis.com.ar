<?
include ('lib.php');
include ('conect.php');

$MAX_NEWS = 2;
$RED_FONT = "font-family: Arial, Helvetica, sans-serif; font-size: 11px; color: red";

if (isset($_GET['accion']))   {
  $accion=$_GET['accion'];
}

//print $accion;
$TABLA = "users_entidades" ;
$TABLA_ADMIN = "admin";

//////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-42854179-1', 'opam.com.ar');
  ga('send', 'pageview');

</script>

<script src="util/validations.js"></script>



<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Odontopraxis s.a.</title>

<script type="text/javascript" src="js/jquery.js"></script>



<link href="css/style3.css" rel="stylesheet" type="text/css" media="all" />
<title>Documento sin título</title>
<style type="text/css">
a:link {
	color: #036;
}
a:visited {
	color: #036;
}
a:hover {
	color: #036;
}
a:active {
	color: #036;
}
</style>

</head>



<body>

 
<!--**************************************************-->

<div class="header" id="header">
  <p><img src="img/logo.png" width="342" height="104" /><br />
  Alta de usuario para Gestión de Utilidades</p>
</div>


<div class="menu-registro" id="menu-registro">
<div class="menu-registro2" >
<?

///////////////////////////////////////////////
// Alta de registro
if ($accion == 'ALTA_UPD')  {

  $cuit = addSlashes($_POST['cuit']);
  $clave = addSlashes($_POST['clave']);
  $clave_rep = addSlashes($_POST['clave_rep']);
  $nombre = addSlashes($_POST['nombre']);
  $email = addSlashes($_POST['email']);
  $tel = addSlashes($_POST['tel']);

  $validado = 'N';
  $bloqueado = 'N';
  
  //////////////////////////////////////////////////////////
  //////////////////////////////////////////////////////////
  // buscar ese dni

  $sql = "SELECT COUNT(*) AS cant FROM $TABLA WHERE LOWER(nombre) = LOWER('$nombre')";
  //print $sql;
  $res = mysql_query($sql);
  $cant = mysql_result($res,0,'cant');
  mysql_free_result($res);

 // print $cant;

  $sql = "SELECT COUNT(*) AS cant FROM $TABLA WHERE email = '$email'";
 // print $sql;
  $res = mysql_query($sql);
  $cant2 = mysql_result($res,0,'cant');
  mysql_free_result($res);

 // print $cant2;
  $errores = $cant + $cant2;
  $mensaje = "";
  
if ($cant > 0 && $cant2 > 0) { 
  $mensaje = "El nombre de usuario y el email ya existe, por favor elija otro email y nombre .";
  $nombre = "";
  $email = "";
}

if ($cant2 == 0 && $cant > 0 ) { 
  $mensaje = "El nombre de usuario ya está registrado, por favor elija otro nombre.";
  $nombre = "";
}

if ($cant == 0 && $cant2 > 0 ) { 
  $mensaje = "El email ya está registrado, por favor elija otro email.";
  $email = "";
}

if($mensaje != ""){
      ?>
    <body onload="document.forms['data'].submit();">
        <form name="data" action="registroEntidad.php?accion=ALTA" method="POST">
          <input type="hidden" name="err" value="<?=$mensaje?>">
          <input type="hidden" name="nombre" value="<?=$nombre?>">
          <input type="hidden" name="clave" value="<?=$clave?>">
          <input type="hidden" name="clave_rep" value="<?=$clave_rep?>">
          <input type="hidden" name="cuit" value="<?=$cuit?>">
          <input type="hidden" name="email" value="<?=$email?>">
          <input type="hidden" name="tel" value="<?=$tel?>">
        </form>
    </body>  
      
    <?
    return;
}

  
  //////////////////////////////////////////////////////////
  //////////////////////////////////////////////////////////

  $sql = "INSERT INTO $TABLA (clave, adm, activo, nombre, cuit, email, fecha_reg, tel) ";
  $sql.=  "VALUES ('$clave', 'N', 'S', '$nombre', '$cuit', '$email', NOW(), '$tel')";
  //print $sql;
  $res = mysql_query($sql);
  if ($res){

   // mysql_free_result($res);
    $sql = "SELECT email FROM $TABLA_ADMIN WHERE sitio = ".SITIO;
    $res = mysql_query($sql);
    $emailAdmin = mysql_result($res,0,'email');
    mysql_free_result($res);

    $bodyMail = "Se ha registrado una nueva Entidad. \n"; 
    $bodyMail = $bodyMail."Sus datos de registro son: \n";
    $bodyMail = $bodyMail."Nombre: ".$nombre."\n";
    $bodyMail = $bodyMail."Cuit: ".$cuit."\n";
    $bodyMail = $bodyMail."Email: ".$email."\n";
    $bodyMail = $bodyMail."Telefono: ".$tel."\n";

    mail($emailAdmin,"Nuevo usuario Entidad",$bodyMail,"From: odontopraxis");

  
  ?>
    <div style="margin: 0 auto;width: 463px;">
      Gracias por registrarte <?  print $nombre ?> </br> 
      Tus datos de acceso son
      </br>
      Nombre: <? print $nombre ?>
      </br>
      Contrasena: <? print $clave ?>
      </br>
      Alta  satisfactoria, se le enviará al mail ingresado avisando cuando está disponible  su acceso</br>
      <input type="button" name="boton" value="Comenzar!" onclick="location='index.php'" style="width:100px"/>
</div>    
  <?
  }else{
    ?>
    <div style="margin: 0 auto;width: 463px;">
      Se detectó un problema 
      </br>
      Por favor intente nuevamente
      <input type="button" name="boton" value="Inicio" onclick="location='index.php'" style="width:100px"/>
</div>    
  <?

  }
    
  //return;
}



///////////////////////////////////////////////
// Formulario Registro
if (($accion == 'ALTA'))  {
  
  $id = "";
  $targetAction = "ALTA_UPD";
  $page_title = "Registro de Usuario";
  $err = "";

  
  $cuit = "";
  $fecha_reg = "";
  $nombre = "";
  $clave = "";
  $email = "";
  $validado = "";
  $bloqueado = "";
  $tel = "";
  
  $backpage = "registroEntidad.php";
  
    $fecha_reg = date("d-m-Y  H:m:s");
    
    if (isset($_POST['err']))
    {
      $err = $_POST['err'];
      $nombre = $_POST['nombre'];
      $clave = $_POST['clave'];
      $email = $_POST['email'];
      $cuit = $_POST['cuit'];
      $tel = $_POST['tel'];
    } 
  
?>

<?if ($err != ''){?><p align="center" class="menu2_abm"><font color="red">Error: <b><?=$err?></b></font></p><?}?>


 <form method="post" action="registroEntidad.php?accion=<?=$targetAction?>" name="data" enctype="multipart/form-data">
 


Fecha de registro
   <b><?=$fecha_reg?><b> <br /><br />

        
Usuario: 
          <input type="text" class="menu2_abm" name="nombre" size="30" maxlength="80" value="" onblur="this.value=Trim(this.value);">  <br />

Contraseña:
          <input type="text" class="menu2_abm" name="clave" size="30" maxlength="25" value="">   <br />

Repetición de contraseña:
<input type="text" class="menu2_abm" name="clave_rep" size="30" maxlength="25" value="">   <br />

CUIT:
        <?if ($accion == 'ALTA'){?>

          <input type="text" class="menu2_abm" name="cuit" size="30" maxlength="25" value="" onblur="this.value=Trim(this.value);">  

        <?}?>   <br />
 
E-mail:<input type="text" class="menu2_abm" name="email" size="30" maxlength="35" value="" onblur="this.value=Trim(this.value);">  <br />

Teléfono: 
          <input type="text" class="menu2_abm" name="tel" size="30" maxlength="35" value="" onblur="this.value=Trim(this.value);">


 
</form>
<br /><br />

  <input type="button" name="boton" value="Volver" onclick="location='index.php'" style="width:100px"/><br />

  <input type="button" name="boton2" value="Guardar" onclick="return verificar()" style="width:100px"/>


</div>
</div>

<br>
<br>

<script language="JavaScript">

  function verificar()  {
    
    var form = document.forms['data'];
    
    if (form.elements['cuit'].value == "")  {
      form.elements['cuit'].focus();
      alert("Debe ingresar el n&uacutemero de cuit.");
      return false;
    }
    form.elements['nombre'].value = form.elements['nombre'].value.toLowerCase();
    if (form.elements['nombre'].value == "")  {
      form.elements['nombre'].focus();
      alert("Debe ingresar el nombre.");
      return false;
    }
  
    if (form.elements['clave'].value != form.elements['clave_rep'].value) {
      alert("La contraseña ingresada y su repetición no son iguales.");
      return false;
    }
    
    
    if (form.elements['email'].value == "") {
      form.elements['email'].focus();
      alert("Debe ingresar la dirección de e-mail.");
      return false;
    }
    else
    {
      if (!checkEmail(form.elements['email'].value))
      {
        form.elements['email'].focus();
        alert("La dirección de e-mail no es válida.");
        return false;
      }
    }
    
    form.submit();
    return true;
  }
  
  // s�lo en el caso de caracteres especiales
  document.forms['data'].elements['cuit'].value = "<?=$cuit?>";
  document.forms['data'].elements['nombre'].value = "<?=$nombre?>";
  document.forms['data'].elements['clave'].value = "<?=$clave?>";
   document.forms['data'].elements['clave_rep'].value = "<?=$clave_rep?>";
  document.forms['data'].elements['email'].value = "<?=$email?>";
  document.forms['data'].elements['tel'].value = "<?=$tel?>";
  
</script>
<?}?>
 

    <br />
    <br />    
    
    
    
<!--**************************************************-->

         <br />
<br />
<div class="pie" id="pie">Odontopraxis Americana 2014® Todos los derechos reservados  diseño Sendero </div>
</body>
</html>
