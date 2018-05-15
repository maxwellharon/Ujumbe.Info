<?php

require_once('config.php');


//ini_set('error_reporting', E_ALL & ~E_NOTICE);
// username and password sent from form
$name = $_POST['username'];
$pass = $_POST['password'];


// To protect MySQL injection (more detail about MySQL injection)
$name = stripslashes($name);
$pass = stripslashes($pass);
$name = mysql_real_escape_string($name);
$pass = mysql_real_escape_string($pass);



$sql ="SELECT * FROM `login2` WHERE `username`= '$name' and `password` = md5('$pass')  ";
		$result = mysql_query($sql,$link);
$count=mysql_num_rows($result);


// If result matched $myusername and $mypassword, table row must be 1 row

if($count==1):

//if($result==$mypassword):
//echo "Login Successful.<br/> <a href= 'index1.html'><center>NEXT</center></a>";
//Register $myusername, $mypassword and redirect to file "login_success.php"
//session_register("uname");
session_start();
$_SESSION['username']=$name;
//session_register("pwd");
header("location:county-login2.php");

else :

echo "Wrong Username or Password. <br/> <a href ='county-login.php'>click here to try again</a>";
endif;
?>


