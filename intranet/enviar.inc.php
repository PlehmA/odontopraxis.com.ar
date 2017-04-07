<?
require_once "Mail.php";
require_once "Mail/mime.php";
//require_once "Mail/mail.php";
 
$host = "smtp.accusys.com.ar";
$username = "website@accusys.com.ar";
$password = "lasrosas123";
$port = "25";
 
$from = "info <website@accusys.com.ar>";
$to = "Accusys <info@accusys.com.ar>, Recursos Humanos <rrhh@accusys.com.ar>";
$subject = "Formulario Recursos Humanos Accusys";

$nombre=$_POST['nombre'];
	$email=$_POST['email'];
	$telefono=$_POST['telefono'];
	$perfil=$_POST['puesto'];
	$remuneracion=$_POST['remuneracion'];
	$comentarios=$_POST['comentarios'];
	
	
//set where you want to store files
//in this example we keep file in folder upload 
//$HTTP_POST_FILES['ufile']['name']; = upload file name
//for example upload file name cartoon.gif . $path will be upload/cartoon.gif

$destfile1 = $nombre."_".$HTTP_POST_FILES['ufile']['name'][0];
$replacefilenamesrc = (array ("á", "é", "í", "ó", "ö", "o", "ú", "ü", "u", "Á", "É", "Í", "Ó", "Ö", "O", "Ú", "Ü", "U", "l", "L", "š", "Š", "c", "C", "t", "T", "ž", "Ž", "ý", "Ý", "ä", "n", "N", "ô", "d", "¿", "?", "!", "'", " ","docx"));  
$replacefilenamedst = (array ("a", "e", "i", "o", "o", "o", "u", "u", "u", "A", "E", "I", "O", "O", "O", "U", "U", "U", "l", "L", "s", "S", "c", "C", "t", "T", "z", "Z", "y", "Y", "a", "n", "N", "o", "d", "_", "_", "_", "_", "_","doc"));  
$NewFileName = str_replace($replacefilenamesrc, $replacefilenamedst, $destfile1);  
//$path1= "upload/".$nombre."_".$HTTP_POST_FILES['ufile']['name'][0];
$path1= "upload/".$NewFileName;

//copy file to where you want to store file
//copy($HTTP_POST_FILES['ufile']['tmp_name'][0], $path1);
copy($HTTP_POST_FILES['ufile']['tmp_name'][0], $path1);


	/* message */ // Componer e-mail
	$NL = "<br>";
	$message = "El usuario de la página dejó los siguientes datos <br>" . $NL;
	$message .= "Nombre y Apellido: " . $nombre . "<br>"; 
	$message .= "Perfil: " . $perfil . "<br>"; 
	$message .= "Remuneración pretendida: " . $remuneracion . "<br>";
$message .= "Email : " . $email . "<br>"; 
$message .= "Teléfono : " . $telefono . "<br>"; 
$message .= "CV: http://www.accusys.com.ar/upload/".$NewFileName . "<br>"; 
$message .= "comentarios: " . $comentarios ."<br>"; 

/* recipients */
$hdrs = array ('From' => $from,
  'To' => $to,
  'Subject' => $subject,
  );
 
$mime = new Mail_mime();  
$mime->setTXTBody(strip_tags($message));
$mime->setHTMLBody($message);
 
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

<div id="contenedor">
  <div class="barra_titulo">
    <p>&nbsp;</p>
    <p><span class="atencion_titulo"><font face="Verdana, Arial, Helvetica, sans-serif" size="2" color="#666666">Su 
      CV ha sido enviado.</font></span></p>
  </div>
</div>
