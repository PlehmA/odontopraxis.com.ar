<?
	define("TITLE",			"Odontopraxis");
	define("MAIN_PAGE",		"menu.php");
	define("LOGIN_PAGE",	"index.php");
	define("DB_PREFIX",		"");
	define("OS_FILE_SEPARATOR",		"/");
	define("SEPARADOR_CADENA",		"|");
	define("NOTICIAS_DIR",			"../datos/noticias/");
	define("EVENTOS_DIR",			"../datos/eventos/");
	define("DOWNLOADS_DIR",			"../datos/downloads/");
	define("CARPETAS_DIR",	"../datos/archivos/");

	//define("REFERER_PARAM",			"referer");
	define("LISTA_PARAM",			"l");
	

function getFilename($dir, $filename)
{
//	echo("dir: " . $dir . "\n");
//	echo("filename: " . $filename . "\n");

	if (file_exists($dir.$filename))	{
		$name = "";;
		$ext = "";

		// separar nombre de extensi�n
		$pos = strrpos($filename, ".");
		if ($pos === false) { 	// sin extensi�n
			$name = $filename;
			$ext = "";
		}
		else	{
			$len = strlen($filename); 
			if ($len < $pos)	{ 	// el punto es el �ltimo caracter
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
		
		return "";	// siempre est� repetido!
	}	// end if

	return $filename;
}

 
?>