<?php
session_start();
if(!isset($_SESSION["username"])){
	header("location:login.html");
}
// Be sure to include the file you've just downloaded
//include("header.php");
require_once("config.php");
$role=$_SESSION['role'];
//echo $role;

 if(isset($_POST['submit'])){
require_once("config.php");
//$message="";
$message=$_POST['smsMessage'];
$id=$_POST['id'];
$query1=mysql_query("select ujumbemessages.id,ujumbemessages.msisdn,constituency.const_id from ujumbe_users join ujumbemessages on ujumbe_users.msisdn=ujumbemessages.msisdn join constituency on constituency.const_id=ujumbe_users.constituency  
  where ujumbemessages.id='$id' ");

if(!$query1)
{
echo "Query 1 not executed";
die(mysql_error());
}
 
 while($result1=mysql_fetch_array($query1))
 {
 $message_id=$result1['id'];
 $msisdn=$result1['msisdn'];
 $const=$result1['const_id'];

 
 $other_query=mysql_query("select county.id,constituency.cont_id from constituency join county on county.id=constituency.cont_id where constituency.const_id='$const'");
 if(!$other_query)
 {
 echo "could not execute other query";
 die(mysql_error());
 }
 while($other_result=mysql_fetch_array($other_query))
 {
 $county=$other_result['id'];
 }
 
 
 
 if($role=="mp")
 {
 $query2=mysql_query("select Constituency,honourable from constituency where Constituency='$const' ");
 if(!query2)
 {
 echo"Query 2 role=mp not executed";
 die(mysql_error());
 }
 while($result2=mysql_fetch_array($query2))
 {
 //$constituency=$result2['Constituency'];
 $mheshimiwa=$result2['honourable'];
 }
 $title=$role;
 
 
 $query3=mysql_query("insert into ujumbe_replies(repName,repTitle,repMessage,dateReplied,citizenMsisdn,citizenMessageId) values
  ('$mheshimiwa','$title','$message',NOW(),'$msisdn','$message_id')");
 
  if(!query3)
 {
 echo"Query 3 role=mp not executed";
 die(mysql_error());
 }
  
}
 
 
 elseif($role=="governor")
 {
 $query2=mysql_query("select honorable_governor from county where id='$county' ");
 if(!query2)
 {
 echo"Query 2 role=governor not executed";
 die(mysql_error());
 }
 while($result2=mysql_fetch_array($query2))
 {
 //$county=$result2['county'];
 $mheshimiwa=$result2['honorable_governor'];
 }
 $title=$role;
 
 $query3=mysql_query("insert into ujumbe_replies(repName,repTitle,repMessage,dateReplied,citizenMsisdn,citizenMessageId) values
  ('$mheshimiwa','$title','$message',NOW(),'$msisdn','$message_id')");
 
  if(!query3)
 {
 echo"Query 3 role=governor not executed";
 die(mysql_error());
 }
 
 }
 
 elseif($role=="senator")
 {
 $query2=mysql_query("select honorable_senator from county where id='$county' ");
 if(!query2)
 {
 echo"Query 2 role=senator not executed";
 die(mysql_error());
 }
 while($result2=mysql_fetch_array($query2))
 {
 //$county=$result2['county'];
 $mheshimiwa=$result2['honorable_senator'];
 }
 $title=$role;
 
 $query3=mysql_query("insert into ujumbe_replies(repName,repTitle,repMessage,dateReplied,citizenMsisdn,citizenMessageId) values
  ('$mheshimiwa','$title','$message',NOW(),'$msisdn','$message_id')");
  
  if(!query3)
 {
 echo"Query 3 role=senator not executed";
 die(mysql_error());
 }
 
 }
 
 elseif($role=="women rep")
 {
 $query2=mysql_query("select women_rep from county where id='$county' ");
 if(!query2)
 {
 echo"Query 2 role=women rep not executed";
 die(mysql_error());
 }
 while($result2=mysql_fetch_array($query2))
 {
 //$county=$result2['county'];
 $mheshimiwa=$result2['women_rep'];
 }
 $title=$role;
 
 $query3=mysql_query("insert into ujumbe_replies(repName,repTitle,repMessage,dateReplied,citizenMsisdn,citizenMessageId) values
  ('$mheshimiwa','$title','$message',NOW(),'$msisdn','$message_id')");
  
  if(!query3)
 {
 echo"Query 3 role=women rep not executed";
 die(mysql_error());
 }
 
 }
 
 elseif($role=="commandant")
 {
 $query2=mysql_query("select county_commandant from county where id='$county' ");
 if(!query2)
 {
 echo"Query 2 role=commandant not executed";
 die(mysql_error());
 }
 while($result2=mysql_fetch_array($query2))
 {
 //$county=$result2['county'];
 $mheshimiwa=$result2['county_commandant'];
 }
 $title=$role;
 
 $query3=mysql_query("insert into ujumbe_replies(repName,repTitle,repMessage,dateReplied,citizenMsisdn,citizenMessageId) values
  ('$mheshimiwa','$title','$message',NOW(),'$msisdn','$message_id')");
  
  if(!query3)
 {
 echo"Query 3 role=commandant not executed";
 die(mysql_error());
 }
 
 }
 
 elseif($role=="commissioner")
 {
 $query2=mysql_query("select county_commissioner from county where id='$county' ");
 if(!query2)
 {
 echo"Query 2 role=commissioner not executed";
 die(mysql_error());
 }
 while($result2=mysql_fetch_array($query2))
 {
 //$county=$result2['county'];
 $mheshimiwa=$result2['county_commissioner'];
 }
 $title=$role;
 
 $query3=mysql_query("insert into ujumbe_replies(repName,repTitle,repMessage,dateReplied,citizenMsisdn,citizenMessageId) values
  ('$mheshimiwa','$title','$message',NOW(),'$msisdn','$message_id')");
  
  if(!query3)
 {
 echo"Query 3 role=commissioner not executed";
 die(mysql_error());
 }
 
 }
 
 
 }
 
 
}
//header("location:governor.php"); 
?>	

<?php
// Be sure to include the file you've just downloaded
//include("header.php");
require_once("config.php");
//require_once("functions.php");
require_once 'classes/AfricasTalkingGateway.php';

$username = "semanami";
$apikey = "777b4a77238980b8e832720bb8802eaf3c4de76570f32b6a112d3c79d3e8c958";


    $recipients = "+" . $msisdn;
    
    
    // Create a new instance of our awesome gateway class
$gateway    = new AfricasTalkingGateway($username, $apikey);
// Any gateway error will be captured by our custom Exception class below, 
// so wrap the call in a try-catch block
try 
{ 
  // Thats it, hit send and we'll take care of the rest. 
  $results = $gateway->sendMessage($recipients, $message);
            
  
}
catch ( AfricasTalkingGatewayException $e )
{
  echo "Encountered an error while sending: ".$e->getMessage();
}

    

// Specify the numbers that you want to send to in a comma-separated list
// Please ensure you include the country code (+254 for Kenya in this case)
$recipients =$_REQUEST['phoneNumber'];

// And of course we want our recipients to know what we really do
$message    = $_REQUEST['smsMessage'];

// Create a new instance of our awesome gateway class
$gateway    = new AfricasTalkingGateway($username, $apikey);

// Any gateway errors will be captured by our custom Exception class below, 
// so wrap the call in a try-catch block
try 
{ 
  // Thats it, hit send and we'll take care of the rest. 
  $results = $gateway->sendMessage($recipients, $message);
  foreach($results as $result) {
    // Note that only the Status "Success" means the message was sent
    echo " Number: " .$result->number;
    echo " Status: " .$result->status;
    echo " MessageId: " .$result->messageId;
    echo " Cost: "   .$result->cost."\n";
    
  }
}
catch ( AfricasTalkingGatewayException $e )
{
  echo "Encountered an error while sending: ".$e->getMessage();
}



// DONE!!! ?>
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
    


