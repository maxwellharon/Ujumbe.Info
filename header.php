<?php
session_start();
if(!isset($_SESSION["username"])){
	header("location:login.html");
}
ini_set('error_reporting', E_ALL & ~E_NOTICE);
require_once("config.php");
require_once("functions.php");
if(isset($_GET['constituency'])):
$query_mode=2;
$place=$_GET['constituency'];
else:
$query_mode=1;
$place=$_SESSION["username"];
endif;


$role=$_SESSION['role'];


?>
