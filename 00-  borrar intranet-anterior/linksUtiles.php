<?
include ('lib.php');
include ('checks.php');

$RED_FONT = "font-family: Arial, Helvetica, sans-serif; font-size: 11px; color: red";


include ('conect.php');


$TABLA = DB_PREFIX . "links" ;


//////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////


	$listHeaders = Array(
					Array("titulo" => "Titulo", "campo" => "titulo", "celdas" => "1"),
					Array("titulo" => "Link", "campo" => "link", "celdas" => "1"),
					);
	
	$filtro_orderby = "1";	// titulo
	if ((isset($_GET['orderby'])) && (is_numeric($_GET['orderby'])))
	{
		$orderby = $_GET['orderby'];
		if (($orderby >= 0) && ($orderby < sizeof($listHeaders)))
			$filtro_orderby = $orderby;
	}
	$filtro_order = "0";	//ASC
	if ((isset($_GET['order'])) && (is_numeric($_GET['order'])))
	{
		$order = $_GET['order'];
		if (($order == 0) || ($order == 1))
			$filtro_order = $order;
	}


?>
<html>
<head>
<title>Links de Interes</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="contenido.css" type="text/css">
</head>
<body bgcolor="#FFFFFF" text="#000000" topmargin="0" leftmargin="0">
<table width="1000" class="contenedor" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr> 
    <td> 
      <?php include"header.php"?>
      <?php include"checks.php"?>
    </td>
  </tr>
  <tr> 
    <td> 
      <!--<div align="center">
        <?php include"flash.php"?>
      </div>-->
    </td>
  </tr>
  <!--<tr> 
    <td> 
      <?php include"menu_ac.php"?>
    </td>
  </tr>-->
  <tr> 
    <td> 
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr> 
          <td width="130" valign="top"> 
            <?php include"lat_izq.php"?>
          </td>
          <td width="1" valign="top" bgcolor="9298AB"><img src="pixel.gif"></td>
          <td>
           <table class="agendausuariostab" width="600" border="0" cellspacing="0" cellpadding="0" align="center">

		<tr bgcolor="#BCCCCC" height="25px">
		<?
	
	$sql = "SELECT * FROM $TABLA WHERE activo ='S' ";
//	$sql.= " ORDER BY fecha, id";

	$sql.= " ORDER BY " . $listHeaders[$filtro_orderby]["campo"] . ( ($filtro_order == 0)? " ASC" : " DESC" );

	/*
	if ($filtro_orderby != '')
	{
		$sql .= "ORDER BY " . $filtro_orderby . " " . (($filtro_order == '1') ? "ASC" : "DESC");
	}
	else
		$sql.= "ORDER BY id";
	*/

	//print $sql;

	$res = mysql_query($sql);
	$total = mysql_num_rows($res);

	$idx = 0;
	while ($idx < $total)	{
	
	$id = mysql_result($res, $idx,'id');
	$titulo = mysql_result($res, $idx,'titulo');
	$link = mysql_result($res, $idx,'link');

		
?>
		<tr height="25">
		    <td class="txt_abm">&nbsp;</td>
		    <td class="txt_abm">&nbsp;&nbsp;&nbsp;</td>
		    
		   
		    <td class="txt_abm" >
		    	<font face="Arial, Helvetica, sans-serif" size="3"><?=$titulo?></font></bold>
		        </td>

		    <td class="txt_abm">&nbsp;&nbsp;</td>
		    <td class="txt_abm" >
		    	<a href="http://<?=$link?>"><?=$link?></a>
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
<script language="Javascript">
	function ordenarCampo(param)
	{
		window.location = "telefonosUtiles.php?orderby=" + param + "&rnd=" + Math.random();
	}
	function ordenar(param)
	{
		window.location = "telefonosUtiles.php?orderby=<?=$filtro_orderby?>&order=" + param + "&rnd=" + Math.random();
	}
	function borrar(id)	{
		var conf = confirm("�Est� seguro que desea eliminar el telefono?");
		if (conf)	{
			window.location="telefonosUtiles.php?accion=BAJA&id="+id;
		}
	}
</script>
<br>
<p align=center>
	<input type="button" name="boton2" value="Volver" onclick="location='<?=MAIN_PAGE?>';" style="width:150px"/>
</p>
          </td>
          <td width="1" bgcolor="9298AB"><img src="pixel.gif"></td>
          <td valign="top" width="215"> 
            <div align="right">
              <?php include"col-der.php"?>
            </div>
          </td>
        </tr>
      </table>
    </td>
  </tr>
  <tr>
    <td>
      <?php include"pie.php"?>
    </td>
  </tr>

</table>
</body>
</html>
