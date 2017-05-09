<?php
include 'conection.php';
if(isset($_POST['login'])){
session_start();
$username = mysqli_real_escape_string($con,$_POST['username']);

$password = mysqli_real_escape_string($con,$_POST['password']);

$sel_user = "SELECT * FROM users_entidades WHERE nombre='".$username."' AND clave='".$password."'";

$run_user = mysqli_query($con, $sel_user);
$row = mysqli_fetch_row($run_user);
$check_user = mysqli_num_rows($run_user);

if($check_user>0){

$_SESSION['activo']=true;
$_SESSION['nombre']=$username;
//$_SESSION['apellido_usuario']=$apellido;
//$_SESSION['e_mail_usuario']=$emal;
//$_SESSION['rol_usuario']=$rol;
//$_SESSION['id_objeto']=$id;
	

	if ($row['12']=='PRESTADOR') {
		echo "<script>window.open('../entidades/seleccion.php','_self')</script>";
	}elseif ($row['12']=='INSTITUCION') {
		echo "<script>window.open('https://prepaga.odontopraxis.com.ar/PREPAGA/pages/login.faces','_self')</script>";
	}else{
		echo "Ups que verguenza...";
	}


}

else {

	echo "<script>alert ('Ingreso invalido al sistema!')</script>";
    echo "<script>window.location.assign('../index.php')</script>";

}

}
?>