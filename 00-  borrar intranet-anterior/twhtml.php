<?php
require_once "Mail.php";
require_once "Mail/mime.php";
//require_once "Mail/mail.php";
 
$host = "smtp.accusys.com.ar";
$username = "website@accusys.com.ar";
$password = "lasrosas123";
$port = "25";
 
$from = "info <website@accusys.com.ar>";
$to = "Prueba <gquiroga@calandrelli.com>";
$subject = "Prueba";
 
$html = '<html><body> Ingrese <a href=http://www.accusys.com.ar> accusys </a>. Prueba html. </body></html>';
 
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
  echo("<p>Message successfully sent!</p>");
 }
?>
