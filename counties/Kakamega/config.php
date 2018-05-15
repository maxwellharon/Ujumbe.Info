<?php
ini_set('error_reporting', E_ALL & ~E_NOTICE);

$host = "localhost";
$user = "root";
$pass = "";
$error='couldnt connect';
$db = "ujumbe";

$link = mysql_connect($host,$user,$pass);
mysql_select_db($db,$link);

?>