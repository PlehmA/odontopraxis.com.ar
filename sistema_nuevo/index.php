<!DOCTYPE <html> <?php session_start(); ?>
</html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Ingreso al sistema</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,700&amp;subset=latin-ext" rel="stylesheet">
	<link rel="stylesheet" href="css/style.css">
</head>
<body>
<style>
	#formlog {
		background-image: url("images/man-2140606_640.jpg");
		background-repeat: no-repeat;
		background-size: 50%;
		background-position: center;
		padding-left: 15px;
		padding-right: 15px;
	}
</style>
<div class="container">
	<div class="img-rounded img-responsive pull-left col-lg-12 col-md-12 col-sm-12 col-xs-12"> <!--Logo-->
		<img src="images/logo.png" alt="">
	</div><!--Fin Logo-->
	<br>
	<div class="text-center col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<h4>Ingreso al sistema</h4>
	</div>
	<div class="form-group col-lg-offset-3 col-md-offset-3 col-sm-offset-3 col-xs-offset-3 col-lg-6 col-lg-offset-3" id="formlog"><!--Formulario-->
		<form action="login.php" method="POST" class="form-horizontal">
			<label>Usuario</label>
			<input type="text" name="username" class="input-group form-control input-sm" required>
			<label>Contraseña</label>
			<input type="password" name="password" class="input-group form-control input-sm" required>
			<br>
			<div class="center-block"><input type="submit" class="btn btn-success col-md-offset-4 col-md-4" name="login" value="Login"></div>
		</form>
	</div><!--Fin Formulario-->
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"><!--Firma-->
	<hr>
	<br>
		<p class="pull-right">Odontopraxis Americana <?php echo date('Y'); ?>® Todos los derechos reservados.</p>
	</div><!--Fin Firma-->

</div>
<script
  src="https://code.jquery.com/jquery-3.2.1.js"
  integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE="
  crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</body>
</html>