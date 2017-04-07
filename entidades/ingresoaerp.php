<?php
include ('conect.php');
header('Content-Type: text/html;charset-UTF-8');
$sql="SELECT * FROM users_entidades WHERE cuit=".$_SESSION['cuit'];		
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>E.R.P.</title>
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
}
td {
	text-align: center;
}
</style>
<div class="container text-center">

	<h3>Bienvenido/a <?php echo $_SESSION['usuario']; ?></h3>
	<h5>Esta es la lista de PDFs.</h5>
	<br>
	<div class="center-block">
	<table class="table">
	<tr>
		<th>
			Período
		</th>
		<th>
			Ordenes
		</th>
	</tr>
<?php
function listFiles($directorio){ //La función recibira como parametro un directorio
if (is_dir($directorio)) { //Comprobamos que sea un directorio Valido
if ($dir = opendir($directorio)) {//Abrimos el directorio
while (($archivo = readdir($dir)) !== false){ //Comenzamos a leer archivo por archivo
if ($archivo != '.' && $archivo != '..'){//Omitimos los archivos del sistema . y ..
$nuevaRuta = $directorio.$archivo;//Creamos unaruta con la ruta anterior y el nombre del archivo actual 
if (is_dir($nuevaRuta)) { //Si la ruta que creamos es un directorio entonces:
echo '<b>'.$nuevaRuta.'</b>'; //Imprimimos la ruta completa resaltandola en negrita
listFiles($nuevaRuta);//Volvemos a llamar a este metodo para que explore ese directorio.
} else { //si no es un directorio:
$ruta_archivo = $directorio.$archivo;
?>
		<tr>
		<td>
			fecha
		</td>
		<td>
			<?php  echo "<a href='".$ruta_archivo."' target='_blank'>Archivo: ".$archivo."</a>";?>
		</td>
	</tr>
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
listFiles("erp/PDF/");
?>		
</table>
	<br>
	<hr>
	</div>
		<button class="btn btn-default btn-sm center-block"><a href="entidades-home.php">Volver</a></button>
</div>

	<script src="https://code.jquery.com/jquery-3.2.1.js" integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE=" crossorigin="anonymous">
	</script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous">
	</script>
</body>
</html>