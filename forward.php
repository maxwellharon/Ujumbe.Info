<?php 
session_start();
if(!isset($_SESSION["username"])){
	header("location:login.html");
}

require_once("config.php");
$role=$_SESSION['role'];
if(isset($_POST['submit'])){
require_once("config.php");
	
	  $sender=$_POST['sender'];
	 $receiver=$_POST['receiver'];
	 $subject=$_POST['subject'];
	 $message=$_POST['message'];
	 $body=$_POST['subject1']; 
	  
		 
	 $query3=mysql_query("insert into forwarded_messages(sender,receiver,subject,message,sender_message,dateCreated) values
  ('$sender','$receiver','$subject','$body','$message',NOW())");
 
  if(!query3)
 {
 echo"Query 3 not executed";
 die(mysql_error());
 }
 }
	 ?>
	 
<!DOCTYPE html>
<html>
<body onload="myFunction()">

<?php
$role=$_SESSION['role'];
?> 

<script>
role='<?php echo $role; ?>';

function myFunction() {

			if(role=='governor')
			{
			window.location.assign("http://prioritymobile.co.ke/ujumbe/governor.php");
			}
			else if(role=='senator')
			{
			window.location.assign("http://prioritymobile.co.ke/ujumbe/senator.php");
			}
			else if(role=='deputy president')
			{
			window.location.assign("http://prioritymobile.co.ke/ujumbe/deputy_president.php");
			}
			else if(role=='mp')
			{
			window.location.assign("http://prioritymobile.co.ke/ujumbe/specific-constituency.php");
			}
			else if(role=='commissioner')
			{
			window.location.assign("http://prioritymobile.co.ke/ujumbe/county_commissioner.php");
			}
			else if(role=='commandant')
			{
			window.location.assign("http://prioritymobile.co.ke/ujumbe/county_commandant.php");
			}
			else if(role=='judiciary')
			{
			window.location.assign("http://prioritymobile.co.ke/ujumbe/judiciary.php");
			}
			else if(role=='president')
			{
			window.location.assign("http://prioritymobile.co.ke/ujumbe/president.php");
			}
			else if(role=='women rep')
			{
			window.location.assign("http://prioritymobile.co.ke/ujumbe/women_rep.php");
			}			
			else if(role=='cs internal security')
			{
			window.location.assign("http://prioritymobile.co.ke/ujumbe/internal_cs.php");
			}
			else if(role=='cs health')
			{
			window.location.assign("http://prioritymobile.co.ke/ujumbe/health_cs.php");
			}
			else if(role=='cs education')
			{
			window.location.assign("http://prioritymobile.co.ke/ujumbe/education_cs.php");
			}
			else if(role=='cs devolution')
			{
			window.location.assign("http://prioritymobile.co.ke/ujumbe/devolution_cs.php");
			}
			else
			{
			window.location.assign("http://prioritymobile.co.ke/ujumbe/login.html");
			}
     
}
</script>

</body>
</html>