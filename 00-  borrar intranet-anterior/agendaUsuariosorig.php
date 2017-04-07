<?
include ('lib.php');
include ('checks.php');


$MAX_NEWS = 2;
$RED_FONT = "font-family: Arial, Helvetica, sans-serif; font-size: 11px; color: red";


include ('conect.php');


$TABLA = DB_PREFIX . "usuarios" ;


?>


<?

	$listHeaders = Array(
					Array("titulo" => "Fecha de registro", "campo" => "fecha_reg", "celdas" => "1"),
					Array("titulo" => "Nombre", "campo" => "nombre", "celdas" => "1"),
					Array("titulo" => "Apellido", "campo" => "apellido", "celdas" => "1"),
					Array("titulo" => "Sector", "campo" => "sector", "celdas" => "1"),
					Array("titulo" => "Edificio", "campo" => "edificio", "celdas" => "1"),
					Array("titulo" => "E-mail", "campo" => "email", "celdas" => "1")
					);
	

	$filtro_orderby = "1";	// Nombre
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
<title>Agenda de usuarios </title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="styles.css" type="text/css">
</head>

<body bgcolor="#EBEBEB" link="#153579" vlink="#153579" alink="#153579" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
  <? include ('header2.php');?>

<p align=center><b><font face="Arial, Helvetica, sans-serif" size="3">Agenda de usuarios </b></p>

<p align=center>
	<input type="button" name="boton2" value="Volver" onclick="location='<?=MAIN_PAGE?>';" style="width:150px"/>
</p>


<table width="80%" border="0" cellspacing="0" cellpadding="0" align="center">

		<tr bgcolor="#BCCCCC" height="25px">
		<?
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
						if ($filtro_order == 0)	// ASC
							echo "<a href=\"javascript:ordenar('1')\" title=\"Ordenar descendente esta columna\"><img src=\"img/sort_dn.gif\"/ border=\"0\"></a>";
						else	// DESC
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
	
	$sql = "SELECT * FROM $TABLA ";
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
	$clave = mysql_result($res, $idx,'clave');
	$adm = mysql_result($res, $idx,'adm');
	$activo = mysql_result($res, $idx,'activo');
	$nro_doc = mysql_result($res, $idx,'nro_doc');
	$email = mysql_result($res, $idx,'email');
	$edificio = mysql_result($res, $idx,'edificio');
	$sector = mysql_result($res, $idx,'sector');
	$nombre = mysql_result($res, $idx,'nombre');
	$apellido = mysql_result($res, $idx,'apellido');
	$fecha_reg = mysql_result($res, $idx,'fecha_reg');
		
?>
		<tr height="25">
		   
		    <td class="txt_abm" nowrap>
		    	<?=$fecha_reg?>
		    </td>
		    <td class="txt_abm">&nbsp;&nbsp;</td>
		    
		    <td class="txt_abm" width="40%">
		    	<?=$nombre?>
		    </td>
		    <td class="txt_abm">&nbsp;&nbsp;</td>
		    <td class="txt_abm" width="40%">
		    	<?=$apellido?>
		    </td>
		    <td class="txt_abm">&nbsp;&nbsp;</td>
		     
		    <td class="txt_abm">
		    	<?=stripslashes($sector)?>
		    </td>
		    <td class="txt_abm">&nbsp;&nbsp;</td>

 			<td class="txt_abm">
		    	<?=stripslashes($edificio)?>
		    </td>
		    <td class="txt_abm">&nbsp;&nbsp;</td>

		    <td class="txt_abm" width="40%">
		    	<?=$email?>
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
		window.location = "agendaUsuarios.php?orderby=" + param + "&rnd=" + Math.random();
	}
	function ordenar(param)
	{
		window.location = "agendaUsuarios.php?orderby=<?=$filtro_orderby?>&order=" + param + "&rnd=" + Math.random();
	}
	function borrar(id)	{
		var conf = confirm("¿Está seguro que desea eliminar el usuario?");
		if (conf)	{
			window.location="agendaUsuarios.php?accion=BAJA&id="+id;
		}
	}
</script>

<br>
<br>
<p align=center>
	<input type="button" name="boton2" value="Volver" onclick="location='<?=MAIN_PAGE?>';" style="width:150px"/>
</p>
<br>
</body>
</html>



