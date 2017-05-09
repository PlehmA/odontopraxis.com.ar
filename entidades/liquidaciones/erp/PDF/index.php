<?php
include ('./conect.php');
	session_start();
	header('Content-Type: text/html;charset-UTF-8');
	$id = $_SESSION['idUsuario'];
	$prestador = $_SESSION['prestador'];
	$cuit = $_SESSION['cuit'];
	$enciut = md5($cuit);

$_CONFIG = array();
$_ERROR = "";
$_LANG = array();


$_CONFIG['lang'] = "es";


$_CONFIG['starting_dir'] = "/".$enciut."/";


$_CONFIG['open_in_new_window'] = 0;


$_CONFIG['max_space'] = 25600;


$_CONFIG['dir_levels'] = 3;


$_CONFIG['show_top'] = 1;



$_CONFIG['charset'] = "UTF-8";


$_CONFIG['hidden_dirs'] = array();


$_CONFIG['hidden_files'] = array(".ftpquota", "index.php", "index.php~", ".htaccess", ".htpasswd","index.php?dir=33707820069");

$_CONFIG['upload_password'] = "";

$_CONFIG['basedir'] = "";


$_TRANSLATIONS = array();

// Albanian
$_TRANSLATIONS["al"] = array(
	"file_name" => "Emri Skedarit",
	"size" => "Madhësia",
	"last_changed" => "Ndryshuar",
	"total_used_space" => "Memorija e përdorur total",
	"free_space" => "Memorija e lirë",
	"password" => "Fjalëkalimi",
	"upload" => "Ngarko skedarë",
	"failed_upload" => "Ngarkimi i skedarit dështoi!",
	"failed_move" => "Lëvizja e skedarit në udhëzuesin e saktë deshtoi!",
	"wrong_password" => "Fjalëkalimi i Gabuar!!",
	"make_directory" => "New dir",
	"new_dir_failed" => "Failed to create directory",
	"chmod_dir_failed" => "Failed to change directory rights",
	"unable_to_read_dir" => "Unable to read directory",
	"location" => "Location",
	"root" => "Root"
);

// German
$_TRANSLATIONS["de"] = array(
	"file_name" => "Dateiname",
	"size" => "Größe",
	"last_changed" => "Letzte Änderung",
	"total_used_space" => "Benutzter Speicher",
	"free_space" => "Freier Speicher",
	"password" => "Passwort",
	"upload" => "Upload",
	"failed_upload" => "Upload ist fehlgeschlagen!",
	"failed_move" => "Verschieben der Datei ist fehlgeschlagen!",
	"wrong_password" => "Falsches Passwort",
	"make_directory" => "Neuer Ordner",
	"new_dir_failed" => "Erstellen des Ordners fehlgeschlagen",
	"chmod_dir_failed" => "Veränderung der Zugriffsrechte des Ordners fehlgeschlagen",
	"unable_to_read_dir" => "Unable to read directory",
	"location" => "Location",
	"root" => "Root"
);

// Greek
$_TRANSLATIONS["el"] = array(
	"file_name" => "Όνομα αρχείου",
	"size" => "Μέγεθος",
	"last_changed" => "Τροποποιημένο",
	"total_used_space" => "Χρησιμοποιημένος χώρος",
	"free_space" => "Ελεύθερος χώρος",
	"password" => "Εισάγεται κωδικό",
	"upload" => "Φόρτωση",
	"failed_upload" => "Αποτυχία φόρτωσης αρχείου!",
	"failed_move" => "Αποτυχία μεταφοράς αρχείου στον κατάλληλο φάκελο!",
	"wrong_password" => "Λάθος κωδικός",
	"make_directory" => "Δημιουργία νέου φακέλου",
	"new_dir_failed" => "Αποτυχία δημιουργίας νέου φακέλου",
	"chmod_dir_failed" => "Αποτυχία τροποποίησης δικαιωμάτων φακέλου",
	"unable_to_read_dir" => "Unable to read directory",
	"location" => "Location",
	"root" => "Root"
);

// English
$_TRANSLATIONS["en"] = array(
	"file_name" => "File name",
	"size" => "Size",
	"last_changed" => "Last changed",
	"total_used_space" => "Total used space",
	"free_space" => "Free space",
	"password" => "Password",
	"upload" => "Upload",
	"failed_upload" => "Failed to upload the file!",
	"failed_move" => "Failed to move the file into the right directory!",
	"wrong_password" => "Wrong password",
	"make_directory" => "New dir",
	"new_dir_failed" => "Failed to create directory",
	"chmod_dir_failed" => "Failed to change directory rights",
	"unable_to_read_dir" => "Unable to read directory",
	"location" => "Location",
	"root" => "Root"
);

// Spanish
$_TRANSLATIONS["es"] = array(
	"file_name" => "Nombre del archivo",
	"size" => "Tamaño",
	"last_changed" => "Ultima modificación",
	"total_used_space" => "Total espacio usado",
	"free_space" => "Espacio libre",
	"password" => "Contraseña",
	"upload" => "Subir el archivo",
	"failed_upload" => "Error al subir el archivo!",
	"failed_move" => "Error al mover el archivo al directorio seleccionado!",
	"wrong_password" => "Contraseña incorrecta",
	"make_directory" => "Nuevo directorio",
	"new_dir_failed" => "Error al crear directorio",
	"chmod_dir_failed" => "Error al cambiar derechos del directorio",
	"unable_to_read_dir" => "No se puede leer el directorio",
	"location" => "Location",
	"root" => "Root"
);

// Estonian
$_TRANSLATIONS["et"] = array(
	"file_name" => "Faili nimi",
	"size" => "Suurus",
	"last_changed" => "Viimati muudetud",
	"total_used_space" => "Kokku kasutatud",
	"free_space" => "Vaba ruumi",
	"password" => "Parool",
	"upload" => "Uploadi",
	"failed_upload" => "Faili ei &otilde;nnestunud serverisse laadida!",
	"failed_move" => "Faili ei &otilde;nnestunud &otilde;igesse kausta liigutada!",
	"wrong_password" => "Vale parool",
	"make_directory" => "Uus kaust",
	"new_dir_failed" => "Kausta loomine ebaõnnestus",
	"chmod_dir_failed" => "Kausta õiguste muutmine ebaõnnestus",
	"unable_to_read_dir" => "Unable to read directory",
	"location" => "Asukoht",
	"root" => "Peakaust"
);

// French
$_TRANSLATIONS["fr"] = array(
	"file_name" => "Nom de fichier",
	"size" => "Taille",
	"last_changed" => "Ajout&eacute;",
	"total_used_space" => "Espace total utilis&eacute;",
	"free_space" => "Espace libre",
	"password" => "Mot de passe",
	"upload" => "Envoyer un fichier",
	"failed_upload" => "Erreur lors de l'envoie!",
	"failed_move" => "Erreur lors du changement de dossier!",
	"wrong_password" => "Mauvais mot de passe",
	"make_directory" => "New dir",
	"new_dir_failed" => "Failed to create directory",
	"chmod_dir_failed" => "Failed to change directory rights",
	"unable_to_read_dir" => "Unable to read directory",
	"location" => "Location",
	"root" => "Root"
);

// Italian
$_TRANSLATIONS["it"] = array(
	"file_name" => "Nome file",
	"size" => "Dimensione",
	"last_changed" => "Ultima modifica",
	"total_used_space" => "Totale spazio usato",
	"free_space" => "Spazio disponibile",
	"password" => "Parola chiave",
	"upload" => "Caricamento file",
	"failed_upload" => "Caricamento del file fallito!",
	"failed_move" => "Spostamento del file nella cartella fallito!",
	"wrong_password" => "Password sbagliata",
	"make_directory" => "Nuova cartella",
	"new_dir_failed" => "Creazione cartella fallita!",
	"chmod_dir_failed" => "Modifica dei permessi della cartella fallita!",
	"unable_to_read_dir" => "Unable to read directory",
	"location" => "Location",
	"root" => "Root"
);

// Dutch
$_TRANSLATIONS["nl"] = array(
	"file_name" => "Bestandsnaam",
	"size" => "Omvang",
	"last_changed" => "Laatst gewijzigd",
	"total_used_space" => "Totaal gebruikte ruimte",
	"free_space" => "Beschikbaar",
	"password" => "Wachtwoord",
	"upload" => "Upload",
	"failed_upload" => "Fout bij uploaden van bestand!",
	"failed_move" => "Fout bij het verplaatsen van tijdelijk uploadbestand!",
	"wrong_password" => "Fout wachtwoord!",
	"make_directory" => "Nieuwe folder",
	"new_dir_failed" => "Fout bij aanmaken folder!",
	"chmod_dir_failed" => "Rechten konden niet gewijzigd worden!",
	"unable_to_read_dir" => "Unable to read directory",
	"location" => "Location",
	"root" => "Root"
);

// Romanian
$_TRANSLATIONS["ro"] = array(
	"file_name" => "Nume fisier",
	"size" => "Marime",
	"last_changed" => "Ultima modificare",
	"total_used_space" => "Spatiu total utilizat",
	"free_space" => "Spatiu disponibil",
	"password" => "Parola",
	"upload" => "Incarcare fisier",
	"failed_upload" => "Incarcarea fisierului a esuat!",
	"failed_move" => "Mutarea fisierului in alt director a esuat!",
	"wrong_password" => "Parola gresita!",
	"make_directory" => "New dir",
	"new_dir_failed" => "Failed to create directory",
	"chmod_dir_failed" => "Failed to change directory rights",
	"unable_to_read_dir" => "Unable to read directory",
	"location" => "Location",
	"root" => "Root"
);

// Turkish
$_TRANSLATIONS["tr"] = array(
	"file_name" => "Dosya ismi",
	"size" => "Boyut",
	"last_changed" => "gecmis",
	"total_used_space" => "Toplam dosya boyutu",
	"free_space" => "Bos alan",
	"password" => "Sifre",
	"upload" => "Yükleyen",
	"failed_upload" => "Hatali dosya yüklemesi!",
	"failed_move" => "Hatali dosya tasimasi!",
	"wrong_password" => "Yeniden sifre",
	"make_directory" => "Yeni dosya",
	"new_dir_failed" => "Dosya olusturalamadi",
	"chmod_dir_failed" => "Dosya ayari deqistirelemedi",
	"unable_to_read_dir" => "Unable to read directory",
	"location" => "Location",
	"root" => "Root"
);



function css()
{
?>

<style type="text/css">

BODY {
	background-color:#FFFFFF;
	font-family:Verdana;
}

A {
	color: #000000;
	text-decoration: none;
}

A:hover {
	text-decoration: underline;
}

#top {
	width:674px;
	height:110px;
	margin:3px;
	clip: rect(20px, 97px, 13px, 33px);
	overflow:hidden;
}

#top div.text{
	position:absolute;
	overflow:hidden;
	white-space:nowrap;
	height:107px;
	width:674px;
}

#top div.a0 {
	font-size: 24px;
	color:#92c3e1;
	height:auto;
	font-weight:bold;
	text-align:center;
	top:50px;
}

#top div.a1 {
	font-size: 105px;
	color:#f5faff;
	line-height:13px;
	text-indent: -100px;
}

#top div.a2 {
	font-size: 305px;
	color:#f8fbff;
	line-height:65px;
	text-indent: -170px;
}

#top div.a3 {
	font-size: 40px;
	color:#ecf4fd;
	line-height:85px;
	text-indent: -560px;

}

#top div.a4 {
	font-size: 100px;
	color:#f3f8fd;
	line-height:185px;
	text-indent: -460px;
}

#top div.a5 {
	font-size:34px;
	position:absolute;
	top:0px;
	left:0px;

}

#frame {
	width:680px;
	border: 1px dotted #CDD2D6;
	text-align:left;
	position: relative;
	margin: 0 auto;
}

#error {
	width:300px;
	background-color:#FFE4E1;
	font-size:10px;
	color:#000000;
	padding:7px;
	position: relative;
	margin: 10px auto;
	text-align:center;
	border: 1px dotted #CDD2D6;
}

input {
	font-size:10px;
	border: 1px solid #CDD2D6;
}

table.table {
	width: 674px; 
	font-size: 11px;
	margin:3px;
}

table.table tr.row.one {
	background-color:#fcfdfe;
}

table.table tr.row.two {
	background-color:#f8f9fa;
}

table.table tr.row td.icon {
	width:25px;
}

table.table tr.row td.size {
	width: 100px; 
	text-align: right;
}

table.table tr.row td.changed {
	width: 150px;
	text-align: center;
}

table.table tr.breadcrumbs td {
	font-weight:bold;
	color:#d7dade;
	padding-left:6px;
}

table.table tr.breadcrumbs td a {
	font-weight:bold;
	color:#d7dade;
}

#upload {
	color:#000000;
	font-size:10px;
	width:680px;
	position: relative;
	margin: 0 auto;
	text-align:center;
}

#upload input.text{
	width:100px;
}

#upload td.password {
	text-align:left;
}

#upload td.file {
	text-align:right;
}

#upload div.password {
	float:left;
}

#upload div.upload {
	float:right;
}

#info {
	color:#000000;
	font-family:Verdana;
	font-size:10px;
	width:680px;
	position: relative;
	margin: 0 auto;
	text-align:center;
}

</style>

<?php
}


$_IMAGES = array();
$_IMAGES["asp"] = "R0lGODlhEAAQAKIAAAAA/wAAhACEhMDAwP///8bGxoSEhAAAACH5BAEAAAMALAAAAAAQABAAQANK
OLrcewUeAokI9JG4oTlgA35RUQDFJ6bg4SgSxxGGCpdxERjRO4wf16vl05SCQoak06n1brFJgUBN
LpeGy/NHyp22jwPJZCuGGAkAOw==";
$_IMAGES["avi"] = "R0lGODlhEAAQALP/AMDAwAAAgAD//wCAgP8AAP///8DAwICAgAAAAAAAAAAAAAAAAAAAAAAAAAAA
AAAAACH5BAEAAAAALAAAAAAQABAAAARYEEhwqrUzn8J7MUcmbR5nFKFWckiLqKuJDBMZG/MgDHw/
cBXcoCUoIorDwQGBe7mOyCMOJ9EVr8MZ8wUYEIwCRABRaFEBz9aYLIPduKNYu2ao2+9wdHofAQA7";
$_IMAGES["bmp"] = "R0lGODlhEAAQALMAAAAAAL8AAAC/AL+/AAAAv78AvwC/v8DAwICAgP8AAAD/AP//AAAA//8A/wD/
/////yH5BAEAAAoALAAAAAAQABAAAARaUEmJAKhgzkwt3gpSUQ9gHNx1PWMSmA6hDGWGHAzgwsRw
jBKCgbEzIAaLAWciLCKVmpBoSgVSDo/sYfuzXrtTSzSE1XaXk5t5671mH+w2ef1Du80iu8TC52si
ADs=";
$_IMAGES["chm"] = "R0lGODlhEAAQAKIAAAAAhP//AISEAMDAwP///8bGxoSEhAAAACH5BAEAAAMALAAAAAAQABAAQANQ
OLoq7ssQYqoUIZQTrTlZURUZJ1EWAZZMi2WwOJxTDayaOXkT19I1guBAFLRcMI3x+Ao4YLrJpviB
zoKUQ3OjANYEngh2MiyKxzjfjMhuHxMAOw==";
$_IMAGES["css"] = "R0lGODlhDQAQAMQAAAAAAP///4SGhMbHxroPAKENAIgMAM0cDdEwItREONpYTOOFfOyspvfY1eeX
kfLDwPvq6v///wAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAACH5BAEA
ABEALAAAAAANABAAAAVVoCCOZGQKQaqmg3Cu6xC4KJwCOFDbrG5DDEhg4IMRHAUIcddINBABAmMZ
YCQOi1SjMNQlpCvFoytgHA4MVZqcelwDD0NvF2i05zzVcsDv+4k5gYIAIQA7";
$_IMAGES["directory"] = "R0lGODlhDwANAMIGAP//mczMZgAAAP/MmZmZAP//zP///////yH5BAEAAAcALAAAAAAPAA0AAAM9
eEfMohCSUwoA5MUVug9Ns1RkWQGBQFhX6w7p6rYDUMfsbNv4XP8oVY62gwmJwIFxlSwqY5/o5yGo
Wq/XBAA7";
$_IMAGES["doc"] = "R0lGODlhEAAQAMIBAAAAAP///wAA/8zMzJmZmWZmZv///////yH5BAEAAAcALAAAAAAQABAAAANU
eErF3kXJU4K9loB5CMbVJlWfBZynAKjsug7B4AoBW7uw7Ab7DmuH1Y2mquQ2reRg4JEFk7uL09Yi
LI9PAI/lkSKFraU1AFyUME5F4cpmizqouDwBADs=";
$_IMAGES["exe"] = "R0lGODlhEAAOAMIAAP///5mZmWZmZgAAAMzMzAAAzAAAmf///yH5BAEAAAcALAAAAAAQAA4AAAM8
GKK83oLISWcYgZTN+xbDUhjjCAzneWWC87whAcx0Pa+yrYORrq8Bnw2UEdYuPeOMl1OuXo3oYEqt
WqcJADs=";
$_IMAGES["gif"] = "R0lGODlhEAAQALMAAAAAAL8AAAC/AL+/AMDAwICAgP8AAAD/AAD//////wAAAAAAAAAAAAAAAAAA
AAAAACH5BAEAAAgALAAAAAAQABAAAARcsMhJkb0l6a1JuVbGbUTyIUYgjgngAkYqDgQ9DEBCxAEi
Ei8ALsELaXCHJK5o1AGSh0EBEABgjgABwQMEXp0JgcDl/A6x5WZtPfQ2g6+0j8Vx+7b4/NZqgftd
FxEAOw==";
$_IMAGES["gz"] = "R0lGODlhEAAQAMQAAJzO/2OczgBjnGPO/wCczgAxMTHOzsDAwM7OMf//nP//zv//986cAP/OMf/O
Y//OnP8AAP///wAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAACH5BAEA
AAcALAAAAAAQABAAQAVr4CGOUmkWI6Qkj9O8DSMdEjBDUbSs7TvXsxHJVEKJICxHgWgSAFCQ3crh
8tFsBwhz6zQKRRKBhBAOHyEQmoBAMBgGASN6TkdfbzrFFPbDRqdVDQh9N0kwMTJ3X2psbnBeiyQE
kUJiYmRiByEAOw==";
$_IMAGES["htm"] = "R0lGODlhEAAQALMAAAAA/wAAhDFj/zFjnDGc/zHO/wCEhDH//8DAwDGcAP////f398bGxoSEhAAA
AAAAACH5BAEAAAgALAAAAAAQABAAQARXsMlJJbqoqb1U+FvoZGFnGEK4jdoyvDDcsWqpLIzSXBpn
HIVEQEVzxWIzUmd5ayZ7tRBjx1MxZ44sKWRQHAhD0XYjICQA4dX26rzR2uzFO+4cZe/4/CgCADs=";
$_IMAGES["html"] = $_IMAGES["htm"];
$_IMAGES["jpeg"] = "R0lGODlhEAAQALMAAAAAAL8AAAC/AL+/AAAAv78AvwC/v8DAwICAgP8AAAD/AP//AAAA//8A/wD/
/////yH5BAEAAAoALAAAAAAQABAAAARaEMlJlb3o6a0PulbGbcfzKQwhjg/gAkwqDgdNA88RE4p4
vIABbhfSCBNIIbGYAyATAwSAAMAYAYGD5/ezNhOBgKvpPV7JzJpaiO5pgK/2iiXX2u/aqgXOd10i
ADs=";
$_IMAGES["jpg"] = $_IMAGES["jpeg"];
$_IMAGES["js"] = "R0lGODlhEAAQAOMAAP///wAAAMzMzJmZmWZmZv//AJmZAGZmAP//////////////////////////
/////yH5BAEAAAgALAAAAAAQABAAAARbcJAh6aw1DMB5nZ0QEB0wFAAqcuLGkYdhtAHQepyqrSJp
AoZYYFizaV4oXanXOQVnRaMLmTKyjh5KIGZlAki0FO+4KYySK6NvIBAMAu3ojUMkLkftvH5f7/uH
EQA7";
$_IMAGES["jsp"] = "R0lGODlhEAAQAOMAAP///wAAAMzMzJmZmWZmZv//AJmZAGZmAP//////////////////////////
/////yH5BAEAAAgALAAAAAAQABAAAARbcJAh6aw1DMB5nZ0QEB0wFAAqcuLGkYdhtAHQepyqrSJp
AoZYYFizaV4oXanXOQVnRaMLmTKyjh5KIGZlAki0FO+4KYySK6NvIBAMAu3ojUMkLkftvH5f7/uH
EQA7";
$_IMAGES["mov"] = "R0lGODlhEAAQAKL/AMDAwAD/AACAAP8AAP///8DAwICAgAAAACH5BAEAAAAALAAAAAAQABAAAANS
CArW7isaQispJqppaSGZ1FFHeYijdwgLlxarEAh0LVANLJRBf/Q7geEAO5l+wB8MppD1nrsV8QQQ
DHwBKaHEBBy/le4mpUK9qJuCes1Ge7/wBAA7";
$_IMAGES["mp3"] = "R0lGODlhEAAQAJEAAMDAwP///8bGxgAAACH5BAEAAAAALAAAAAAQABAAQAI5xI45wDwB4XtQLBNz
EPFSnVkOWE3NJx2RiJGrtwnyTMPu0bSghYxu6esEPixKYqgq/oA6V1EBxRUAADs=";
$_IMAGES["mpeg"] = $_IMAGES["avi"];
$_IMAGES["mpeg"] = $_IMAGES["avi"];
$_IMAGES["arrow_down"] = "R0lGODlhBwAGAIABAHh5f////yH+FUNyZWF0ZWQgd2l0aCBUaGUgR0lNUAAh+QQBCgABACwAAAAA
BwAGAAACCowfoMucbhZKpwAAOw==";
$_IMAGES["arrow_up"] = "R0lGODlhBwAGAIABAHh5f////yH+FUNyZWF0ZWQgd2l0aCBUaGUgR0lNUAAh+QQBCgABACwAAAAA
BwAGAAACCoxhCavLDiNLqQAAOw==";
$_IMAGES["pdf"] = "R0lGODlhEAAQALMAAP///+/v7wAAAN4AAMbGxgAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA
AP+A/yH5BAEAAA8ALAAAAAAQABAAQARF8D1Bq5V4hh3G4JswWSQoSkLnfZsXiGQpECfKfSxXp227
vhiBC2QKEnU7AECgZC5fFePtuJvmQlIfsdr7dXa4IxYViz0iADs=";
$_IMAGES["php"] = "R0lGODlhDgAQAOMAAP///wAAAMzMzJmZmWZmZpnMmWaZZjOZM8zMmQBmAMz//5nMzDOZZmbMmWaZ
M////yH5BAEAAA8ALAAAAAAOABAAAARUcJAh6RwvvwG67wKWEd8nAETGlV3gBhtrwiRbgPD6HUsC
CLmPQWAAHArAB6lgOHp8yYGBcfM0TlEEw7HwIHAxgKIp9v1osu85LFsTBPC4PPmq22ERADs=";
$_IMAGES["png"] = "R0lGODlhEAAQALP/AMDAwAD/AACAAICAAP8AAIAAAP///8DAwICAgAAAAAAAAAAAAAAAAAAAAAAA
AAAAACH5BAEAAAAALAAAAAAQABAAAARcEMlJgb3I6K0PulbGbYfxAUQhjkbiJkQqDgc9DIlxxAUg
Hq8EzsALaXCBJK5o1CWSgQEiUUhgjgnBwQMEXp0GgcDl/A6x5WZtPfQ2g6+0j8Vx+7b4/NZqgftd
FxEAOw==";
$_IMAGES["ppt"] = "R0lGODlhEAAQAIQAAP////8AAAAAAMzMzGZmAJmZAGZmZpmZmWaZAMzMmZmZzMyZzJnMmZmZZplm
AGZmmf///////////////////////////////////////////////////////////////yH5BAEA
ABAALAAAAAAQABAAAAVzICQeBmmWhqhCBuC+bikGBR0gNuIeQErAsIBLQBQIA4SAAwlwDJ6AgeBX
AxytMOkVgNMRBoxFVFAA/F5bl9ZaZpufAwBD4EXasa810FVQJOILdDk2SVkCKg9qUXAKAAmHIg17
hogDCQqWfk+XkBANRaChIQA7";
$_IMAGES["rar"] = "R0lGODlhEAAQAIQBAAAAAP///wAAmQAAZszMzJkAAGYAZpkAmf8A/wCZZmYAADMzMwD/ADOZzDMA
mZmZmQAzmTP/AACZ/wAzzP//AJmZM2ZmADOZmQBm////M2ZmZgCZzACZMwBmZgBmAP///yH5BAEA
AB8ALAAAAAAQABAAAAV8YKGI5GiSH6ESxmO8MFwQQX1QSK7rylMHBsJhSCQWfgFAZcHUMJ8FwUAg
AFivWECK8CAMLlKBYxoe0GqdTEPS2LDXDcc5cCFAJhPMHaIXIAEWZVSDA1mGWFsqAxVTjWVyPxwU
DJQRDJaWAz41HgQJn6CgDn8WY4KNh6kfIQA7";
$_IMAGES["sql"] = "R0lGODlhDQAQAMQAAAAAAP///4WS2djc8wAboQAWiAcjsh85uzJJwEdcxVptzZml36225cXN7uvu
+YSGhMbHxv///wAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAACH5BAEA
ABEALAAAAAANABAAAAVV4COOZGQ+Qaqm0HOuKxS4KJwCOFDbrG47DEcA4oMZFgQHcTdIDBABA2MZ
YCQOgtSAMNQlpCtFo/tgHA4MVZqcalwDjUJvFxi05zzVEsLv+4k5gYIAIQA7";
$_IMAGES["unknown"] = "R0lGODlhEAAQALMAAAAAAAAA/wCEAISEhMbGxv8AAP//AP//////////////////////////////
//+A/yH5BAEAAA8ALAAAAAAQABAAAAQ58L1Bq5V4ns03GZnWccQBYsPIASyAqh3hSinszaItv/ax
0z0frqYbBn85GJKoNPaWhKh0imxZr64IADs=";
$_IMAGES["txt"] = "R0lGODlhEAAQAMIAAP///wAAAMzMzJmZmWZmZv///////////yH5BAEAAAcALAAAAAAQABAAAANC
eBrA3ioeNkC9MNbH8yFAKI5CoI0oUJ5N4DCqqYCpuCpV67rhfeS1WIS22/Vkv+CRVeQJZ8pnUukb
CK7YrG/SbEYSADs=";
$_IMAGES["wav"] = "R0lGODlhEAAQALP/AMDAwAAAgAD//wCAgP8AAP///8DAwICAgAAAAAAAAAAAAAAAAAAAAAAAAAAA
AAAAACH5BAEAAAAALAAAAAAQABAAAARYEEhwqrUzn8J7MUcmbR5nFKFWckiLqKuJDBMZG/MgDHw/
cBXcoCUoIorDwQGBe7mOyCMOJ9EVr8MZ8wUYEIwCRABRaFEBz9aYLIPduKNYu2ao2+9wdHofAQA7";
$_IMAGES["wmv"] = $_IMAGES["avi"];
$_IMAGES["xls"] = "R0lGODlhEAAQAOMAAP///8zMzAAAAJmZmQBmAACZAGZmZmaZZplmmZnMmcyZzP//////////////
/////yH5BAEAAA8ALAAAAAAQABAAAARv8MlhqK1G6meA/94gSAVSDN9AoEA3HgTcwbAn3AIBrOW6
BkBAYFQAFAzHUiIkHD10JWVAERw+VUakyRNoFmhQkyGQUAASAoQP6wMNv7FYMS5salg7FaprlXSA
ZEIDXSJ3IId2fkCDgI1ODyI4kpIRADs=";
$_IMAGES["xml"] = "R0lGODlhEAAQAMQAAAAA/wAAnAAAhDFj/zFjnKXO9zGc/zHO/wCEhDH//zGcAMDAwP////f398bG
xoSEhAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAACH5BAEA
AAsALAAAAAAQABAAQAVl4COOpLicy8M0RcMI8NoyUCq7CDLctN0QwGDQVVMxjkhXw8F4nB6FwAqR
OCgErkChuBJ6ib6VWCnmIs9Hh/N5JJMhcG6UgWAkDAKGtiGXDgwKAHl7Zm5jK4WHbomGSjVxkJFx
CyEAOw==";
$_IMAGES["xsl"] = "R0lGODlhEAAQAMQAAAAA/wAAnAAAhDFj/zFjnKXO9zGc/zHO/wCEhDH//8DAwDGcAP//AISEAP//
//f398bGxoSEhAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAACH5BAEA
AAoALAAAAAAQABAAQAV5oBKNZDkqqOg0zeMIsPMUrqTOLoIMMu1ILIYkwmhICEhk7SZruh4QRwQV
KQRkiMRhIXAFCrYGY2xEJJU/BXAoeTyd6ch77oBMqfS3ZG+TWx0IDgkGAg5fD30zVwMGCwCFh2Fi
e3kyQGMREkVtcIgKYmRteTZ8paZ8IQA7";
$_IMAGES["zip"] = "R0lGODlhEAAQAMQAAJzO/2OczgBjnGPO/wCczgAxMTHOzsDAwM7OMf//nP//zv//986cAP/OMf/O
Y//OnP8AAP///wAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAACH5BAEA
AAcALAAAAAAQABAAQAVr4CGOUmkWI6Qkj9O8DSMdEjBDUbSs7TvXsxHJVEKJICxHgWgSAFCQ3crh
8tFsBwhz6zQKRRKBhBAOHyEQmoBAMBgGASN6TkdfbzrFFPbDRqdVDQh9N0kwMTJ3X2psbnBeiyQE
kUJiYmRiByEAOw==";

function cmp_name_desc($a, $b)
{
	return strcasecmp($a->name, $b->name);
}

function cmp_name_asc($b, $a)
{
	return strcasecmp($a->name, $b->name);
}

function cmp_size_desc($a, $b)
{
	return ($b->size - $a->size);
}

function cmp_size_asc($a, $b)
{
	return ($a->size - $b->size);
}

function cmp_mod_desc($a, $b)
{
	return ($a->modTime - $b->modTime);
}

function cmp_mod_asc($b, $a)
{
	return ($a->modTime - $b->modTime);
}

class ImageServer
{
	function showImage()
	{
		global $_IMAGES;
		if(isset($_GET['img']))
		{
			if(strlen($_GET['img']) > 0)
			{
				header('Content-type: image/gif');
				if(isset($_IMAGES[$_GET['img']]))
					print base64_decode($_IMAGES[$_GET['img']]);
				else
					print base64_decode($_IMAGES["unknown"]);
			}
			return true;
		}
		return false;
	}
}


class FileManager
{
	function checkPassword($inputPassword)
	{
		global $_CONFIG;
		global $_ERROR;
		global $_LANG;

		if(strlen($_CONFIG['upload_password']) > 0 && $inputPassword == $_CONFIG['upload_password'])
		{
			return true;
		}
		else
		{
			$_ERROR = $_LANG["wrong_password"];
			return false;
		}
	}

	function newFolder($location, $dirname)
	{
		global $_ERROR;
		global $_LANG;

		if(strlen($dirname) > 0)
		{
			$forbidden = array(".", "/", "\\");
			for($i = 0; $i < count($forbidden); $i++)
				$dirname = str_replace($forbidden[$i], "", $dirname);
			if(!mkdir($location->getDir(true, false, 0).$dirname, 0777))
				$_ERROR = $_LANG["new_dir_failed"];
			else if(!chmod($location->getDir(true, false, 0).$dirname, 0777))
				$error = $_LANG["chmod_dir_failed"];
		}
	}

	function uploadFile($location, $userfile)
	{
		global $_CONFIG;
		global $_ERROR;
		global $_LANG;

		$name = basename($userfile['name']);
		if(get_magic_quotes_gpc())
			$name = stripslashes($name);

		$upload_dir = $location->getFullPath();
		$upload_file = $upload_dir . $name;

		if(!is_uploaded_file($userfile['tmp_name']))
		{
			$_ERROR = $_LANG["failed_upload"];
		}
		else if(!@move_uploaded_file($userfile['tmp_name'], $upload_file))
		{
			$_ERROR = $_LANG["failed_move"];
		}
		else
			chmod($upload_file, 0755);
	}

	
	function run($location)
	{
		if(isset($_POST['password']) && $this->checkPassword($_POST['password']))
		{
			if(isset($_POST['userdir']) && strlen($_POST['userdir']) > 0)
				$this->newFolder($location, $_POST['userdir']);
			if(isset($_FILES['userfile']['name']) && strlen($_FILES['userfile']['name']) > 0)
				$this->uploadFile($location, $_FILES['userfile']);
		}
	}
}


class Dir
{
	var $name;
	var $location;

	
	function Dir($name, $location)
	{
		$this->name = htmlspecialchars($name);
		$this->location = $location;
	}

	function getName()
	{
		return $this->name;
	}

	function getNameEncoded()
	{
		return urlencode($this->name);
	}

	
	function output()
	{
		print("Dir name: ".$this->name."\n");
		print("Dir location: ".$this->location->getDir(true, false, 0)."\n");
	}
}


class File
{
	var $name;
	var $location;
	var $size;
	var $extension;
	var $modTime;

	 
	function File($name, $location)
	{
		$this->name = htmlspecialchars($name);
		$this->location = $location;
		
		$this->extension = $this->findExtension($this->location->getDir(true, false, 0).$this->getName());
		$this->size = $this->findSize($this->location->getDir(true, false, 0).$this->getName());
		$this->modTime = filemtime($this->location->getDir(true, false, 0).$this->getName());
	}

	function getName()
	{
		return $this->name;
	}

	function getNameEncoded()
	{
		return urlencode($this->name);
	}

	function getSize()
	{
		return $this->size;
	}

	function getExtension()
	{
		return $this->extension;
	}

	function getModTime()
	{
		return $this->modTime;
	}

	
	function findSize($file)
	{
		$sizeInBytes = filesize($file);

		
		if (!$sizeInBytes) {
			$sizeInBytes=exec("ls -l '$file' | awk '{print $5}'");
		}
		return $sizeInBytes;
	}

	
	function findExtension($file)
	{
		$chunks = explode(".", $file);
		return $chunks[count($chunks)-1];
	}

	
	function output()
	{
		print("File name: ".$this->getName()."\n");
		print("File location: ".$this->location->getDir(true, false, 0)."\n");
		print("File size: ".$this->size."\n");
		print("File extension: ".$this->extension."\n");
		print("File modTime: ".$this->modTime."\n");
	}
}

class Location
{
	var $path;

	 
	function splitPath($dir)
	{
		$path1 = preg_split("/[\\\\\/]+/", $dir);
		$path2 = array();
		for($i = 0; $i < count($path1); $i++)
		{
			if($path1[$i] == ".." || $path1[$i] == "." || $path1[$i] == "")
				continue;
			$path2[] = $path1[$i];
		}
		return $path2;
	}

	
	function getDir($prefix, $encoded, $up)
	{
		$dir = "";
		if($prefix == true)
			$dir .= "./";
		for($i = 0; $i < ((count($this->path) >= $up && $up > 0)?count($this->path)-$up:count($this->path)); $i++)
		{
			$dir .= ($encoded?rawurlencode($this->path[$i]):$this->path[$i])."/";
		}
		return $dir;
	}

	function getFullPath()
	{
		return ($_CONFIG['basedir']?$_CONFIG['basedir']:dirname($_SERVER['SCRIPT_FILENAME']))."/".$this->getDir(true, false, 0);
	}

	
	function output()
	{
		print_r($this->path);
		print("Dir with prefix: ".$this->getDir(true, false, 0)."\n");
		print("Dir without prefix: ".$this->getDir(false, false, 0)."\n");
		print("Upper dir with prefix: ".$this->getDir(true, false, 1)."\n");
		print("Upper dir without prefix: ".$this->getDir(false, false, 1)."\n");
	}


	 
	function init()
	{
		global $_CONFIG;
		if(!isset($_GET['dir']) || strlen($_GET['dir']) == 0)
		{
			$this->path = $this->splitPath($_CONFIG['starting_dir']);
		}
		else
		{
			$this->path = $this->splitPath($_GET['dir']);
		}
	}
}

class Encode_Explorer
{
	var $location;
	var $dirs;
	var $files;
	var $sort_by;
	var $sort_as;

	
	function init()
	{
		$this->sort_by = "";
		$this->sort_as = "";
		if(isset($_GET["sort_by"]) && isset($_GET["sort_as"]))
		{
			if($_GET["sort_by"] == "name" || $_GET["sort_by"] == "size" || $_GET["sort_by"] == "mod")
				if($_GET["sort_as"] == "asc" || $_GET["sort_as"] == "desc")
				{
					$this->sort_by = $_GET["sort_by"];
					$this->sort_as = $_GET["sort_as"];
				}
		}
		if(strlen($this->sort_by) <= 0 || strlen($this->sort_as) <= 0)
		{
			$this->sort_by = "name";
			$this->sort_as = "desc";
		}

		$this->calculateSpace();
	}

	
	function readDir()
	{
		global $_CONFIG;
		global $_ERROR;
		global $_LANG;
		
		if($open_dir = @opendir($this->location->getFullPath()))
		{
			$this->dirs = array();
			$this->files = array();
			while ($object = readdir($open_dir))
			{
				if($object != "." && $object != "..") 
				{
					if(is_dir($this->location->getDir(true, false, 0)."/".$object))
					{
						if(!in_array($object, $_CONFIG['hidden_dirs']))
							$this->dirs[] = new Dir($object, $this->location);
					}
					else if(!in_array($object, $_CONFIG['hidden_files']))
						$this->files[] = new File($object, $this->location);
				}
			}
			closedir($open_dir);
		}
		else
		{
			$_ERROR = $_LANG['unable_to_read_dir'];
		}
	}

	
	function sum_dir($start_dir, $ignore_files, $levels = 1) 
	{
		if ($dir = opendir($start_dir)) 
		{
			$filesize = 0;
			while ((($file = readdir($dir)) !== false)) 
			{
				if (!in_array($file, $ignore_files)) 
				{
					if ((is_dir($start_dir . '/' . $file)) && ($levels - 1 >= 0)) 
					{
						$filesize += $this->sum_dir($start_dir . '/' . $file, $ignore_files, $levels-1);
					}
					elseif (is_file($start_dir . '/' . $file)) 
					{					
						$filesize += filesize($start_dir . '/' . $file) / 1024;
					}
				}
			}
			
			closedir($dir);
			return $filesize;
		}
	}

	function calculateSpace()
	{
		global $_CONFIG;
		$ignore_files = array('..', '.');
		$start_dir = getcwd();
		$spaceUsed = $this->sum_dir($start_dir, $ignore_files, $_CONFIG['dir_levels']);
		$spaceLeft = $_CONFIG['max_space'] - $spaceUsed;
		$this->spaceUsed = round($spaceUsed/1024, 3);
		$this->spaceLeft = round($spaceLeft/1024, 3);
	}

	function sort()
	{
		@usort($this->files, "cmp_".$this->sort_by."_".$this->sort_as);
		if($this->sort_by == "name" && $this->sort_as == "asc")
			@usort($this->dirs, "cmp_name_asc");
		else
			@usort($this->dirs, "cmp_name_desc");
	}

	function makeArrow($sort_by)
	{
		global $_LANG;
		
		if($this->sort_by == $sort_by && $this->sort_as == "asc")
		{
			$sort_as = "desc";
			$img = "arrow_up";
		}
		else
		{
			$sort_as = "asc";
			$img = "arrow_down";
		}

		if($sort_by == "name")
			$text = $_LANG["file_name"];
		else if($sort_by == "size")
			$text = $_LANG["size"];
		else if($sort_by == "mod")
			$text = $_LANG["last_changed"];

		return "<a href=\"?dir=".$this->location->getDir(false, true, 0)."&amp;sort_by=".$sort_by."&amp;sort_as=".$sort_as."\">
			$text <img style=\"border:0;\" alt=\"".$sort_as."\" src=\"?img=".$img."\" /></a>";
	}

	function makeIcon($l)
	{
		$l = strtolower($l);
		return "?img=".$l;
	}

	function formatModTime($time)
	{
		return date("d.m.y H:i:s", $time);
	}

	function formatSize($size) 
	{
		$sizes = Array('B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB');
		$y = $sizes[0];
		for ($i = 1; (($i < count($sizes)) && ($size >= 1024)); $i++) 
		{
			$size = $size / 1024;
			$y  = $sizes[$i];
		}
		return round($size, 2)." ".$y;
	}

	 
	function output()
	{
		print("!!!!!!!!!");
		print("Explorer location: ".$this->location->getDir(true, false, 0)."\n");
		for($i = 0; $i < count($this->dirs); $i++)
			$this->dirs[$i]->output();
		for($i = 0; $i < count($this->files); $i++)
			$this->files[$i]->output();
	}

	
	function run($location)
	{
		$this->init();
		$this->location = $location;
		$this->readDir();
		$this->sort();
		$this->outputHtml();
	}

	 
	function outputHtml()
	{
		global $_ERROR;
		global $_CONFIG;
		global $_LANG;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php print $_CONFIG['lang']; ?>" lang="<?php print $_CONFIG['lang']; ?>">
<head>
<?php css(); ?>
<meta content="text/html; charset=<?php print $_CONFIG['charset']; ?>" http-equiv="content-type" />
<title>Explorador de Archivos</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
</head>
<body>
<?php 

if($_ERROR)
{
?>
	<div id="error"><?php print $_ERROR; ?></div>
<?php
}
?>
<div id="frame">
<?php
if($_CONFIG['show_top'])
{
?>
<div id="top">
	<div class="text a1">An eye for an eye leaves the whole world blind. (Mohandas Gandhi)</div>
	<div class="text a2">Wisdom will keep you from getting into situations where you need it. (Bruce M. Sandbrook)</div>
	<div class="text a3">Surely it's no coincidence that the word "listen" is an anagram of the word "silent".</div>
	<div class="text a4">Twenty years from now you will be more disappointed by the things you did not do than by the ones you did. (Mark Twain)</div>
	<div class="text a0">Explorador de Archivos</div>
</div>
<?php
}
?>

<table class="table" border="0" cellpadding="3" cellspacing="0">
<tr class="breadcrumbs">
	<td colspan="4">: <a href="?dir="><?php print $_LANG['root']; ?></a>
<?php
	for($i = 0; $i < count($this->location->path); $i++)
	{
?>
		/ <a href="?dir=<?php print $this->location->getDir(false, true, count($this->location->path) - $i - 1); ?>">
			<?php print $this->location->path[$i]; ?>
		</a>
<?php
	}
?>
	</td>
</tr>
<tr class="row one">
	<td class="icon">&nbsp;</td>
	<td class="name"><?php print $this->makeArrow("name");?></td>
	<td class="size"><?php print $this->makeArrow("size"); ?></td>
	<td class="changed"><?php print $this->makeArrow("mod"); ?></td>
</tr>
<tr class="row two">
	<td class="icon"><img alt="dir" src="?img=directory" /></td>
	<td colspan="3" class="long"><a href="?dir=<?php print $this->location->getDir(false, true, 1); ?>">..</a></td>
</tr>
<?php

$row = 1;

if($this->dirs)
{
	foreach ($this->dirs as $dir)
	{
		$row_style = ($row ? "one" : "two");
?>
<tr class="row <?php print $row_style; ?>">
	<td class="icon"><img alt="dir" src="?img=directory" /></td>
	<td colspan="3" class="long"><?php print "<a href=\"?dir=".$this->location->getDir(false, true, 0).$dir->getNameEncoded()."\">".$dir->getName()."</a>"; ?></td>
</tr>
<?php
		$row =! $row;
	}
}


if($this->files)
{
	foreach ($this->files as $file)
	{
		$row_style = ($row ? "one" : "two");
?>
<tr class="row <?php echo $row_style; ?>">
	<td class="icon"><img alt="<?php print $file->getExtension(); ?>" src="<?php print $this->makeIcon($file->getExtension()); ?>" /></td>
	<td class="name">
<?php
		print "\t\t<a href=\"".$this->location->getDir(false, true, 0).$file->getName()."\"";
		if($_CONFIG['open_in_new_window'])
			print "target=\"_blank\"";
		print ">".$file->getName()."</a>";
?>
	</td>
	<td class="size"><?php print $this->formatSize($file->getSize()); ?></td>
	<td class="changed"><?php print $this->formatModTime($file->getModTime());?></td>
</tr>
<?php
	$row =! $row;
	}
}



?>

</table>

</div>

<?php
if(strlen($_CONFIG['upload_password']) > 0)
{
?>

<div id="upload">
	<form enctype="multipart/form-data" action="" method="post">
		<table cellspacing="0" cellpadding="0" border="0" width="100%">
			<tr>
				<td>
					<div class="password">
						<?php print $_LANG["password"]; ?>: <input type="password" name="password" class="text" />
					</div>
					<div class="upload">
						<input name="userdir" type="text" class="text" />
						<input type="submit" value="<?php print $_LANG["make_directory"]; ?>" />
						<input name="userfile" type="file" />
						<input type="submit" value="<?php print $_LANG["upload"]; ?>" />
					</div>
				</td>
			</tr>
		</table>
	</form>
</div>
<br />

<?php
}
?>

	<div class="container text-center" style="padding-top: 50px;">
	<button class="btn btn-danger"><a href="http://test.odontopraxis.com.ar/entidades/entidades-home.php" style="text-decoration: none; color: white; padding-bottom: 50px;">Salir</a></button>
	</div>
<script src="https://code.jquery.com/jquery-3.2.1.js" integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE=" crossorigin="anonymous">
</script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous">
</script>
</body>
</html>

<?php
	}
}


$imageServer = new ImageServer();
if(!$imageServer->showImage())
{
	$_LANG = $_TRANSLATIONS[$_CONFIG['lang']];
	$location = new Location();
	$location->init();
	$fileManager = new FileManager();
	$fileManager->run($location);
	$encodeExplorer = new Encode_Explorer();
	$encodeExplorer->run($location);
}
?>