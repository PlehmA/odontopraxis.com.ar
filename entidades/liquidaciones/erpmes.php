<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<title>Explorador de archivos en PHP</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
	<style>
	section>div	{clear:both;}
	.group		{overflow:hidden;padding:2px;}
	section .group:nth-child(odd) {background:#e5e5e5;}
	.directory	{font-weight:bold;}
	.name		{float:left;width:250px;overflow:hidden;}
	.mime		{float:left;margin-left:10px;}
	.size		{float:right;}
	.bold		{font-weight:bold;}
	footer		{text-align:center;margin-top:20px;color:#808080;}
	</style>
</head>
<body>
<?php
// obtenemos la ruta a revisar, y la ruta anterior para volver...
if($_GET["path"])
{
	$path=$_GET["path"];
	$back=implode("/",explode("/",$_GET["path"],-2));
	if($back){
		$back.="/*";
			 }
	else{

		$back="*";
		}
}else{

	$path="*";

}
?>
<header>
	<h1>Explorador de archivos en PHP</h1>
</header>
<nav>
	<h2><?php echo $path?></h2>
</nav>
<section>
	<?php
	// si no estamos en la raiz, permitimos volver hacia atras
	if($path!="*"){
		echo "<div class='bold group'><a href='?path=".$back."'>...</a></div>";
	}
	// devuelve el tipo mime de su extensión (desde PHP 5.3)

	$finfo1 = finfo_open(FILEINFO_MIME_TYPE);

	// devuelve la codificación mime del fichero (desde PHP 5.3)

	$finfo2 = finfo_open(FILEINFO_MIME_ENCODING);
	$folder=0;
	$file=0;
	# recorremos todos los archivos de la carpeta

	foreach (glob($path) as $filename)

	{
		$fileMime=finfo_file($finfo1, $filename);

		$fileEncoding=finfo_file($finfo2, $filename);

		if($fileMime=="directory")

		{

			$folder+=1;

			// mostramos la carpeta y permitimos pulsar sobre la misma

			echo "<div class='directory group'>

				<a href='?path=".$filename."/*' class='name'>".end(explode("/",$filename))."</a>

				<div class='mime'>(".$fileEncoding.")</div>

			</div>";

		}else{

			$file+=1;

			// mostramos la información del archivo

			echo "<div class='group'>

				<div class='size'>".number_format(filesize($filename)/1024,2,",",".")." Kb</div>

				<div class='name'>".end(explode("/",$filename))."</div>

				<div class='mime'>".$fileMime." (".$fileEncoding.")</div>

			</div>";

		}

	}

 

	finfo_close($finfo1);

	finfo_close($finfo2);

	?>

	<footer>

		<?php echo $folder?> carpeta/s y <?php echo $file?> archivo/s

	</footer>

</section>

 
<script src="https://code.jquery.com/jquery-3.2.1.js" integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE=" crossorigin="anonymous">
</script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous">
</script>
</body>

</html>