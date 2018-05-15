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
 
 echo $msisdn;
 echo $role;
 echo $message_id;
 echo $message;
 echo $const;
 echo $county;
} 
/*$message=$_POST['smsMessage'];
//echo $message;
$sql=get_replies($message);
$queryy=mysql_query($sql);
if(!$queryy)
{
echo "could not execute your last query";
die(mysql_error());
}*/
?>