<?php
require_once("config.php");
// Establishing Connection with Server by passing server_name, user_id and password as a parameter
//$connection = mysql_connect("localhost", "root", "");
// Selecting Database
//$db = mysql_select_db("company", $connection);
session_start();// Starting Session
// Storing Session
$user_check=$_SESSION['login_user'];
// SQL Query To Fetch Complete Information Of User
$ses_sql=mysql_query("select msisdn from ujumbe_users where msisdn='$user_check'");
$row = mysql_fetch_assoc($ses_sql);
$login_session =$row['msisdn'];
if(!isset($login_session)){
//mysql_close($connection); // Closing Connection
header('Location: county-dashboard.php'); // Redirecting To Home Page
}
?>