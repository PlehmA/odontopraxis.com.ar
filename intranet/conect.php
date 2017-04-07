<? 
$dbhost="localhost";
$dbname="ox000342_intranet";
$dbuser="ox000342_intra";
$dbpass="Odontopraxis01";

	$dbh = mysql_connect($dbhost,$dbuser,$dbpass); 
	mysql_select_db($dbname,$dbh);
	$db = new mysqli($dbhost,$dbuser,$dbpass,$dbname);
	if ($db->connect_errno) {
	die ("<h1>Fallo al conectar a MySQL: (" . $db->connect_errno . ") " . $db->connect_error."</h1>");
}
?>
