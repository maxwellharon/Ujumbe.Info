<?php

ob_start ();
date_default_timezone_set ( 'Africa/Nairobi' );
error_reporting ( E_ALL );
require_once 'classes/Processor.php';
require_once 'classes/conn.php';
require_once 'classes/AfricasTalkingGateway.php';

$db = new Database ();
$username = "semanami";
$apikey = "777b4a77238980b8e832720bb8802eaf3c4de76570f32b6a112d3c79d3e8c958";
$sessionId = $_REQUEST ['sessionId'] ? $_REQUEST ['sessionId'] : '';
 $msisdn = $_REQUEST ['phoneNumber'] ? $_REQUEST ['phoneNumber'] : '';
 $scode = $_REQUEST ['serviceCode'] ? $_REQUEST ['serviceCode'] : '';
$ussdString = $_REQUEST ['text'] ? $_REQUEST ['text'] : '';
$msisdn = str_replace ( "+", "", $msisdn );
$requestDate = date ( "Y-m-d H:m:s" );
$gateway = new AfricasTalkingGateway ( $username, $apikey );
$regStatus = Processor::getRegistrationStatus ( $db, $msisdn );
$prevInput = Processor::getSessionString ($db,$msisdn );
$input = Processor::getInput ( $ussdString );
$recipients = "+" . $msisdn;

$prevInput = $prevInput . "*" . $input;
$menu = explode ( "*", $prevInput );
$useme = explode ( "*", $prevInput );
$level = count ( $menu );
$from = "+254205134500";
$to = $recipients;





if (! $regStatus) {
	if ($ussdString == "") {
		Processor::clearSessions($db, $msisdn);
    Processor::createSessions ($db, $msisdn, $sessionId, $ussdString);
		
		$response = "CON Welcome to UJUMBE a free messaging platform that connects you with your elected leaders";
		$response.="\r\nPlease start by signing up";
		$response .= "\r\nWhat is your first name?";
		
	} 

	elseif ($level == 2) {
	Processor::clearSessions($db, $msisdn);
     Processor::createSessions ($db, $msisdn, $sessionId, $ussdString);
		
		
		$response = "CON UJUMBE\r\nWhat is your second name?";
		Processor::updateSessions($db,$msisdn,$prevInput);
		
	} elseif ($level == 3) {
	
		$response = "CON UJUMBE\r\nHow old are you? \r\nNote: This service is not allowed for people under the age of 13";
		Processor::updateSessions($db, $msisdn, $prevInput );
		
	} elseif ($level == 4) {
		if (! is_numeric ( $input )) {
			$response = "CON  UJUMBE\r\nInvalid input";
			
			$response .= "Please input a correct age";
			unset ( $useme [3] );
			$in = implode ( "*", $useme );
			Processor::updateSessions ( $db, $msisdn, $in );
		} else if ($input < 12 || $input > 120) {
			$response = "END UJUMBE\r\nYou are not eligible for this service.";
			Processor::updateSessions ( $db, $msisdn, $prevInput );
		} else {
			$response = "CON UJUMBE\r\nPlease select your gender";
			$response .= "\r\n 1. Male";
			$response .= "\r\n 2. Female";
			Processor::updateSessions ( $db, $msisdn, $prevInput );
		}
	} elseif ($level == 5) {
		$gender = "";
		switch ($input) {
			case 1 :
				$menu [4] = "Male";
				break;
			case 2 :
				$menu [4] = "Female";
				break;
		}
		Processor::updateSessions ( $db, $msisdn, $prevInput );
		if ($input <= 0 || $input > 2) {
			$response = "CON Invalid Option. Please choose";
			$response .= "\r\n 1. Male";
			$response .= "\r\n 2. Female";
			unset ( $useme [4] );
			$in = implode ( "*", $useme );
			Processor::updateSessions ( $db, $msisdn, $in );
		} else {
			$response = "CON UJUMBE\r\nWhat is your constituency number?";
		}
	} 

	elseif ($level == 6) {
		$fname = $menu [1];
		$lname = $menu [2];
		$age = $menu [3];
		$gender = $menu [4];
		$phone = $msisdn;
		$county = $menu [5];
		
		if (Processor::registerUser ( $db, $fname, $lname, $gender, $age, $county, $phone )) {
			$response = "END UJUMBE\r\nRegistration Successful! Thank you.To start interacting with your leaders dial *384*4567#";
			
			Processor::clearSessions ( $db, $msisdn );
			
		} else {
			
			$response = "END UJUMBE\r\nThere was an error in the registration. Please try again";
		}
	}
	
	
	
}

	else
	{
	if($ussdString=="")
	{
	Processor::clearSessions($db, $msisdn);
    Processor::createSessions ($db, $msisdn, $sessionId, $ussdString);
    $response= "CON Welcome to Ujumbe, Karibu kwa huduma ya Ujumbe\r\n Choose a language, Chagua lugha  \r\n 1. English \r\n 2. Kiswahili";
    }
 
	
 elseif (substr($ussdString, 0, 1) == "2")
 {   

    if ($ussdString == "2") {
        Processor::clearSessions($db, $msisdn);
        Processor::createSessions ($db, $msisdn, $sessionId, $ussdString);

       
    } 
	
	
	if($level==2){
		$res=$db->Select("SELECT representative from representatives");
			$response="CON Ungependaa kumtumia nani ujumbe leo? \r\n 1.".$res[0]['representative']." \r\n 2.".$res[1]['representative']. "\r\n 3.".$res[2]['representative']." \r\n 4.".$res[3]['representative']. "\r\n 5.".$res[4]['representative']." \r\n 6.".$res[5]['representative']." \r\n 7.".$res[6]['representative']." \r\n 8.".$res[7]['representative']." \r\n 9.".$res[8]['representative'];
			
			Processor::updateSessions($db,$msisdn,$prevInput);
			
	}
	
	if($level==3)
	{
		
		if($input<=0 || $input>9){
			$res=$db->Select("SELECT representative from representatives");
			$response="CON Chagua kati ya 1 na 9 \r\n 1.".$res[0]['representative']." \r\n 2.".$res[1]['representative']. "\r\n 3.".$res[2]['representative']." \r\n 4.".$res[3]['representative']. "\r\n 5.".$res[4]['representative']." \r\n 6.".$res[5]['representative']." \r\n 7.".$res[6]['representative']." \r\n 8.".$res[7]['representative']." \r\n 9.".$res[8]['representative'];
			unset($menu[2]);
			$in=implode("*",$menu);
		Processor::updateSessions($db, $msisdn, $in);
			
		}
		else
	{
	
	if($input >0 && $input<10 )
	{
	
	
	$repId=$input;
	
	
	$res=$db->Select("SELECT issue from issue");
	$response="CON \r\n Chagua jambo la kuzingatia \r\n 1.".$res[0]['issue']."\r\n 2.".$res[1]['issue']."\r\n 3.".$res[2]['issue']."\r\n 4.".$res[3]['issue']."\r\n 5.".$res[4]['issue']."\r\n 6.".$res[5]['issue']."\r";
	
	Processor::addRecord($db,$msisdn,$sessionId,$repId);
	
	$n=Processor::getPrevString($prevInput);
	Processor::updateSessions($db,$msisdn,$prevInput);
	
	
	
	/*
if($repId==1)//president
{
	$repName="Uhuru Kenyatta";
}
else if($repId==2)//deputy president
{
	$repName="William Ruto";
}

else if($repId==3)//Governor
{
	$query=$db->Select("select constituency from ujumbe_users where msisdn= '$msisdn' ");	
	$constituency=$query[0]['constituency'];
	
	$query2=$db->Select("select cont_id from constituency where const_id='$constituency' ");	
	$county=$query2[0]['cont_id'];
	
	$query3=$db->Select("select honorable_governor from county where id='$county' ");
	
	$mheshimiwa=$query3[0]['honorable_governor'];
	
	
		
}

else if($repId==4)//senator
{
	$query=$db->Select("select constituency from ujumbe_users where msisdn= '$msisdn' ");	
	$constituency=$query[0]['constituency'];
	
	
	$query2=$db->Select("select cont_id from constituency where const_id='$constituency' ");	
	$county=$query2[0]['cont_id'];
	
	$query3=$db->Select("select honorable_senator from county where id='$county' ");
	
	$mheshimiwa=$query3[0]['honorable_senator'];
	
	
}
else if($repId==5)//mp
{
	$query=$db->Select("select constituency from ujumbe_users where msisdn= '$msisdn' ");	
	$constituency=$query[0]['constituency'];
	
	$query3=$db->Select("select honourable from constituency where const_id='$constituency' ");
	
	$mheshimiwa=$query3[0]['honourable'];
	
}
else //county women rep
{
	$query=$db->Select("select constituency from ujumbe_users where msisdn= '$msisdn' ");	
	$constituency=$query[0]['constituency'];
	
	$query2=$db->Select("select cont_id from constituency where const_id='$constituency' ");	
	$county=$query2[0]['cont_id'];
	
	$query3=$db->Select("select women_rep from county where id='$county' ");
	
	$mheshimiwa=$query3[0]['women_rep'];
}*/

		
	
	
	}
	
	} 
	}
	
	
	if($level == 4)
	{
	if($input <=0 || $input >6)
	{
	$res=$db->Select("SELECT issue from issue");
	$response="CON \r\n Tafadhali chagua  kati ya 1 na 6\n 1".$res[0]['issue']."\r\n 2.".$res[1]['issue']."\r\n 3.".$res[2]['issue']."\r\n 4.".$res[3]['issue']."\r\n 5.".$res[4]['issue']."\r\n 6.".$res[5]['issue']."\r" ;
		
	unset($menu[3]);
	$in=implode("*",$menu);
	Processor::updateSessions($db,$msisdn,$in);
	}
	
	else
	{
		$issueId=$input;
		
		$response="CON Andika ujumbe mfupi";
		$message=$response;
	
	Processor::updateIssue($db,$issueId,$sessionId);
	
	
	$n=Processor::getPrevString($prevInput);
	Processor::updateSessions($db,$msisdn,$prevInput);
	
	}
	
	}
	elseif($level ==5)
	{
		if(empty($input))
		{
			$response="CON \r\n Ujumbe wako hauna maneno .";
				
	unset($menu[4]);
	$in=implode("*",$menu);
	Processor::updateSessions($db,$msisdn,$in);
			
		}
		else
		{
			
		$message=$input;
		Processor::updateMessage($db,$message,$sessionId);
		$n=Processor::getPrevString($prevInput);
	Processor::updateSessions($db,$msisdn,$prevInput);
		
		$response="END  Asante kwa kutumia huduma ya UJUMBE mheshimiwa atakujibu punde atakapopata wakati.";
		}
		
		Processor::clearSessions($db, $msisdn);
	}
		
	}
	
elseif(substr($ussdString,0,1)=="1") 
{
	if ($ussdString=="1")
	{
	 Processor::clearSessions($db, $msisdn);
     Processor::createSessions ($db, $msisdn, $sessionId, $ussdString);
	}
	
	 
	
	
	if($level==2){
		$res=$db->Select("SELECT representative from representatives");
			$response="CON  Who would you like to reach today? \r\n 1.".$res[0]['representative']." \r\n 2.".$res[1]['representative']. "\r\n 3.".$res[2]['representative']." \r\n 4.".$res[3]['representative']. "\r\n 5.".$res[4]['representative']." \r\n 6.".$res[5]['representative']." \r\n 7.".$res[6]['representative']." \r\n 8.".$res[7]['representative']." \r\n 9.".$res[8]['representative'];
			
			Processor::updateSessions($db, $msisdn, $prevInput);
	}
	if($level==3)
	{
		//send sms or do smthng
		if($input<=0 || $input>9){
			$res=$db->Select("SELECT representative from representatives");
			$response="CON Please select between 1 and 9 \r\n 1.".$res[0]['representative']." \r\n 2.".$res[1]['representative']. "\r\n 3.".$res[2]['representative']." \r\n 4.".$res[3]['representative']. "\r\n 5.".$res[4]['representative']." \r\n 6.".$res[5]['representative']." \r\n 7.".$res[6]['representative']." \r\n 8.".$res[7]['representative']." \r\n 9.".$res[8]['representative'];
			unset($menu[2]);
			$in=implode("*",$menu);
		Processor::updateSessions($db, $msisdn, $in);
			
		}
		else
	{
	if($input >0 && $input<10 )
	{
	$repId=$input;
	
	$res=$db->Select("SELECT issue from issue");
	$response="CON \r\n What issue who you like the representative to know about \r\n 1.".$res[0]['issue']."\r\n 2.".$res[1]['issue']."\r\n 3.".$res[2]['issue']."\r\n 4.".$res[3]['issue']."\r\n 5.".$res[4]['issue']."\r\n 6.".$res[5]['issue']."\r";
	
	Processor::addRecord($db,$msisdn,$sessionId,$repId);
	
	$n=Processor::getPrevString($prevInput);
	Processor::updateSessions($db,$msisdn,$prevInput);
	/*
	if($repId==1)//president
{
	$repName="Uhuru Kenyatta";
}
else if($repId==2)//deputy president
{
	$repName="William Ruto";
}

else if($repId==3)//Governor
{
	$query=$db->Select("select constituency from ujumbe_users where msisdn= '$msisdn' ");	
	$constituency=$query[0]['constituency'];
	
	$query2=$db->Select("select cont_id from constituency where const_id='$constituency' ");	
	$county=$query2[0]['cont_id'];
	
	$query3=$db->Select("select honorable_governor from county where id='$county' ");
	
	$mheshimiwa=$query3[0]['honorable_governor'];
	
	$_SESSION['mhesh']=$mheshimiwa;
		
}

else if($repId==4)//senator
{
	$query=$db->Select("select constituency from ujumbe_users where msisdn= '$msisdn' ");	
	$constituency=$query[0]['constituency'];
	
	
	$query2=$db->Select("select cont_id from constituency where const_id='$constituency' ");	
	$county=$query2[0]['cont_id'];
	
	$query3=$db->Select("select honorable_senator from county where id='$county' ");
	
	$mheshimiwa=$query3[0]['honorable_senator'];
	
	
}
else if($repId==5)//mp
{
	$query=$db->Select("select constituency from ujumbe_users where msisdn= '$msisdn' ");	
	$constituency=$query[0]['constituency'];
	
	$query3=$db->Select("select honourable from constituency where const_id='$constituency' ");
	
	$mheshimiwa=$query3[0]['honourable'];
	
}
else //county women rep
{
	$query=$db->Select("select constituency from ujumbe_users where msisdn= '$msisdn' ");	
	$constituency=$query[0]['constituency'];
	
	$query2=$db->Select("select cont_id from constituency where const_id='$constituency' ");	
	$county=$query2[0]['cont_id'];
	
	$query3=$db->Select("select women_rep from county where id='$county' ");
	
	$mheshimiwa=$query3[0]['women_rep'];
}*/
		
	}
	
	}
	
	} 
	
	if($level == 4)
	{
		
	if($input <=0 || $input >6)
	{
	$res=$db->Select("SELECT issue from issue");
	$response="CON \r\n Please choose \n 1".$res[0]['issue']."\r\n 2.".$res[1]['issue']."\r\n 3.".$res[2]['issue']."\r\n 4.".$res[3]['issue']."\r\n 5.".$res[4]['issue']."\r\n 6.".$res[5]['issue']."\r";
		
	unset($menu[3]);
	$in=implode("*",$menu);
	Processor::updateSessions($db,$msisdn,$in);
	}
	else
	{		
		$issueId=$input;
		
		$response="CON Type in your message";
		
		Processor::updateIssue($db,$issueId,$sessionId);
	$n=Processor::getPrevString($prevInput);
	Processor::updateSessions($db,$msisdn,$prevInput);
	
	}
	
	}
	elseif($level ==5)
	{
		if(empty($input))
		{
			$response="CON \r\n Your message is empty.Please type in your message";
				
	unset($menu[4]);
	$in=implode("*",$menu);
	Processor::updateSessions($db,$msisdn,$in);
			
		}
		else
		{
			
		$message=$input;
	Processor::updateMessage($db,$message,$sessionId);
	$n=Processor::getPrevString($prevInput);
	Processor::updateSessions($db,$msisdn,$prevInput);
		$response="END Thank you for using UJUMBE.";
		}
		Processor::clearSessions($db, $msisdn);
	}
		
	}
	   else 
{
	if($ussdString!="1" || $ussdString!="2")
	{
	$response= "END INVALID OPTION Please choose either 1. For English or 2. For Kiswahili";
	}
	

}
	

}

header('Content-type: text/plain');
echo $response." ";
$responseDate = date ( "Y-m-d H:m:s" );
Processor::ussdLogs ( $db, $msisdn, $sessionId, $scode, $ussdString, $response, $requestDate, $responseDate );


function validateDate($date) {
    $d = DateTime::createFromFormat('Y-m-d', $date);
    return $d && $d->format('Y-m-d') == $date;
}


?>