<?
	define("TITLE",			"Intranet");
	define("MAIN_PAGE",		"home.php");
	define("LOGIN_PAGE",	"index.php");
	define("DB_PREFIX",		"");
	define("OS_FILE_SEPARATOR",		"/");
	define("SEPARADOR_CADENA",		"|");
	define("NOTICIAS_DIR",			"datos/noticias/");
	define("EVENTOS_DIR",			"datos/eventos/");
	define("DOWNLOADS_DIR",			"datos/downloads/");
	define("PROFILE_DIR", "datos/perfiles/");
	define("MAX_WIDTH","128");
define("MAX_HEIGHT","128");
define("CARPETAS_DIR",	"datos/archivos/");

	//define("REFERER_PARAM",			"referer");
	define("LISTA_PARAM",			"l");
	define("NOTICIAS_ITEMS_POR_PAGINA",	"4");
	define("EVENTOS_ITEMS_POR_PAGINA",	"4");
	

 	function getPageSettings($itemsPerPage, $itemNumber, $currPage)
	{
		
		$firstPage = 1;
		$lastPage = 1;
		
		if ($itemNumber > 0)
		{
			$lastPage = intval($itemNumber / $itemsPerPage);
			if ( ($itemNumber % $itemsPerPage) != 0 )
				$lastPage++;
		}
		
		$realCurrPage = $firstPage;
		if (is_numeric($currPage))
		{
			if (($currPage >= $firstPage) && ($currPage <= $lastPage))
				$realCurrPage = $currPage;
		}
	
		$firstItemPos = (($realCurrPage - 1) * $itemsPerPage) + 1;
		$lastItemPos = (($realCurrPage * $itemsPerPage) <= $itemNumber) ? ($realCurrPage * $itemsPerPage) : $itemNumber;
		
		$settings = Array(
					"ITEMS_PER_PAGE" => $itemsPerPage,
					"ITEM_NUMBER" => $itemNumber,
					"FIRST_PAGE" => $firstPage,
					"LAST_PAGE" => $lastPage,
					"CURR_PAGE" => $realCurrPage,
					"FIRST_ITEM" => $firstItemPos,
					"LAST_ITEM" => $lastItemPos
					);

		return $settings;
	}

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


function getBirthDays(){

	$sql  = "select * from " . DB_PREFIX . "usuarios ";
	$sql .= "WHERE MONTH( fecha_nac ) = MONTH( NOW( ) ) AND DAY( fecha_nac ) = DAY( NOW( ) ) ";

	$res = mysql_query($sql);
	$total = mysql_num_rows($res);
	$_SESSION['CUMPLES']=$total;

	$idx = 0;
	while ($idx < $total)	{
		
		$nombre = mysql_result($res,$idx,'nombre');
		$apellido = mysql_result($res,$idx,'apellido');
		$id = mysql_result($res,$idx,'id');
		$foto = mysql_result($res,$idx,'foto');
		$email = mysql_result($res,$idx,'email');

		$cumple = Array(
					"NOMBRE" => $nombre,
					"APELLIDO" => $apellido,
					"ID" => $id,
					"IMAGE" => $foto,
					"EMAIL" => $email);

		$_SESSION['CUMPLE'.$idx]=$cumple;
		$idx++;
	}

	mysql_free_result($res);

}


 
?>