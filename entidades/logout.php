<?php 
session_start();
session_destroy();
print $inactivo;
header("Location: index.php");
?>