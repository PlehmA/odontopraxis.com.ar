<?
include ('lib.inc');
include ('checks.inc');

//  session_start();
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

<meta name="Description" content="Odontopraxis Americana s.a. Una Institución dedicada a brindar atención odontológica a grandes grupos poblacionales (Obra Social, Empresas Prepagas, etc) con una red de consultorios y clínicas dispersas por todo el País.

Ofrecemos:
Gracias a nuestro exclusivo sistema de Historia Clínica Unificada podemos brindar atención, control y seguimiento de los tratamientos en cualquier punto de nuestro país donde sea necesario acceder a una consulta odontológica">


<meta name="keywords" content="opam, odontopraxis americana, ceo, prestaciones odontológicas,">
<?

include ('conect.inc');
?>

<meta name="robots" content="index, follow, all">
<meta name="distribution" content="global">
<meta name="copyright" content="Estudio Sendero">
<meta http-equiv="Pragma" content="no-cache">
<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
<meta name="GOOGLEBOT" content="index, follow, all">
<meta http-equiv="content-language" content="es">
<meta name="AUTHOR" content="Estudio Sendero">


<script type="text/javascript" src="jquery-1.4.2.js"></script>
<script type="text/javascript" src="coin-slider.min.js"></script>
<link rel="stylesheet" href="coin-slider-styles.css" type="text/css" />



<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Odontopraxis s.a.</title>

<link href="estilos-odontopraxis.css" rel="stylesheet" type="text/css" />
<!--link rel="stylesheet" href="styles.css" type="text/css"-->
<script src="util/validations.js"></script>
</head>

<style>
A:link {
	text-decoration: none;
	color: #FFFFFF;
} 


A:visited {
	text-decoration: none;
	color: #FFFFFF;
} 


A:active {
	text-decoration: none;
	color: #FFFFFF;
} 

A:hover {
	text-decoration: none;
	color: #666666;
} 


</style>
<body bgcolor="#7190BE">
<table width="920" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="135" bgcolor="#FFFFFF"><img src="img/header-odontopraxis.jpg" width="919" height="155" alt="Odontopraxis sa." /></td>
  </tr>
   <tr>
    <td valign="top" bgcolor="#FFFFFF"><br />
     <input type="button" value="Salir" onclick="location='index.php'" style="width:80px"></div></td>
  </tr>
  <tr>
    <td valign="top" bgcolor="#FFFFFF"><br />
 
<!--**************************************************-->
 
      <br />
      <br /> 
      <h2 align="center"> Asignación de Códigos de Entidades  </h2>

<?
  $here = "home.php";

  $accion="LISTA";
  if (isset($_GET['accion']))   {
    $accion=$_GET['accion'];
  }

  if (($accion != 'LISTA') &&  ($accion != 'MOD') && ($accion != 'MOD_UPD')) {
    ?><META HTTP-EQUIV="Refresh" CONTENT="0; URL=<?=MAIN_PAGE?>"><?
    return;
  }    

  if (($accion != 'LISTA') && (!isset($_GET['id'])))  {
    ?><META HTTP-EQUIV="Refresh" CONTENT="0; URL=<?=MAIN_PAGE?>"><?
    return;
  }

///////////////////////////////////////////////
// Actualización de registro
if ($accion == 'MOD_UPD') {
  $id=$_GET['id'];

 $codigo = strtolower($_POST['codigo']);
 $codigoSafe = urlencode($codigo);
 //print ("codigo: ".$codigo." safe: ".$codigoSafe);
 


  if (!file_exists(CARPETAS_DIR.OS_FILE_SEPARATOR.$codigoSafe)) {
    mkdir(CARPETAS_DIR.OS_FILE_SEPARATOR.$codigoSafe, 0777, true);
    if (!file_exists(CARPETAS_DIR.OS_FILE_SEPARATOR.$codigoSafe.OS_FILE_SEPARATOR.CARPETA_LIQ)) {
      mkdir(CARPETAS_DIR.OS_FILE_SEPARATOR.$codigoSafe.OS_FILE_SEPARATOR.CARPETA_LIQ, 0777, true);
    }
    if (!file_exists(CARPETAS_DIR.OS_FILE_SEPARATOR.$codigoSafe.OS_FILE_SEPARATOR.CARPETA_RES)) {
      mkdir(CARPETAS_DIR.OS_FILE_SEPARATOR.$codigoSafe.OS_FILE_SEPARATOR.CARPETA_RES, 0777, true);
    }
  }
 
 $sql = "UPDATE ". USERS_TABLE ." SET ";
    $sql.=      " codigo='$codigoSafe' ";
    $sql.= " WHERE id='$id' ";
  //  print "sql: $sql<br>";
    mysql_query($sql);




  ?>
  <META HTTP-EQUIV="Refresh" CONTENT="0; URL=<?=$here?>">
  <?
  return;
}

?>




<?
///////////////////////////////////////////////
// Actualizaci�n de registro
  
 if ($accion == 'MOD') {
    
    $id = $_GET['id'];
    $targetAction = "MOD_UPD";

    $sql="SELECT * FROM ". USERS_TABLE ." WHERE id='$id'";
   // print $sql;
    $res = mysql_query($sql);
    if (mysql_num_rows($res) < 1) {
      mysql_free_result($res);
      ?><META HTTP-EQUIV="Refresh" CONTENT="0; URL=<?=$here?>">
      <?
      return; 
    }
    
    $backpage = $here;

    $codigo = mysql_result($res,0,'codigo');
    $nombre = mysql_result($res,0,'nombre');
     
    mysql_free_result($res);
  

if ($err != ''){
?>
<p align="center" class="menu2_abm"><font color="red">Error: <b><?=$err?></b></font></p>

<?  }?>


 <form method="post" action="<?=$here?>?accion=<?=$targetAction?>&id=<?=$id?>" name="data" enctype="multipart/form-data">
 <input type="hidden" name="id" value="<?=$id?>">


   <table border="0" cellspacing="0" cellpadding="0" align="center">

    <tr> 
        <td valign="middle" align="right" class="menu2_abm">Entidad&nbsp;&nbsp;</td>
        <td valign="top" > <?=$nombre ?> </td>
      </tr><tr> 
        <td valign="middle" align="right" class="menu2_abm">C&oacutedigo de Entidad&nbsp;&nbsp;</td>
        <td valign="top" > 
          <input type="text" class="menu2_abm" name="codigo" size="30" maxlength="25" value="">
        </td>
      </tr>
      
    <tr bgcolor="#BCCCCC"><td colspan="3"></td></tr>
   
   </table>
 
  </form></br>
  <p align=center>
  <input type="button" name="boton" value="Volver" onclick="location='<?=$backpage?>';" style="width:100px"/>
  &nbsp;&nbsp;&nbsp;
  <input type="button" name="boton2" value="Guardar" onclick="return verificar()" style="width:100px"/>
</p>


<script language="JavaScript">

  function verificar()  {

  //  alert("validando");
    
    var form = document.forms['data'];
    
    form.elements['codigo'].value = form.elements['codigo'].value.toLowerCase();
    if (form.elements['codigo'].value == "")  {
      form.elements['codigo'].focus();
      alert("Debe ingresar un codigo valido");
      return false;
    }
  
    form.submit();
    return true;
  }
    document.forms['data'].elements['codigo'].value = "<?=$codigo?>";
  
</script>

<?

 } 

?>

 
 <?
if ($accion == "LISTA") {

  $listHeaders = Array(
          Array("titulo" => "Registro", "campo" => "fecha_reg", "celdas" => "1"),
          Array("titulo" => "Cuit", "campo" => "cuit", "celdas" => "1"),
          Array("titulo" => "Nombre", "campo" => "nombre", "celdas" => "1"),
          Array("titulo" => "mail", "campo" => "email", "celdas" => "1"),
          Array("titulo" => "Telefono", "campo" => "tel", "celdas" => "1"),
          Array("titulo" => "Código", "campo" => "codigo", "celdas" => "1"),
          );
 
  $filtro_orderby = "0";  // Usuario
  if ((isset($_GET['orderby'])) && (is_numeric($_GET['orderby'])))
  {
    $orderby = $_GET['orderby'];
    if (($orderby >= 0) && ($orderby < sizeof($listHeaders)))
      $filtro_orderby = $orderby;
  }
  $filtro_order = "1";  //ASC
  if ((isset($_GET['order'])) && (is_numeric($_GET['order'])))
  {
    $order = $_GET['order'];
    if (($order == 0) || ($order == 1))
      $filtro_order = $order;
  }


?>

<div style=" width:700px; margin-left:152px;">
<table border="0" cellspacing="0" cellpadding="0" align="center">

    <tr bgcolor="#BCCCCC" height="25px">
    <?
      echo "<td></td>";
      echo "<td></td>";
      echo "<td></td>";
        for($i = 0; $i < sizeof($listHeaders); $i++)
      {
        echo "<td class=\"txt2_abm\"";
        echo " colspan=\"" . $listHeaders[$i]["celdas"] . "\"";
        if ($filtro_orderby == $i) echo " bgcolor=\"#5ecccc\"";
        echo " nowrap>";
        
        if ($filtro_orderby == $i)
        {
          echo "<table width=\"100%\"><tr>";
            echo "<td class=\"txt2_abm\" width=\"90%\" nowrap>";
            echo $listHeaders[$i]["titulo"];
            echo "</td>";
            
            echo "<td>";
            echo "&nbsp";
            if ($filtro_order == 0) // ASC
              echo "<a href=\"javascript:ordenar('1')\" title=\"Ordenar descendente esta columna\"><img src=\"img/sort_dn.gif\"/ border=\"0\"></a>";
            else  // DESC
              echo "<a href=\"javascript:ordenar('0')\" title=\"Ordenar ascendente esta columna\"><img src=\"img/sort_up.gif\"/ border=\"0\"></a>";
            echo "</td>";
            
          echo "</tr></table>";
        }
        else
        {
          echo "<a href=\"javascript:ordenarCampo('" . $i . "')\" title=\"Ordenar por esta columna\">";
          echo $listHeaders[$i]["titulo"];
          echo "</a";
        }
        echo "</td>";
        echo "<td></td>";
      }
      ?>
    </tr>

    <tr>
        <td bgcolor="#CCCCCC" colspan="20" height="1"></td>
    </tr>

<?
  
  $sql = "SELECT * FROM ".USERS_TABLE;

  $sql.= " ORDER BY " . $listHeaders[$filtro_orderby]["campo"] . ( ($filtro_order == 0)? " ASC" : " DESC" );
  //print $sql;

  $res = mysql_query($sql);
  $total = mysql_num_rows($res);

  $idx = 0;
  while ($idx < $total) {
  
  $id = mysql_result($res, $idx,'id');
  $cuit = mysql_result($res, $idx,'cuit');
  $email = mysql_result($res, $idx,'email');
  $nombre = mysql_result($res, $idx,'nombre');
  $fecha_reg = mysql_result($res, $idx,'fecha_reg');
  $tel = mysql_result($res, $idx,'tel');  
  $codigo = mysql_result($res, $idx,'codigo');  

?>
    <tr height="25">
        <td class="txt_abm">&nbsp;</td>
        <td nowrap>
          <img src="img/edit_icon.gif" style="cursor:hand" onclick="javascript:location='<?=$here?>?accion=MOD&id=<?=$id?>'" alt="Editar">
        </td>
         <td class="txt_abm">&nbsp;&nbsp;&nbsp;</td>
        
        <td class="txt_abm" nowrap>
          <?=substr($fecha_reg,0,10)?>
        </td>
        <td class="txt_abm">&nbsp;&nbsp;</td>
        <td class="txt_abm" >
          <?=$cuit?>
        </td>
        <td class="txt_abm">&nbsp;&nbsp;</td>
        
        <td class="txt_abm" >
          <?=$nombre?>
        </td>
    
        <td class="txt_abm">&nbsp;&nbsp;</td>
        <td class="txt_abm" >
          <?=$email?>
        </td>
        <td class="txt_abm">&nbsp;&nbsp;</td>
         <td class="txt_abm" nowrap>
          <?=$tel?>
        </td>
        <td class="txt_abm">&nbsp;&nbsp;</td>
      <td class="txt_abm">&nbsp;&nbsp;</td>
        <td class="txt_abm" >
          <?=$codigo?>
        </td>
        <td class="txt_abm">&nbsp;&nbsp;</td>
    </tr>
    <tr>
        <td bgcolor="#CCCCCC" colspan="20" height="1"></td>
    </tr>
<?
    $idx++;
  }
  mysql_free_result($res);
?>

</table>
</div>


<script language="Javascript">
  function ordenarCampo(param)
  {
    window.location = "<?=$here?>?orderby=" + param + "&rnd=" + Math.random();
  }
  function ordenar(param)
  {
    window.location = "<?=$here?>?orderby=<?=$filtro_orderby?>&order=" + param + "&rnd=" + Math.random();
  }
  
</script>

<br>
<br>
<p align=center>
<!--  <input type="button" name="boton" value="Nuevo usuario" onclick="location='usuariosweb.php?accion=ALTA';" style="width:150px"/>
  &nbsp;&nbsp;&nbsp;
  <input type="button" name="boton2" value="Menú" onclick="location='<?=MAIN_PAGE?>';" style="width:150px"/> -->
</p>
<br>

<?
}
////////////////////////////////////////////////////////////////////////////////

?> 
    <br />
    <br />    
  
    
    
<!--**************************************************-->

    
    </td>
  </tr>
  <tr>
    <td align="center" bgcolor="#7190BE"><table width="920" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td width="116" align="center" bgcolor="#CCCCCC"><a href="http://www.facebook.com/opamsa?fref=ts" target="_blank"><img src="img/facebook.png" width="46" height="45" alt="facebook link odontopraxis" /></a></td>
        <td width="665" height="140" align="center" bgcolor="#CCCCCC"><span class="textofooter">Av. Córdoba 1345  Piso 13 º  A - C.A.B.A. Tel / Fax: 011 4811-5555 (líneas rotativas) <br />
          mail: <a href="mailto:coordinacion@odontopraxis.com.ar">informes@odontopraxis.com.ar</a></span><br />
          <br />
          <span class="mapadelsitio">Mapa del sitio: &nbsp; <a href="index.html">Empresa&nbsp; I&nbsp; </a><a href="servicios.html">Servicios</a><a href="index.html">&nbsp;I&nbsp; </a><a href="brindamos.html">Brindamos</a><a href="index.html">&nbsp;I&nbsp; </a><a href="consultorios-tribunales.html">Consultorios   tribunales</a><a href="index.html">&nbsp;I&nbsp; </a><a href="contacto.php">Contacto</a><a href="index.html">&nbsp;I&nbsp;Prestadores  I&nbsp; Personal&nbsp; I&nbsp; </a><a href="contratacion-prof.php">Contratación de <br />
profesionales</a> <a href="index.html">I</a> <a href="contratacion-pers.html">Contratación de personal auxiliar</a></span></td>
        <td width="125" align="center" bgcolor="#CCCCCC"><img src="img/mobilePublicInfo.jpg" width="74" height="74" alt="afip codigo" /></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td align="center" bgcolor="#7190BE"><span class="derechos">Odontopraxis Americana 2012 / 2013® Todos los derechos reservados I <a href="http://www.estudiosendero.com.ar" target="_blank">diseño Sendero</a></span></td>
  </tr>
</table>
</body>
</html>
