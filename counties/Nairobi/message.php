<?php
require_once("config.php");
$name=$_POST['name'];
$gender=$_POST['gender'];
$msisdn=$_POST['number'];
$constituency=$_POST['constituency'];
$message=$_POST['message'];
$query="select firstname, gender, msisdn,constituency,message from ujumbe_users join ujumbemessages on ujumbe_users.Id=ujumbemessages.userId where Id=1";
  mysql_query($query);
  echo  mysql_query($query);
?>