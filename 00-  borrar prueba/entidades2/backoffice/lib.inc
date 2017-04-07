<?
	define("TITLE",			"Entidades");
	define("MAIN_PAGE",		"home.php");
	define("LOGIN_PAGE",	"index.php");
	define("DB_PREFIX",		"");
	define("OS_FILE_SEPARATOR",		"/");
	define("SEPARADOR_CADENA",		"|");
	define("SITIO",			"ENTIDADES");
	define("USERS_TABLE" , "users_entidades");
	define("CARPETAS_DIR",	"../descargables/");
	define("CARPETA_RES",	"Resumen/");
    define("CARPETA_LIQ",	"Liquidacion/");
	

function getFilename($dir, $filename)
{
//	echo("dir: " . $dir . "\n");
//	echo("filename: " . $filename . "\n");

	if (file_exists($dir.$filename))	{
		$name = "";;
		$ext = "";

		// separar nombre de extensión
		$pos = strrpos($filename, ".");
		if ($pos === false) { 	// sin extensión
			$name = $filename;
			$ext = "";
		}
		else	{
			$len = strlen($filename); 
			if ($len < $pos)	{ 	// el punto es el último caracter
				$name = $filename;
				$ext = "";
			} else { 
				$name = substr($filename, 0, $pos); 
				$ext = substr($filename, $pos+1); 
			} 
		}
	//	echo("name: " . $name . "\n");
	//	echo("ext: " . $ext . "\n");
		
		for ($i = 0; $i <= 100; $i++) {
			$newName = $name . "." . strval($i);
			if ($ext != "")
				$newName = $newName . "." . $ext;
			if (!file_exists($dir . $newName))		// este nombre de archivo no existe.
				return $newName;
		}	// end for
		
		return "";	// siempre está repetido!
	}	// end if

	return $filename;
}

 
?>