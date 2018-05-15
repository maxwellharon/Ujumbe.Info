<?php
ini_set('error_reporting', E_ALL & ~E_NOTICE);

$host = "localhost";
$user = "priorit1";
$pass = "43&*ASKN25";
$error='couldnt connect';
$db = "priorit1_ujumbe";

$link = mysql_connect($host,$user,$pass);
mysql_select_db($db,$link);

?>