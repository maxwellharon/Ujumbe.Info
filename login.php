<?php

require_once('config.php');


$name =$_POST['username'];
$pass = $_POST['password'];


// To protect MySQL injection (more detail about MySQL injection)
$name = stripslashes($name);
$pass = stripslashes($pass);
$name = mysql_real_escape_string($name);
$pass = mysql_real_escape_string($pass);



$sql ="SELECT * FROM `login` WHERE `username`= '$name' and `password` = md5('$pass')  ";
$result = mysql_query($sql,$link);
$count=mysql_num_rows($result);
$data=mysql_fetch_array($result);

// If result matched $myusername and $mypassword, table row must be 1 row

if($count==1):
session_start();


$_SESSION['username']=$name;
$_SESSION['role']=$data['role'];

$query=mysql_query("select * from leaders where role='".$_SESSION['role']."' ");
if(!$query)
{
echo("query not working");
die(mysql_error());
}
while($res=mysql_fetch_array($query))
{
$names=$res['name'];
$photo=$res['photo'];
$_SESSION['name']=$names;
$_SESSION['photo']=$photo;
}
header("location:login2.php");

else :

echo "Wrong Username or Password. <br/> <a href ='login.html'>click here to try again</a>";
endif;
?>


