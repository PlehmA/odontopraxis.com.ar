<?

//////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////
	
	function getIdxKeyStart($key)
	{
	//	print "getIdxKeyStart(key=$key)<br>";
		return "<!-- " . $key . " START -->";
	}
	function getIdxKeyEnd($key)
	{
		return "<!-- " . $key . " END -->";
	}
	
	
	function preprocessXMLString($srcString)
	{
		$resString = $srcString;
		
		$ISO_CHARSET = "<?xml version=\"1.0\" encoding=\"ISO-";
		$pos = stripos($resString, $ISO_CHARSET);
		if (($pos !==  false) && ($pos == 0))	// es ISO!!!
		{
		//	print ("preprocessXMLString -> Codificando a UTF-8...<br>");
			$resString = utf8_encode($resString);
		}
		return $resString;
	}
	
	function getWords($str)
	{
		$words = split("[\n\r\t ]+", $str);
		$str1 = "";
		for ($i = 0; $i < sizeof($words); $i++)
		{
			if (trim($words[$i]) == '') continue;
			if ($i > 0) $str1 .= " ";
			$str1 .= $words[$i];
		}
		return $str1;
	}
	
	function processPageText($str1, $tipoIndexacion)
	{
		$str = $str1;
		
		if ($tipoIndexacion != '')	// filtrar cadenas
		{
			$etiquetaEncontrada = false;
			$ETIQUETA_INICIO = getIdxKeyStart($tipoIndexacion);
			$ETIQUETA_FIN = getIdxKeyEnd($tipoIndexacion);
			$strFiltrado = "";
			$lastPos = 0;
			while (true)
			{
			//	$pos1 = strpos(strtolower($str), $ETIQUETA_INICIO, $lastPos);
				$pos1 = strpos($str, $ETIQUETA_INICIO, $lastPos);
				if ($pos1 !== false)	// encontrado
				{
					$etiquetaEncontrada = true;
				//	$pos2 = strpos(strtolower($str), $ETIQUETA_FIN, $pos1 + strlen($ETIQUETA_INICIO));
					$pos2 = strpos($str, $ETIQUETA_FIN, $pos1 + strlen($ETIQUETA_INICIO));
					if ($pos2 !== false)	// encontrado
					{
						$strFiltrado .= " " . substr($str, $pos1 + strlen($ETIQUETA_INICIO), $pos2 - ($pos1 + strlen($ETIQUETA_INICIO)));
						$lastPos = $pos2 + strlen($ETIQUETA_FIN);
					}
					else
					{
						$lastPos = $pos1 + strlen($ETIQUETA_INICIO);
					}
				}
				else
					break;
			}
		//	if ($strFiltrado != '')
			if ($etiquetaEncontrada)
				$str = $strFiltrado;
		}
		
		$SCRIPT_START = "<script";
		$SCRIPT_END = "</script>";
		// eliminar los <script>..</script>
		$lastPos = 0;
		while (true)
		{
			$pos1 = strpos(strtolower($str), $SCRIPT_START, $lastPos);
			if ($pos1 !== false)	// encontrado
			{
				$pos2 = strpos(strtolower($str), $SCRIPT_END, $pos1 + strlen($SCRIPT_START));
				if ($pos2 !== false)	// encontrado
				{
				//	$str = substr($str, $pos1, $pos2 + strlen($SCRIPT_END) - $pos1);
					$tempStr = substr($str, 0, $pos1);
					$tempStr.= substr($str, $pos2 + strlen($SCRIPT_END));
					$str = $tempStr;
					$lastPos = 0;
				}
				else
				{
					$lastPos = $pos1 + strlen($SCRIPT_START);
				}
			}
			else
				break;
		}

		$str = strip_tags($str);
		
		$str = getWords($str);
	//	print "str: $str<br>";

		return $str;
	}

	function getStandardUrl($page)
	{
		$domain = $_SERVER['HTTP_HOST'];
	//	$path = $_SERVER['SCRIPT_NAME'];
	//	print "domain: $domain<br>";
	//	print "path: $path<br>";
		$path_parts = split("\/", $_SERVER['SCRIPT_NAME']);
	//	print_r ($path_parts); print "<br>";
		
		$path = "";
		for ($i = 0; $i < sizeof($path_parts)-2; $i++)	// discard 'backoffice' and script-name
		{
			if ($path_parts[$i] != '')
				$path.= "/" . $path_parts[$i];
		}
	//	print "path: $path<br>";
		
		$newUrl = "http://" . $domain . $path;
		
		$pos = strpos($page, "/");
		if (($pos !== false) && ($pos == 0))
			$newUrl.= $page;
		else
			$newUrl.= "/" . $page;

		return $newUrl;
	}

	function actualizarPagina($tabla, $id)
	{
		$encontrado = false;
		$sql = "SELECT * FROM $tabla WHERE id='$id'";
		
		$res = mysql_query($sql);
		if (mysql_num_rows($res) >= 1)
		{
			$encontrado = true;
			$url = stripslashes(mysql_result($res,0,'url'));
			$fullurl = mysql_result($res,0,'fullurl');
			$titulo = stripslashes(mysql_result($res,0,'titulo'));
			$texto = mysql_result($res,0,'texto');
			$habilitado = mysql_result($res,0,'habilitado');
			$indexado = mysql_result($res,0,'indexado');
			$fecha_actualizacion = mysql_result($res,0,'fecha_actualizacion');
			$tipo = mysql_result($res,0,'tipo');
		}
		mysql_free_result($res);
		
		if (!$encontrado)
			return false;
		
		$texto = '';
		$indexado = 'S';
		
	//	print "fullurl: $fullurl<br>";
	//	$pageContents = preprocessXMLString(HttpClient::quickGet($fullurl));
		$pageContents = HttpClient::quickGet($fullurl);
		$texto = processPageText($pageContents, $tipo);
	//	print "pageContents:<br>$pageContents<br>";
	
		$sql = "UPDATE $tabla SET texto='$texto', indexado='$indexado', fecha_actualizacion=NOW() ";
		$sql.= " WHERE id='$id'";
		mysql_query($sql);
		
		return ($indexado == 'S');
	}

	function actualizarPaginaPorUrl($tablaPrefijo, $pagina)
	{
		$encontrado = false;
		$id = '';
		$sql = "SELECT * FROM " . $tablaPrefijo . "paginasidx WHERE fullurl LIKE '%$pagina'";
		$res = mysql_query($sql);
		if (mysql_num_rows($res) >= 1)
		{
			$encontrado = true;
			$id = mysql_result($res,0,'id');
		}
		mysql_free_result($res);
		
		if ($encontrado)
			actualizarPagina($tablaPrefijo . "paginasidx", $id);
	}
	

?>
