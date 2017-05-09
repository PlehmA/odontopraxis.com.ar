<?php
if ($activo=true) {
	include ('./conect.php');
	session_start();
	header('Content-Type: text/html;charset-UTF-8');
	$id = $_SESSION['idUsuario'];
	$prestador = $_SESSION['prestador'];
	$cuit = $_SESSION['cuit'];
	
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Ordenes de Pago</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
</head>
<body>
<style>
a{
	text-decoration: none;
	color: #000;
}
th {
	text-align: center;
	font-size: 35px;
	color: #CCC;
}
td {
	text-align: center;
}
thead {
	background-color: #B9ECFF;
}
</style>
<div class="container text-center">

	<h3>Bienvenido/a <?php echo $prestador; ?></h3>
	<h5>Ésta es la lista de PDFs.</h5>
	<br>
	<!--<nav class="pull-left">
		<ul>
			<li><a href="">2017</a></li>
			<ul>
				<li><a href="">Enero</a></li>
				<li><a href="">Febrero</a></li>
				<li><a href="">Abril</a></li>
				<li><a href="">Abril</a></li>
				<li><a href="">Junio</a></li>
				<li><a href="">Junio</a></li>
				<li><a href="">Julio</a></li>
				<li><a href="">Agosto</a></li>
				<li><a href="">Septiembre</a></li>
				<li><a href="">Octubre</a></li>
				<li><a href="">Noviembre</a></li>
				<li><a href="">Diciembre</a></li>
			</ul>
		</ul>
	</nav> -->
	<div class="center-block">
	<table class="table table-striped table-bordered text-center ">
	<thead>
		<tr>
			<th>
				Año
			</th>
		</tr>
	</thead>
	
<?php
function listFiles($directorio){ //La función recibira como parametro un directorio
if (is_dir($directorio)) { //Comprobamos que sea un directorio Valido
if ($dir = opendir($directorio)) {//Abrimos el directorio
while (($archivo = readdir($dir)) !== false){ //Comenzamos a leer archivo por archivo
if ($archivo != '.' && $archivo != '..'){//Omitimos los archivos del sistema . y ..
$nuevaRuta = $directorio.$archivo;//Creamos unaruta con la ruta anterior y el nombre del archivo actual 
if (is_dir($nuevaRuta)) { //Si la ruta que creamos es un directorio entonces:
//echo '<b>'.$nuevaRuta.'</b>'; //Imprimimos la ruta completa resaltandola en negrita
listFiles($nuevaRuta);//Volvemos a llamar a este metodo para que explore ese directorio.
} else { //si no es un directorio:
$ruta_archivo = $directorio.$archivo;
?>
<tbody>
	<tr>
		<td>
			<?php  echo "<a href='".$ruta_archivo."' target='_blank'>".$archivo."</a>";?>
		</td>
	</tr>
</tbody>
<?php
} //Cerramos el item actual y se inicia la llamada al siguiente archivo
}
}//finaliza While
closedir($dir);//Se cierra el archivo
}
}else{//Finaliza el If de la linea 12, si no es un directorio valido, muestra el siguiente mensaje
echo 'No Existe el directorio';
}
}//Fin de la Función	
//Llamamos a la función y le pasamos el nombre de nuestro directorio.
listFiles("erp/PDF/2017");
?>		
</table>
	<br>
	<hr>
	</div>
		<a href="entidades-home.php"><button class="btn btn-default btn-sm text-center">Volver</button></a>
</div>
<br>

	<script src="https://code.jquery.com/jquery-3.2.1.js" integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE=" crossorigin="anonymous">
	</script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous">
	</script>
</body>
</html>
<?php 
}
else{
	session_destroy();
	header("Location: index.php");
}



?>