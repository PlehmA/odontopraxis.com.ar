<?php
require_once "Mail.php";
require_once "Mail/mime.php";
//require_once "Mail/mail.php";
 
$host = "smtp.accusys.com.ar";
$username = "website@accusys.com.ar";
$password = "lasrosas123";
$port = "25";
 
$from = "info <website@accusys.com.ar>";
$to = "Accusys <info@accusys.com.ar>";
$subject = "Contacto Web Accusys";

$nombre=$_POST['nombre'];
	$email=$_POST['email'];
	$empresa=$_POST['empresa'];
	$cargo=$_POST['cargo'];
	$tel=$_POST['tel'];
	$pais=$_POST['pais'];
	$newsletter=$_POST['newsletter'];
	$mensaje=$_POST['mensaje'];

 
//$html = '<html><body> Ingrese <a href=http://www.accusys.com.ar> accusys </a>. Prueba html. </body></html>';
	$html = "Nombre: " .$nombre. "<br>";
	$html.= "Email: " .$email. "<br>";
	$html.= "Empresa: " .$empresa. "<br>"; 
	$html.= "Cargo: " .$cargo."<br>"; 
	$html.= "Tel: " .$tel. "<br>";
	$html.= "País: " .$pais. "<br>";
	$html.= "Suscripción a Newsletter: " .$newsletter."<br>"; 
	$html.= "Su comentario: ". $mensaje."<br>";
 
$hdrs = array ('From' => $from,
  'To' => $to,
  'Subject' => $subject,
  );
 
$mime = new Mail_mime();  
$mime->setTXTBody(strip_tags($html));
$mime->setHTMLBody($html);
 
$body = $mime->get();
$hdrs = $mime->headers($hdrs);  
 
$smtp = Mail::factory('smtp',
  array ('host' => $host,
  	'port' => $port,
    'auth' => true,
    'username' => $username,
    'password' => $password));
 
$mail = $smtp->send($to, $hdrs, $body);
 
if (PEAR::isError($mail)) {
  echo("<p>" . $mail->getMessage() . "</p>");
 } else {
 // echo("<p>Message successfully sent!</p>");
 }
?>