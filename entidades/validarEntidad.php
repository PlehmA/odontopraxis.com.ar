<?php
include_once ('conect.php');
header('Content-Type: text/html;charset-UTF-8');
$username=$_POST['usuario'];
$password=$_POST['password'];
$con=crearConexion();
$con->set_charset("UTF-8");
$sql="SELECT * FROM users_entidades WHERE clave='$password' AND nombre= '$username'";
$result=$con->query("SELECT id FROM users_entidades");
$row=$result->fetch_assoc();
if ($row['id']==0)
{
   echo "<script>alert ('¡Ingreso invalido al sistema!')</script>";
    echo "<script>window.location.assign('index.php')</script>";
}
   else
         {
            session_start();
            $_SESSION['time']=date('H:i:s');
            $_SESSION['prestador']=$username;
            $_SESSION['logeado']=true;
            $_SESSION['cuit']=$cuit;
            header("location:entidades-home.php");
         }; 
?>