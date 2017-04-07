<!--************* Abm impositivo ***************************-->

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />



<head>

<style type="text/css">

.enviado {
	text-align: center;
	font-family: Verdana, Geneva, sans-serif;
	color: #333;
	border: thin solid #3CF;
	height: 60px;
	width: 300px;
	float: left;
	margin: 10%;
	font-weight: bold;
	vertical-align: middle;
	font-size: 12px;
	padding: 1%;
}
</style>

</head>

<body>

<span class="enviado">


<?php 


 $asunto = "Mensaje enviado por";
function form_mail($sPara, $sAsunto, $sTexto, $sDe)
{ 
$bHayFicheros = 0; 
$sCabeceraTexto = ""; 
$sAdjuntos = "";

if ($sDe)$sCabeceras = "From:".$sDe."\n"; 
else $sCabeceras = ""; 
$sCabeceras .= "MIME-version: 1.0\n"; 
foreach ($_POST as $sNombre => $sValor) 
$sTexto = $sTexto."\n".$sNombre." = ".$sValor;

foreach ($_FILES as $vAdjunto)
{ 
if ($bHayFicheros == 0)
{ 
$bHayFicheros = 1; 
$sCabeceras .= "Content-type: multipart/mixed;"; 
$sCabeceras .= "boundary=\"--_Separador-de-mensajes_--\"\n";

$sCabeceraTexto = "----_Separador-de-mensajes_--\n"; 
$sCabeceraTexto .= "Content-type: text/plain;charset=iso-8859-1\n"; 
$sCabeceraTexto .= "Content-transfer-encoding: 7BIT\n";

$sTexto = $sCabeceraTexto.$sTexto; 
} 
if ($vAdjunto["size"] > 0)
{ 
$sAdjuntos .= "\n\n----_Separador-de-mensajes_--\n"; 
$sAdjuntos .= "Content-type: ".$vAdjunto["type"].";name=\"".$vAdjunto["name"]."\"\n";; 
$sAdjuntos .= "Content-Transfer-Encoding: BASE64\n"; 
$sAdjuntos .= "Content-disposition: attachment;filename=\"".$vAdjunto["name"]."\"\n\n";

$oFichero = fopen($vAdjunto["tmp_name"], 'r'); 
$sContenido = fread($oFichero, filesize($vAdjunto["tmp_name"])); 
$sAdjuntos .= chunk_split(base64_encode($sContenido)); 
fclose($oFichero); 
} 
}

if ($bHayFicheros) 
$sTexto .= $sAdjuntos."\n\n----_Separador-de-mensajes_----\n"; 
return(mail($sPara, $sAsunto, $sTexto, $sCabeceras)); 
}

//cambiar aqui el email 
if (form_mail("profesionales@odontopraxis.com.ar", 
$asunto = "WEB - Comprobantes con vencimiento - Enviado por: ".$_POST['prestador'],
"Los datos introducidos en el formulario son:\n\n", $_POST[email])) 



  echo
  
  "Su mensaje se envió correctamente. <br /> Muchas gracias <br /> <br />
 
  
  "; 
?>

<a href="entidades-home.php">REGRESAR
</a>
</body>
</html>
 