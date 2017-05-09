<?php 
include 'conection.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,700&amp;subset=latin-ext" rel="stylesheet">
	<link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="container">
	<table class="table table-responsive table-bordered">
	<thead>
	
		<th>tipo ident</th>
		<th>numero dni</th>
		<th>apellido</th>
		<th>nombre</th>
		<th>email</th>
		<th>rol</th>
		<th>fecha</th>
		<th>act</th>
		<th>ID</th>
		
	</thead>
<?php 
$sql = "SELECT * FROM users_entidades";
$result = mysqli_query($con, $sql);
while ($row = mysqli_fetch_array($result)) {
?>
	<tbody>
		<td><?php echo $row['0']; ?></td>
		<td><?php echo $row['1']; ?></td>
		<td><?php echo $row['4']; ?></td>
		<td><?php echo $row['5']; ?></td>
		<td><?php echo $row['6']; ?></td>
		<td><?php echo $row['9']; ?></td>
		<td><?php echo $row['10']; ?></td>
		<td><?php echo $row['11']; ?></td>
		<td><?php echo $row['12']; ?></td>
	</tbody>
	<?php } ?>
</table>
</div>
<script
  src="https://code.jquery.com/jquery-3.2.1.js"
  integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE="
  crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</body>
</html>
