<?php
include_once ('conect.php');
header('Content-Type: text/html;charset-UTF-8');
$username=$_POST['usuario'];
$password=$_POST['password'];
$con=crearConexion();
$con->set_charset("UTF-8");
$sql="SELECT nombre, clave FROM users_entidades WHERE nombre= '$username' AND clave='$password'";
$result=$con->query("SELECT id_usuario FROM users_entidades");
$row=$result->fetch_assoc();
if ($row['id_usuario']==0)
{
   echo "<script>alert ('¡Ingreso invalido al sistema!')</script>";
    echo "<script>window.location.assign('index.php')</script>";
}
   else
         {
            session_start();
            $_SESSION['time']=date('H:i:s');
            $_SESSION['usuario']=$username;
            $_SESSION['logeado']=true;
            header("location:welcome.php");
         }; 
?>
