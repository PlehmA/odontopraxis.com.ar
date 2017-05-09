<?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Creamos el enlace para solicitar la verificación con la API de Google.
    $params = array();  // Array donde almacenar los parámetros de la petición
    $params['secret'] = '6LdJhSAUAAAAAEADmP9DpG7kGkljKgKNgc_DwejR'; // Clave privada
    if (!empty($_POST) && isset($_POST['g-recaptcha-response'])) {
    $params['response'] = urlencode($_POST['g-recaptcha-response']);
    }
    $params['remoteip'] = $_SERVER['REMOTE_ADDR'];
    
    
    $params_string = http_build_query($params);
    
    $requestURL = 'https://www.google.com/recaptcha/api/siteverify?' . $params_string;
    
    
    $curl = curl_init();
    
    curl_setopt_array($curl, array(
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_URL => $requestURL,
    ));
    
    $response = curl_exec($curl);
    
    curl_close($curl);
    
    echo $response;
    }
?>