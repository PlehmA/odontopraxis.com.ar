<?
	session_start();
	if (!isset($_SESSION['usuario']))	{
		header("location: ".LOGIN_PAGE);
		return;
	}
	
	if ($_SESSION['usuario']=='')	{
		header("location: ".LOGIN_PAGE);
		return;
	}

	if (time() > $_SESSION['expire']) {
            session_destroy();
            header("location: ".LOGIN_PAGE);
        }
?>