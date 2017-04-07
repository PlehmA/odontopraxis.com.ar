<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

    <html xmlns="http://www.w3.org/1999/xhtml">
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        

<link href="css/style3.css" rel="stylesheet" type="text/css" media="all" />
<title>Odontopraxis Americana s.a.</title>


<?
include ('lib.php');
include ('conect.php');
$accion = null;
$here = "olvidoPassEntidad.php";
$RED_FONT = "font-family: Arial, Helvetica, sans-serif; font-size: 11px; color: red";
if (isset($_GET['accion']))   {
  $accion=$_GET['accion'];
}

$TABLA = DB_PREFIX . "users_entidades" ;
?>


<style type="text/css">
.centrado {
	text-align: left;
}
</style>
    </head>

<body>
<div class="header" id="header">
  <p><img src="img/logo.png" width="342" height="104" /><br />
  Bienvenidos al sistema de autogestión de Odontopraxis Americana<br />
  </p>
</div>




<div class="wrap2" id="wrap2">


  <div class="col-iz3" id="col-iz3">
  <div class="menu-iz3" id="menu-iz3"><strong>
  
  <!--**************************************************-->
 
      <br />
      <h2 align="center"> Recuperar usuario</h2>
 <br />
 
 
 <?

///////////////////////////////////////////////
// Alta de registro
if ($accion == 'MAIL')  {

  $email = "";
  $nombre = addSlashes($_POST['nombre']);
  $total = 0;
  $sql = "SELECT * FROM $TABLA WHERE nombre = LOWER('$nombre')";
  //print $sql;
  $res = mysql_query($sql);
  //print $res;
  if($res){
    $total = mysql_num_rows($res);
    if ($total == 1){
      $nombre = mysql_result($res,0,'nombre');
      $clave = mysql_result($res,0,'clave');
      $email = mysql_result($res,0,'email');
          }
  }
  mysql_free_result($res);

    
  if ($total != 1)  // el usuario no existe
  {
    
    ?>
    <body onload="document.forms['data'].submit();">
<form name="data" action="<?=$here?>?error=1" method="POST">
          <input type="hidden" name="nombre" value="<?=$nombre?>">
</form>
    </body>   
      
    <?
    return;
  }
    
  $bodyMail = "Se solicitó recuperar su clave, si usted no lo hizo, por favor contactarse con el administrador \n"; 
  $bodyMail = $bodyMail." Tus datos de acceso son: \n";
  $bodyMail = $bodyMail." Usuario: ".$nombre."\n";
  $bodyMail = $bodyMail." Contraseña: ".$clave."\n";

  mail($email,"Entidades Clave Recuperada",$bodyMail, "From: odontopraxis");

  ?>
    
      Gracias! Se envió un mail con la contraseña</br> 
      <input type="button" name="boton" value="Seguir" onclick="location='index.php'" 
      </div>
  
    
  <?
    
//  return;
}



///////////////////////////////////////////////
// Formulario Registro
if (($accion == null))  {
  
  $id = "";
  $targetAction = "MAIL";
  $page_title = "Recuperar Contraseña";
  $err = "";

  $nombre = "";
  $clave = "";
  $edificio = "";
  $email = "";
 
  
  $backpage = $here;
  
    $fecha_reg = date("d-m-Y  H:m:s");
    
    if (isset($_GET['error']))
    {
      $err = "No existe usuario con el email, intente nuevamente";
    }
  
  
?>

<?if ($err != ''){?><p align="center" class="menu2_abm"><font color="red">Error: <b><?=$err?></b></font></p><?}?>


 <form method="post" action="<?=$here?>?accion=<?=$targetAction?>" name="data" enctype="multipart/form-data">
 

        Usuario:&nbsp;&nbsp;
        
          <input type="text" class="menu2_abm" name="nombre" size="30" maxlength="25" value="" onblur="this.value=Trim(this.value);">

 
  </form>
<br>
<p align=center>
  
  <input type="button" name="boton2" value="Enviar" onclick="return verificar()" style="width:100px"/>
</p>


<br>
<br>

<script language="JavaScript">

  function verificar()  {
    
    var form = document.forms['data'];
    
      
    if (form.elements['nombre'].value == "") {
      form.elements['nombre'].focus();
      alert("Debe ingresar el nombre de usuario");
      return false;
    }
    
    form.submit();
    return true;
  }
  
  

</script>
<?}?>


    <br />
    <br />    



    <!--**************************************************--


 

</div>
</div>



</div>





















<div class="wrap2" id="wrap2">


  <div class="col-iz3" id="col-iz3">
  <div class="menu-iz3" id="menu-iz3"><strong>
  <span class="centrado">Recuperar usuario</span><!--**************************************************-->
 

 
</div>


<div class="pie" id="pie">Odontopraxis Americana 2014® Todos los derechos reservados  diseño Sendero</div>
</body>
    </html>

