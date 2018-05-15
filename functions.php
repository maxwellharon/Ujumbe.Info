<?php include("header.php");

function forwardedMessages($role)
{
require_once("config.php");	

$role=$_SESSION['role'];

if($role=='mp')
{
$query1=mysql_query("select honourable from constituency where Constituency='".$_SESSION['username']."'");
while($res1=mysql_fetch_array($query1))
{
$mp=$res1['honourable'];

$query2=mysql_query("select * from forwarded_messages where receiver='$mp'");
}
return $query2;
}
elseif($role=='governor' || $role=='senator' || $role=='women rep' || $role=='commissioner' || $role=='commandant')
{
$query3=mysql_query("select * from county where county='".$_SESSION['username']."'");
while($res2=mysql_fetch_array($query3))
{
$governor=$res2['honorable_governor'];
$senator=$res2['honorable_senator'];
$womenrep=$res2['women_rep'];
$commissioner=$res2['county_commissioner'];
$commandant=$res2['county_commandant'];

$query4=mysql_query("select * from forwarded_messages where receiver='$governor' OR receiver='$senator' OR 
receiver='$womenrep' OR receiver='$commissioner' OR receiver='$commandant'");
}
}
return $query4;
}

function countForwarded($role)
{
require_once("config.php");	

$role=$_SESSION['role'];

if($role=='mp')
{
$query1=mysql_query("select honourable from constituency where Constituency='".$_SESSION['username']."'");
while($res1=mysql_fetch_array($query1))
{
$mp=$res1['honourable'];

$query2=mysql_query("select count(*) as total from forwarded_messages where receiver='$mp'");
$data=mysql_fetch_assoc($query2);
$total=$data['total'];
}
return $total;
}
elseif($role=='women rep')
{
$query3=mysql_query("select * from county where county='".$_SESSION['username']."'");
while($res2=mysql_fetch_array($query3))
{

$womenrep=$res2['women_rep'];


$query4=mysql_query("select count(*) as total from forwarded_messages where receiver='$womenrep'");
$data=mysql_fetch_assoc($query4);
$total=$data['total'];
}
return $total;
}

elseif($role=='governor')
{
$query3=mysql_query("select * from county where county='".$_SESSION['username']."'");
while($res2=mysql_fetch_array($query3))
{
$governor=$res2['honorable_governor'];


$query4=mysql_query("select count(*) as total from forwarded_messages where receiver='$governor'");
$data=mysql_fetch_assoc($query4);
$total=$data['total'];
}
return $total;
}

elseif($role=='senator')
{
$query3=mysql_query("select * from county where county='".$_SESSION['username']."'");
while($res2=mysql_fetch_array($query3))
{

$senator=$res2['honorable_senator'];


$query4=mysql_query("select count(*) as total from forwarded_messages where receiver='$senator'");
$data=mysql_fetch_assoc($query4);
$total=$data['total'];
}
return $total;
}

elseif($role=='commandant')
{
$query3=mysql_query("select * from county where county='".$_SESSION['username']."'");
while($res2=mysql_fetch_array($query3))
{

$commandant=$res2['county_commandant'];

$query4=mysql_query("select count(*) as total from forwarded_messages where receiver='$commandant'");
$data=mysql_fetch_assoc($query4);
$total=$data['total'];
}
return $total;
}

elseif($role=='commissioner')
{
$query3=mysql_query("select * from county where county='".$_SESSION['username']."'");
while($res2=mysql_fetch_array($query3))
{

$commissioner=$res2['county_commissioner'];


$query4=mysql_query("select count(*) as total from forwarded_messages where receiver='$commissioner'");
$data=mysql_fetch_assoc($query4);
$total=$data['total'];
}
return $total;
}


}


function all_messages($place){
	require_once("config.php");
	
	
$place=$_SESSION['username'];
$role=$_SESSION['role'];


	$all_messages=0;
	$per_issue=array();						
	$issues=mysql_query("SELECT * FROM issue");
	
		 while($issue=mysql_fetch_array($issues)):
		  if($role=="mp"){
		  $result=mysql_query("SELECT count(*) as total from ujumbemessages join ujumbe_users on ujumbe_users.msisdn= ujumbemessages.msisdn join issue on ujumbemessages.issueId=issue.id join constituency on ujumbe_users.constituency=constituency.const_Id where constituency.constituency='$place' and issue.id='".$issue['id']."'and ujumbemessages.message<>''" );
          $data=mysql_fetch_assoc($result);
          
          $per_issue[$issue['issue']]=$data['total'];
		  $all_messages=$all_messages+$data['total'];
		  }
		   elseif($role=="governor"||$role=="senator" ||$role=="women rep" ||$role=="commissioner" ||$role=="commandant"){
		   
		        $result=mysql_query("SELECT count(*) as total from ujumbemessages join ujumbe_users on ujumbe_users.msisdn= ujumbemessages.msisdn join issue on ujumbemessages.issueId=issue.id join constituency on ujumbe_users.constituency=constituency.const_Id join county on constituency.cont_Id=county.id where county.county='".$_SESSION['username']."' and issue.id='".$issue['id']."'and ujumbemessages.message<>''" );
              $data=mysql_fetch_assoc($result);
          
             $per_issue[$issue['issue']]=$data['total'];
		     $all_messages=$all_messages+$data['total'];
	         }
		  elseif($role=="president"||$role=="deputy president" ||$role=="judiciary" || $role=="cs internal security" || $role=="cs health" || $role=="cs education" || $role="cs devolution"){
		   
		        $result=mysql_query("SELECT count(*) as total from ujumbemessages join ujumbe_users on ujumbe_users.msisdn= ujumbemessages.msisdn join issue on ujumbemessages.issueId=issue.id where issue.id='".$issue['id']."'and ujumbemessages.message<>''" );
              $data=mysql_fetch_assoc($result);
          
             $per_issue[$issue['issue']]=$data['total'];
		     $all_messages=$all_messages+$data['total'];
	         }
		  
		  
		  
		  endwhile;	

       $largest=max($per_issue);
	  //$percentage= ($largest/$all_messages)*100;
	   //return round($percentage,2);
	   
	   return $all_messages;
	   
	  
	
}
function most_pressing_issue_name($place){
	require_once("config.php");
	
$place=$_SESSION['username'];	
$role=$_SESSION['role'];

	$all_messages=0;
	$per_issue=array();						
	$issues=mysql_query("SELECT * FROM issue");
	
		 while($issue=mysql_fetch_array($issues)):
		 if($role=="mp"){
		  $result=mysql_query("SELECT count(*) as total from ujumbemessages join ujumbe_users on ujumbe_users.msisdn= ujumbemessages.msisdn join issue on ujumbemessages.issueId=issue.id join constituency on ujumbe_users.constituency=constituency.const_Id where constituency.constituency='$place' and issue.id='".$issue['id']."'and ujumbemessages.message<>''" );
          $data=mysql_fetch_assoc($result);
          
          $per_issue[$issue['issue']]=$data['total'];
		  $all_messages=$all_messages+$data['total'];
		 }
		  elseif($role=="governor"||$role=="senator" ||$role=="women rep" ||$role=="commissioner" ||$role=="commandant"){
		  $result=mysql_query("SELECT count(*) as total from ujumbemessages join ujumbe_users on ujumbe_users.msisdn= ujumbemessages.msisdn join issue on ujumbemessages.issueId=issue.id join constituency on ujumbe_users.constituency=constituency.const_Id join county on constituency.cont_Id=county.id where county.county='".$_SESSION['username']."' and issue.id='".$issue['id']."'and ujumbemessages.message<>''" );
          $data=mysql_fetch_assoc($result);
          
          $per_issue[$issue['issue']]=$data['total'];
		  $all_messages=$all_messages+$data['total'];
		  }
		  
		  elseif($role=="president"||$role=="deputy president" ||$role=="judiciary" || $role=="cs internal security" || $role=="cs health" || $role=="cs education" || $role="cs devolution"){
		  $result=mysql_query("SELECT count(*) as total from ujumbemessages join ujumbe_users on ujumbe_users.msisdn= ujumbemessages.msisdn join issue on ujumbemessages.issueId=issue.id  where issue.id='".$issue['id']."'and ujumbemessages.message<>''" );
          $data=mysql_fetch_assoc($result);
          
          $per_issue[$issue['issue']]=$data['total'];
		  $all_messages=$all_messages+$data['total'];
		  }
		  endwhile;	

       arsort($per_issue);
       reset($per_issue);
       //return key($per_issue);
	   return $per_issue;
}


function majority_gender_value($place){
	require_once("config.php");
	
	$all_users=0;
	$per_gender=array();						
	$gender=mysql_query("SELECT * FROM gender");
	
		 while($gend=mysql_fetch_array($gender)):
		 
		  $result=mysql_query("SELECT count(*) as total from ujumbe_users join gender on ujumbe_users.gender=gender.id  join constituency on ujumbe_users.constituency=constituency.const_Id where constituency.constituency='$place' and gender.id='".$gend['id']."'" );
          $data=mysql_fetch_assoc($result);
          
          $per_gender[$gend['gender']]=$data['total'];
		  $all_users=$all_users+$data['total'];
		  
		  endwhile;	

       $largest=max($per_gender);	  
	   $percentage= ($largest/$all_users)*100;
	   return round($percentage,2);
	
}
function majority_gender_name($place){
	require_once("config.php");
	
	$all_users=0;
	$per_gender=array();						
	$gender=mysql_query("SELECT * FROM gender");
	
		 while($gend=mysql_fetch_array($gender)):
		 
		  $result=mysql_query("SELECT count(*) as total from ujumbe_users join gender on ujumbe_users.gender=gender.id  join constituency on ujumbe_users.constituency=constituency.const_Id where constituency.constituency='$place' and gender.id='".$gend['id']."'" );
          $data=mysql_fetch_assoc($result);
          
          $per_gender[$gend['gender']]=$data['total'];
		  $all_users=$all_users+$data['total'];
		  
		  endwhile;

       arsort($per_gender);
       reset($per_gender);
       return key($per_gender);
	
}

function youth($place){
	require_once("config.php");
	
	$all_users=0;
	$youth=0;						
	$users=mysql_query("SELECT * from ujumbe_users  join constituency on ujumbe_users.constituency=constituency.const_Id where constituency.constituency='$place'" );
	
		 while($user=mysql_fetch_array($users)):		  
		  $all_users=$all_users+1;
		  if($user['age']>17 && $user['age']<36):
		  $youth=$youth+1;
		  endif;
		  endwhile;	
	  
	   $percentage= ($youth/$all_users)*100;
	   return $percentage;
	
}

function query_switch($issue,$place,$query_mode,$role){
	require_once("config.php");
	
	if($role=="mp"){
	if($query_mode==2){
			
			if($issue!="none"):      
			$query="select ujumbe_users.firstname,ujumbe_users.secondName, ujumbe_users.gender,ujumbe_users.age, ujumbemessages.msisdn,constituency.constituency,issue,ujumbemessages.issueId,ujumbemessages.id,  ujumbemessages.dateCreated from issue join ujumbemessages on issue.id= ujumbemessages.issueId join ujumbe_users on ujumbe_users.msisdn= ujumbemessages.msisdn join constituency on ujumbe_users.constituency=constituency.const_Id where constituency.constituency='$place' and issue.id='".$issue."'and ujumbemessages.message<>''and ujumbemessages.repId=5";
			return $query;
			else:
			$query="select firstname,secondName, gender,age, ujumbemessages.msisdn,constituency.constituency,issue,ujumbemessages.issueId,ujumbemessages.id,  ujumbemessages.dateCreated from issue join ujumbemessages on issue.id= ujumbemessages.issueId join ujumbe_users on ujumbe_users.msisdn= ujumbemessages.msisdn join constituency on ujumbe_users.constituency=constituency.const_Id where constituency.constituency='$place'and ujumbemessages.message<>''and ujumbemessages.repId=5";
		
			return $query;
			endif;
			
		}
		else
		{
		
	    if($issue!="none"):      
        $query="select ujumbe_users.firstname,ujumbe_users.secondName, ujumbe_users.gender,ujumbe_users.age, ujumbemessages.msisdn,constituency.constituency,issue,ujumbemessages.issueId,ujumbemessages.id,  ujumbemessages.dateCreated from issue join ujumbemessages on issue.id= ujumbemessages.issueId join ujumbe_users on ujumbe_users.msisdn= ujumbemessages.msisdn join constituency on ujumbe_users.constituency=constituency.const_Id where constituency.constituency='$place' and issue.id='".$issue."'and ujumbemessages.message<>''and ujumbemessages.repId=5";
		return $query;
		else:
		$query="select firstname,secondName, gender,age, ujumbemessages.msisdn,constituency.constituency,issue,ujumbemessages.issueId,ujumbemessages.id,  ujumbemessages.dateCreated from issue join ujumbemessages on issue.id= ujumbemessages.issueId join ujumbe_users on ujumbe_users.msisdn= ujumbemessages.msisdn join constituency on ujumbe_users.constituency=constituency.const_Id where constituency.constituency='$place'and ujumbemessages.message<>''and ujumbemessages.repId=5";
		return $query;
		endif;
	}
	}
	
	if($role=="governor"){
		
		if($query_mode==1){
			
			if($issue!="none"):      
			$query="select firstname,secondName, gender,age, ujumbemessages.msisdn,constituency.constituency,issue,ujumbemessages.issueId,ujumbemessages.id,  ujumbemessages.dateCreated from issue join ujumbemessages on issue.id= ujumbemessages.issueId join ujumbe_users on ujumbe_users.msisdn= ujumbemessages.msisdn join constituency on ujumbe_users.constituency=constituency.const_Id join county on constituency.cont_Id=county.id  where county.county='$place' and issue.id='".$issue."'and ujumbemessages.message<>'' and ujumbemessages.repId=3";
			return $query;
			else:
			$query="select firstname,secondName, gender,age, ujumbemessages.msisdn,constituency.constituency,issue,ujumbemessages.issueId,ujumbemessages.id,  ujumbemessages.dateCreated from issue join ujumbemessages on issue.id= ujumbemessages.issueId join ujumbe_users on ujumbe_users.msisdn= ujumbemessages.msisdn join constituency on ujumbe_users.constituency=constituency.const_Id join county on constituency.cont_Id=county.id  where county.county='$place' and ujumbemessages.message<>'' and ujumbemessages.repId=3";
			return $query;
			endif;
			
		}else{
			if($issue!="none"):      
			$query="select firstname,secondName, gender,age, ujumbemessages.msisdn,constituency.constituency,issue,ujumbemessages.issueId,ujumbemessages.id,  ujumbemessages.dateCreated from issue join ujumbemessages on issue.id= ujumbemessages.issueId join ujumbe_users on ujumbe_users.msisdn= ujumbemessages.msisdn join constituency on ujumbe_users.constituency=constituency.const_Id where constituency.constituency='$place' and issue.id='".$issue."'and ujumbemessages.message<>'' ";
			return $query;
			else:
			$query="select firstname,secondName, gender,age, ujumbemessages.msisdn,constituency.constituency,issue,ujumbemessages.issueId,ujumbemessages.id,  ujumbemessages.dateCreated from issue join ujumbemessages on issue.id= ujumbemessages.issueId join ujumbe_users on ujumbe_users.msisdn= ujumbemessages.msisdn join constituency on ujumbe_users.constituency=constituency.const_Id where constituency.constituency='$place'and ujumbemessages.message<>'' ";
			return $query;
			endif;
		}
			
	}
	
		if($role=="senator"){
		
		if($query_mode==1){
			
			if($issue!="none"):      
			$query="select firstname,secondName, gender,age, ujumbemessages.msisdn,constituency.constituency,issue,ujumbemessages.issueId,ujumbemessages.id,  ujumbemessages.dateCreated from issue join ujumbemessages on issue.id= ujumbemessages.issueId join ujumbe_users on ujumbe_users.msisdn= ujumbemessages.msisdn join constituency on ujumbe_users.constituency=constituency.const_Id join county on constituency.cont_Id=county.id  where county.county='$place' and issue.id='".$issue."'and ujumbemessages.message<>'' and ujumbemessages.repId=4";
			return $query;
			else:
			$query="select firstname,secondName, gender,age, ujumbemessages.msisdn,constituency.constituency,issue,ujumbemessages.issueId,ujumbemessages.id,  ujumbemessages.dateCreated from issue join ujumbemessages on issue.id= ujumbemessages.issueId join ujumbe_users on ujumbe_users.msisdn= ujumbemessages.msisdn join constituency on ujumbe_users.constituency=constituency.const_Id join county on constituency.cont_Id=county.id  where county.county='$place' and ujumbemessages.message<>'' and ujumbemessages.repId=4";
			return $query;
			endif;
			
		}else{
			if($issue!="none"):      
			$query="select firstname,secondName, gender,age, ujumbemessages.msisdn,constituency.constituency,issue,ujumbemessages.issueId,ujumbemessages.id,  ujumbemessages.dateCreated from issue join ujumbemessages on issue.id= ujumbemessages.issueId join ujumbe_users on ujumbe_users.msisdn= ujumbemessages.msisdn join constituency on ujumbe_users.constituency=constituency.const_Id where constituency.constituency='$place' and issue.id='".$issue."'and ujumbemessages.message<>'' ";
			return $query;
			else:
			$query="select firstname,secondName, gender,age, ujumbemessages.msisdn,constituency.constituency,issue,ujumbemessages.issueId,ujumbemessages.id,  ujumbemessages.dateCreated from issue join ujumbemessages on issue.id= ujumbemessages.issueId join ujumbe_users on ujumbe_users.msisdn= ujumbemessages.msisdn join constituency on ujumbe_users.constituency=constituency.const_Id where constituency.constituency='$place'and ujumbemessages.message<>'' ";
			return $query;
			endif;
		}
			
	}
	
	if($role=="women rep"){
		
		if($query_mode==1){
			
			if($issue!="none"):      
			$query="select firstname,secondName, gender,age, ujumbemessages.msisdn,constituency.constituency,issue,ujumbemessages.issueId,ujumbemessages.id,  ujumbemessages.dateCreated from issue join ujumbemessages on issue.id= ujumbemessages.issueId join ujumbe_users on ujumbe_users.msisdn= ujumbemessages.msisdn join constituency on ujumbe_users.constituency=constituency.const_Id join county on constituency.cont_Id=county.id  where county.county='$place' and issue.id='".$issue."'and ujumbemessages.message<>'' and ujumbemessages.repId=6";
			return $query;
			else:
			$query="select firstname,secondName, gender,age, ujumbemessages.msisdn,constituency.constituency,issue,ujumbemessages.issueId,ujumbemessages.id,  ujumbemessages.dateCreated from issue join ujumbemessages on issue.id= ujumbemessages.issueId join ujumbe_users on ujumbe_users.msisdn= ujumbemessages.msisdn join constituency on ujumbe_users.constituency=constituency.const_Id join county on constituency.cont_Id=county.id  where county.county='$place' and ujumbemessages.message<>'' and ujumbemessages.repId=6";
			return $query;
			endif;
			
		}else{
			if($issue!="none"):      
			$query="select firstname,secondName, gender,age, ujumbemessages.msisdn,constituency.constituency,issue,ujumbemessages.issueId,ujumbemessages.id,  ujumbemessages.dateCreated from issue join ujumbemessages on issue.id= ujumbemessages.issueId join ujumbe_users on ujumbe_users.msisdn= ujumbemessages.msisdn join constituency on ujumbe_users.constituency=constituency.const_Id where constituency.constituency='$place' and issue.id='".$issue."'and ujumbemessages.message<>'' ";
			return $query;
			else:
			$query="select firstname,secondName, gender,age, ujumbemessages.msisdn,constituency.constituency,issue,ujumbemessages.issueId,ujumbemessages.id,  ujumbemessages.dateCreated from issue join ujumbemessages on issue.id= ujumbemessages.issueId join ujumbe_users on ujumbe_users.msisdn= ujumbemessages.msisdn join constituency on ujumbe_users.constituency=constituency.const_Id where constituency.constituency='$place'and ujumbemessages.message<>'' ";
			return $query;
			endif;
		}
			
	}
	
	if($role=="commissioner"){
		
		if($query_mode==1){
			
			if($issue!="none"):      
			$query="select firstname,secondName, gender,age, ujumbemessages.msisdn,constituency.constituency,issue,ujumbemessages.issueId,ujumbemessages.id,  ujumbemessages.dateCreated from issue join ujumbemessages on issue.id= ujumbemessages.issueId join ujumbe_users on ujumbe_users.msisdn= ujumbemessages.msisdn join constituency on ujumbe_users.constituency=constituency.const_Id join county on constituency.cont_Id=county.id  where county.county='$place' and issue.id='".$issue."'and ujumbemessages.message<>'' and ujumbemessages.repId=7";
			return $query;
			else:
			$query="select firstname,secondName, gender,age, ujumbemessages.msisdn,constituency.constituency,issue,ujumbemessages.issueId,ujumbemessages.id,  ujumbemessages.dateCreated from issue join ujumbemessages on issue.id= ujumbemessages.issueId join ujumbe_users on ujumbe_users.msisdn= ujumbemessages.msisdn join constituency on ujumbe_users.constituency=constituency.const_Id join county on constituency.cont_Id=county.id  where county.county='$place' and ujumbemessages.message<>'' and ujumbemessages.repId=7";
			return $query;
			endif;
			
		}else{
			if($issue!="none"):      
			$query="select firstname,secondName, gender,age, ujumbemessages.msisdn,constituency.constituency,issue,ujumbemessages.issueId,ujumbemessages.id,  ujumbemessages.dateCreated from issue join ujumbemessages on issue.id= ujumbemessages.issueId join ujumbe_users on ujumbe_users.msisdn= ujumbemessages.msisdn join constituency on ujumbe_users.constituency=constituency.const_Id where constituency.constituency='$place' and issue.id='".$issue."'and ujumbemessages.message<>'' ";
			return $query;
			else:
			$query="select firstname,secondName, gender,age, ujumbemessages.msisdn,constituency.constituency,issue,ujumbemessages.issueId,ujumbemessages.id,  ujumbemessages.dateCreated from issue join ujumbemessages on issue.id= ujumbemessages.issueId join ujumbe_users on ujumbe_users.msisdn= ujumbemessages.msisdn join constituency on ujumbe_users.constituency=constituency.const_Id where constituency.constituency='$place'and ujumbemessages.message<>'' ";
			return $query;
			endif;
		}
			
	}
	
	if($role=="commandant"){
		
		if($query_mode==1){
			
			if($issue!="none"):      
			$query="select firstname,secondName, gender,age, ujumbemessages.msisdn,constituency.constituency,issue,ujumbemessages.issueId,ujumbemessages.id,  ujumbemessages.dateCreated from issue join ujumbemessages on issue.id= ujumbemessages.issueId join ujumbe_users on ujumbe_users.msisdn= ujumbemessages.msisdn join constituency on ujumbe_users.constituency=constituency.const_Id join county on constituency.cont_Id=county.id  where county.county='$place' and issue.id='".$issue."'and ujumbemessages.message<>'' and ujumbemessages.issueId=2";
			return $query;
			else:
			$query="select firstname,secondName, gender,age, ujumbemessages.msisdn,constituency.constituency,issue,ujumbemessages.issueId,ujumbemessages.id,  ujumbemessages.dateCreated from issue join ujumbemessages on issue.id= ujumbemessages.issueId join ujumbe_users on ujumbe_users.msisdn= ujumbemessages.msisdn join constituency on ujumbe_users.constituency=constituency.const_Id join county on constituency.cont_Id=county.id  where county.county='$place' and ujumbemessages.message<>'' and ujumbemessages.issueId=2";
			return $query;
			endif;
			
		}else{
			if($issue!="none"):      
			$query="select firstname,secondName, gender,age, ujumbemessages.msisdn,constituency.constituency,issue,ujumbemessages.issueId,ujumbemessages.id,  ujumbemessages.dateCreated from issue join ujumbemessages on issue.id= ujumbemessages.issueId join ujumbe_users on ujumbe_users.msisdn= ujumbemessages.msisdn join constituency on ujumbe_users.constituency=constituency.const_Id where constituency.constituency='$place' and issue.id='".$issue."'and ujumbemessages.message<>'' ";
			return $query;
			else:
			$query="select firstname,secondName, gender,age, ujumbemessages.msisdn,constituency.constituency,issue,ujumbemessages.issueId,ujumbemessages.id,  ujumbemessages.dateCreated from issue join ujumbemessages on issue.id= ujumbemessages.issueId join ujumbe_users on ujumbe_users.msisdn= ujumbemessages.msisdn join constituency on ujumbe_users.constituency=constituency.const_Id where constituency.constituency='$place'and ujumbemessages.message<>'' ";
			return $query;
			endif;
		}
			
	}
	
	if($role=="judiciary"){
		
		if($query_mode==1){
			
			if($issue!="none"):      
			$query="select firstname,secondName, gender,age, ujumbemessages.msisdn,constituency.constituency,issue,ujumbemessages.issueId,ujumbemessages.id,  ujumbemessages.dateCreated from issue join ujumbemessages on issue.id= ujumbemessages.issueId join ujumbe_users on ujumbe_users.msisdn= ujumbemessages.msisdn join constituency on ujumbe_users.constituency=constituency.const_Id join county on constituency.cont_Id=county.id  where county.county='$place' and issue.id='".$issue."'and ujumbemessages.message<>'' and ujumbemessages.issueId=6";
			return $query;
			else:
			$query="select firstname,secondName, gender,age, ujumbemessages.msisdn,constituency.constituency,issue,ujumbemessages.issueId,ujumbemessages.id,  ujumbemessages.dateCreated from issue join ujumbemessages on issue.id= ujumbemessages.issueId join ujumbe_users on ujumbe_users.msisdn= ujumbemessages.msisdn join constituency on ujumbe_users.constituency=constituency.const_Id join county on constituency.cont_Id=county.id  where county.county='$place' and ujumbemessages.message<>'' and ujumbemessages.issueId=6";
			return $query;
			endif;
			
		}else{
			if($issue!="none"):      
			$query="select firstname,secondName, gender,age, ujumbemessages.msisdn,constituency.constituency,issue,ujumbemessages.issueId,ujumbemessages.id,  ujumbemessages.dateCreated from issue join ujumbemessages on issue.id= ujumbemessages.issueId join ujumbe_users on ujumbe_users.msisdn= ujumbemessages.msisdn join constituency on ujumbe_users.constituency=constituency.const_Id where constituency.constituency='$place' and issue.id='".$issue."'and ujumbemessages.message<>'' ";
			return $query;
			else:
			$query="select firstname,secondName, gender,age, ujumbemessages.msisdn,constituency.constituency,issue,ujumbemessages.issueId,ujumbemessages.id,  ujumbemessages.dateCreated from issue join ujumbemessages on issue.id= ujumbemessages.issueId join ujumbe_users on ujumbe_users.msisdn= ujumbemessages.msisdn join constituency on ujumbe_users.constituency=constituency.const_Id where constituency.constituency='$place'and ujumbemessages.message<>'' ";
			return $query;
			endif;
		}
			
	}
	
	if($role=="deputy president"){
		
		if($query_mode==1){
			
			if($issue!="none"):      
			$query="select firstname,secondName, gender,age, ujumbemessages.msisdn,constituency.constituency,issue,ujumbemessages.issueId,ujumbemessages.id,  ujumbemessages.dateCreated from issue join ujumbemessages on issue.id= ujumbemessages.issueId join ujumbe_users on ujumbe_users.msisdn= ujumbemessages.msisdn join constituency on ujumbe_users.constituency=constituency.const_Id join county on constituency.cont_Id=county.id  where issue.id='".$issue."'and ujumbemessages.message<>'' and ujumbemessages.repId=2";
			return $query;
			else:
			$query="select firstname,secondName, gender,age, ujumbemessages.msisdn,constituency.constituency,issue,ujumbemessages.issueId,ujumbemessages.id,  ujumbemessages.dateCreated from issue join ujumbemessages on issue.id= ujumbemessages.issueId join ujumbe_users on ujumbe_users.msisdn= ujumbemessages.msisdn join constituency on ujumbe_users.constituency=constituency.const_Id join county on constituency.cont_Id=county.id  where ujumbemessages.message<>'' and ujumbemessages.repId=2";
			return $query;
			endif;
			
		}else{
			if($issue!="none"):      
			$query="select firstname,secondName, gender,age, ujumbemessages.msisdn,constituency.constituency,issue,ujumbemessages.issueId,ujumbemessages.id,  ujumbemessages.dateCreated from issue join ujumbemessages on issue.id= ujumbemessages.issueId join ujumbe_users on ujumbe_users.msisdn= ujumbemessages.msisdn join constituency on ujumbe_users.constituency=constituency.const_Id join county on constituency.cont_Id=county.id  where county.county='$place' and issue.id='".$issue."'and ujumbemessages.message<>'' and ujumbemessages.repId=2";
			return $query;
			else:
			$query="select firstname,secondName, gender,age, ujumbemessages.msisdn,constituency.constituency,issue,ujumbemessages.issueId,ujumbemessages.id,  ujumbemessages.dateCreated from issue join ujumbemessages on issue.id= ujumbemessages.issueId join ujumbe_users on ujumbe_users.msisdn= ujumbemessages.msisdn join constituency on ujumbe_users.constituency=constituency.const_Id join county on constituency.cont_Id=county.id  where county.county='$place' and issue.id='".$issue."'and ujumbemessages.message<>'' and ujumbemessages.repId=2";
			return $query;
			endif;
		}
			
	}
	
	if($role=="president"){
		
		if($query_mode==1){
			
			if($issue!="none"):      
			$query="select firstname,secondName, gender,age, ujumbemessages.msisdn,constituency.constituency,issue,ujumbemessages.issueId,ujumbemessages.id,  ujumbemessages.dateCreated from issue join ujumbemessages on issue.id= ujumbemessages.issueId join ujumbe_users on ujumbe_users.msisdn= ujumbemessages.msisdn join constituency on ujumbe_users.constituency=constituency.const_Id join county on constituency.cont_Id=county.id  where issue.id='".$issue."'and ujumbemessages.message<>'' and ujumbemessages.repId=1";
			return $query;
			else:
			$query="select firstname,secondName, gender,age, ujumbemessages.msisdn,constituency.constituency,issue,ujumbemessages.issueId,ujumbemessages.id,  ujumbemessages.dateCreated from issue join ujumbemessages on issue.id= ujumbemessages.issueId join ujumbe_users on ujumbe_users.msisdn= ujumbemessages.msisdn join constituency on ujumbe_users.constituency=constituency.const_Id join county on constituency.cont_Id=county.id  where ujumbemessages.message<>'' and ujumbemessages.repId=1";
			return $query;
			endif;
			
		}else{
			if($issue!="none"):      
			$query="select firstname,secondName, gender,age, ujumbemessages.msisdn,constituency.constituency,issue,ujumbemessages.issueId,ujumbemessages.id,  ujumbemessages.dateCreated from issue join ujumbemessages on issue.id= ujumbemessages.issueId join ujumbe_users on ujumbe_users.msisdn= ujumbemessages.msisdn join constituency on ujumbe_users.constituency=constituency.const_Id join county on constituency.cont_Id=county.id  where county.county='$place' and issue.id='".$issue."'and ujumbemessages.message<>'' and ujumbemessages.repId=1";
			return $query;
			else:
			$query="select firstname,secondName, gender,age, ujumbemessages.msisdn,constituency.constituency,issue,ujumbemessages.issueId,ujumbemessages.id,  ujumbemessages.dateCreated from issue join ujumbemessages on issue.id= ujumbemessages.issueId join ujumbe_users on ujumbe_users.msisdn= ujumbemessages.msisdn join constituency on ujumbe_users.constituency=constituency.const_Id join county on constituency.cont_Id=county.id  where county.county='$place' and issue.id='".$issue."'and ujumbemessages.message<>'' and ujumbemessages.repId=1";
			return $query;
			endif;
		}
			
	}
	
	if($role=="cs internal security"){
		
		if($query_mode==1){
			
			if($issue!="none"):      
			$query="select firstname,secondName, gender,age, ujumbemessages.msisdn,constituency.constituency,issue,ujumbemessages.issueId,ujumbemessages.id,  ujumbemessages.dateCreated from issue join ujumbemessages on issue.id= ujumbemessages.issueId join ujumbe_users on ujumbe_users.msisdn= ujumbemessages.msisdn join constituency on ujumbe_users.constituency=constituency.const_Id join county on constituency.cont_Id=county.id  where issue.id=2 and ujumbemessages.message<>'' ";
			return $query;
			else:
			$query="select firstname,secondName, gender,age, ujumbemessages.msisdn,constituency.constituency,issue,ujumbemessages.issueId,ujumbemessages.id,  ujumbemessages.dateCreated from issue join ujumbemessages on issue.id= ujumbemessages.issueId join ujumbe_users on ujumbe_users.msisdn= ujumbemessages.msisdn join constituency on ujumbe_users.constituency=constituency.const_Id join county on constituency.cont_Id=county.id  where ujumbemessages.message<>'' and ujumbemessages.issueId=2";
			return $query;
			endif;
			
		}else{
			if($issue!="none"):      
			$query="select firstname,secondName, gender,age, ujumbemessages.msisdn,constituency.constituency,issue,ujumbemessages.issueId,ujumbemessages.id,  ujumbemessages.dateCreated from issue join ujumbemessages on issue.id= ujumbemessages.issueId join ujumbe_users on ujumbe_users.msisdn= ujumbemessages.msisdn join constituency on ujumbe_users.constituency=constituency.const_Id join county on constituency.cont_Id=county.id  where county.county='$place' and issue.id=2 and ujumbemessages.message<>'' ";
			return $query;
			else:
			$query="select firstname,secondName, gender,age, ujumbemessages.msisdn,constituency.constituency,issue,ujumbemessages.issueId,ujumbemessages.id,  ujumbemessages.dateCreated from issue join ujumbemessages on issue.id= ujumbemessages.issueId join ujumbe_users on ujumbe_users.msisdn= ujumbemessages.msisdn join constituency on ujumbe_users.constituency=constituency.const_Id join county on constituency.cont_Id=county.id  where county.county='$place' and issue.id=2 and ujumbemessages.message<>'' ";
			return $query;
			endif;
		}
			
	}
	
	if($role=="cs health"){
		
		if($query_mode==1){
			
			if($issue!="none"):      
			$query="select firstname,secondName, gender,age, ujumbemessages.msisdn,constituency.constituency,issue,ujumbemessages.issueId,ujumbemessages.id,  ujumbemessages.dateCreated from issue join ujumbemessages on issue.id= ujumbemessages.issueId join ujumbe_users on ujumbe_users.msisdn= ujumbemessages.msisdn join constituency on ujumbe_users.constituency=constituency.const_Id join county on constituency.cont_Id=county.id  where issue.id=4 and ujumbemessages.message<>'' ";
			return $query;
			else:
			$query="select firstname,secondName, gender,age, ujumbemessages.msisdn,constituency.constituency,issue,ujumbemessages.issueId,ujumbemessages.id,  ujumbemessages.dateCreated from issue join ujumbemessages on issue.id= ujumbemessages.issueId join ujumbe_users on ujumbe_users.msisdn= ujumbemessages.msisdn join constituency on ujumbe_users.constituency=constituency.const_Id join county on constituency.cont_Id=county.id  where ujumbemessages.message<>'' and ujumbemessages.issueId=4";
			return $query;
			endif;
			
		}else{
			if($issue!="none"):      
			$query="select firstname,secondName, gender,age, ujumbemessages.msisdn,constituency.constituency,issue,ujumbemessages.issueId,ujumbemessages.id,  ujumbemessages.dateCreated from issue join ujumbemessages on issue.id= ujumbemessages.issueId join ujumbe_users on ujumbe_users.msisdn= ujumbemessages.msisdn join constituency on ujumbe_users.constituency=constituency.const_Id join county on constituency.cont_Id=county.id  where county.county='$place' and issue.id=4 and ujumbemessages.message<>'' ";
			return $query;
			else:
			$query="select firstname,secondName, gender,age, ujumbemessages.msisdn,constituency.constituency,issue,ujumbemessages.issueId,ujumbemessages.id,  ujumbemessages.dateCreated from issue join ujumbemessages on issue.id= ujumbemessages.issueId join ujumbe_users on ujumbe_users.msisdn= ujumbemessages.msisdn join constituency on ujumbe_users.constituency=constituency.const_Id join county on constituency.cont_Id=county.id  where county.county='$place' and issue.id=4 and ujumbemessages.message<>'' ";
			return $query;
			endif;
		}
			
	}
	
	if($role=="cs education"){
		
		if($query_mode==1){
			
			if($issue!="none"):      
			$query="select firstname,secondName, gender,age, ujumbemessages.msisdn,constituency.constituency,issue,ujumbemessages.issueId,ujumbemessages.id,  ujumbemessages.dateCreated from issue join ujumbemessages on issue.id= ujumbemessages.issueId join ujumbe_users on ujumbe_users.msisdn= ujumbemessages.msisdn join constituency on ujumbe_users.constituency=constituency.const_Id join county on constituency.cont_Id=county.id  where issue.id=5 and ujumbemessages.message<>'' ";
			return $query;
			else:
			$query="select firstname,secondName, gender,age, ujumbemessages.msisdn,constituency.constituency,issue,ujumbemessages.issueId,ujumbemessages.id,  ujumbemessages.dateCreated from issue join ujumbemessages on issue.id= ujumbemessages.issueId join ujumbe_users on ujumbe_users.msisdn= ujumbemessages.msisdn join constituency on ujumbe_users.constituency=constituency.const_Id join county on constituency.cont_Id=county.id  where ujumbemessages.message<>'' and ujumbemessages.issueId=5";
			return $query;
			endif;
			
		}else{
			if($issue!="none"):      
			$query="select firstname,secondName, gender,age, ujumbemessages.msisdn,constituency.constituency,issue,ujumbemessages.issueId,ujumbemessages.id,  ujumbemessages.dateCreated from issue join ujumbemessages on issue.id= ujumbemessages.issueId join ujumbe_users on ujumbe_users.msisdn= ujumbemessages.msisdn join constituency on ujumbe_users.constituency=constituency.const_Id join county on constituency.cont_Id=county.id  where county.county='$place' and issue.id=5 and ujumbemessages.message<>'' ";
			return $query;
			else:
			$query="select firstname,secondName, gender,age, ujumbemessages.msisdn,constituency.constituency,issue,ujumbemessages.issueId,ujumbemessages.id,  ujumbemessages.dateCreated from issue join ujumbemessages on issue.id= ujumbemessages.issueId join ujumbe_users on ujumbe_users.msisdn= ujumbemessages.msisdn join constituency on ujumbe_users.constituency=constituency.const_Id join county on constituency.cont_Id=county.id  where county.county='$place' and issue.id=5 and ujumbemessages.message<>'' ";
			return $query;
			endif;
		}
			
	}
	
	if($role=="cs devolution"){
		
		if($query_mode==1){
			
			if($issue!="none"):      
			$query="select firstname,secondName, gender,age, ujumbemessages.msisdn,constituency.constituency,issue,ujumbemessages.issueId,ujumbemessages.id,  ujumbemessages.dateCreated from issue join ujumbemessages on issue.id= ujumbemessages.issueId join ujumbe_users on ujumbe_users.msisdn= ujumbemessages.msisdn join constituency on ujumbe_users.constituency=constituency.const_Id join county on constituency.cont_Id=county.id  where issue.id='".$issue."'and ujumbemessages.message<>'' ";
			return $query;
			else:
			$query="select firstname,secondName, gender,age, ujumbemessages.msisdn,constituency.constituency,issue,ujumbemessages.issueId,ujumbemessages.id,  ujumbemessages.dateCreated from issue join ujumbemessages on issue.id= ujumbemessages.issueId join ujumbe_users on ujumbe_users.msisdn= ujumbemessages.msisdn join constituency on ujumbe_users.constituency=constituency.const_Id join county on constituency.cont_Id=county.id  where ujumbemessages.message<>'' ";
			return $query;
			endif;
			
		}else{
			if($issue!="none"):      
			$query="select firstname,secondName, gender,age, ujumbemessages.msisdn,constituency.constituency,issue,ujumbemessages.issueId,ujumbemessages.id,  ujumbemessages.dateCreated from issue join ujumbemessages on issue.id= ujumbemessages.issueId join ujumbe_users on ujumbe_users.msisdn= ujumbemessages.msisdn join constituency on ujumbe_users.constituency=constituency.const_Id join county on constituency.cont_Id=county.id  where county.county='$place' and issue.id='".$issue."'and ujumbemessages.message<>'' ";
			return $query;
			else:
			$query="select firstname,secondName, gender,age, ujumbemessages.msisdn,constituency.constituency,issue,ujumbemessages.issueId,ujumbemessages.id,  ujumbemessages.dateCreated from issue join ujumbemessages on issue.id= ujumbemessages.issueId join ujumbe_users on ujumbe_users.msisdn= ujumbemessages.msisdn join constituency on ujumbe_users.constituency=constituency.const_Id join county on constituency.cont_Id=county.id  where county.county='$place' and issue.id='".$issue."'and ujumbemessages.message<>'' ";
			return $query;
			endif;
		}
			
	}




}

function count_all($place,$role,$query_mode){
	require_once("config.php");
	
	if($role=="mp"){		
	$result=mysql_query("SELECT count(*) as total from ujumbemessages join ujumbe_users on ujumbe_users.msisdn= ujumbemessages.msisdn join constituency on ujumbe_users.constituency=constituency.const_Id where constituency.constituency='".$place."' 
    and ujumbemessages.message<>'' and ujumbemessages.repId=5" );
    $data=mysql_fetch_assoc($result);
	 return $data['total'];
	}
	 elseif($role=="governor"){	
     if($query_mode==1):	 
	$result=mysql_query("SELECT count(*) as total from ujumbemessages join ujumbe_users on ujumbe_users.msisdn= ujumbemessages.msisdn join constituency on ujumbe_users.constituency=constituency.const_Id join county on constituency.cont_Id=county.id  where county.county='".$_SESSION['username']."' and ujumbemessages.message<>''and ujumbemessages.repId=3" );
    $data=mysql_fetch_assoc($result);
	
	 return $data['total'];
	 else:
	 $result=mysql_query("SELECT count(*) as total from ujumbemessages join ujumbe_users on ujumbe_users.msisdn= ujumbemessages.msisdn join constituency on ujumbe_users.constituency=constituency.const_Id   where constituency.constituency='".$place."' and ujumbemessages.message<>''" );
    $data=mysql_fetch_assoc($result);
	
	 return $data['total'];
	 endif;
	}
	 elseif($role=="senator"){	
     if($query_mode==1):	 
	$result=mysql_query("SELECT count(*) as total from ujumbemessages join ujumbe_users on ujumbe_users.msisdn= ujumbemessages.msisdn join constituency on ujumbe_users.constituency=constituency.const_Id join county on constituency.cont_Id=county.id  where county.county='".$_SESSION['username']."' and ujumbemessages.message<>''and ujumbemessages.repId=4" );
    $data=mysql_fetch_assoc($result);
	
	 return $data['total'];
	  else:
	 $result=mysql_query("SELECT count(*) as total from ujumbemessages join ujumbe_users on ujumbe_users.msisdn= ujumbemessages.msisdn join constituency on ujumbe_users.constituency=constituency.const_Id   where constituency.constituency='".$place."' and ujumbemessages.message<>''" );
    $data=mysql_fetch_assoc($result);
	
	 return $data['total'];
	 endif;
	}
	
	 elseif($role=="women rep"){	
     if($query_mode==1):	 
	$result=mysql_query("SELECT count(*) as total from ujumbemessages join ujumbe_users on ujumbe_users.msisdn= ujumbemessages.msisdn join constituency on ujumbe_users.constituency=constituency.const_Id join county on constituency.cont_Id=county.id  where county.county='".$_SESSION['username']."' and ujumbemessages.message<>''and ujumbemessages.repId=6" );
    $data=mysql_fetch_assoc($result);
	
	 return $data['total'];
	  else:
	 $result=mysql_query("SELECT count(*) as total from ujumbemessages join ujumbe_users on ujumbe_users.msisdn= ujumbemessages.msisdn join constituency on ujumbe_users.constituency=constituency.const_Id   where constituency.constituency='".$place."' and ujumbemessages.message<>''" );
    $data=mysql_fetch_assoc($result);
	
	 return $data['total'];
	 endif;
	}
	 elseif($role=="commissioner"){	
     if($query_mode==1):	 
	$result=mysql_query("SELECT count(*) as total from ujumbemessages join ujumbe_users on ujumbe_users.msisdn= ujumbemessages.msisdn join constituency on ujumbe_users.constituency=constituency.const_Id join county on constituency.cont_Id=county.id  where county.county='".$_SESSION['username']."' and ujumbemessages.message<>''and ujumbemessages.repId=7" );
    $data=mysql_fetch_assoc($result);
	
	 return $data['total'];
	  else:
	 $result=mysql_query("SELECT count(*) as total from ujumbemessages join ujumbe_users on ujumbe_users.msisdn= ujumbemessages.msisdn join constituency on ujumbe_users.constituency=constituency.const_Id   where constituency.constituency='".$place."' and ujumbemessages.message<>''" );
    $data=mysql_fetch_assoc($result);
	
	 return $data['total'];
	 endif;
	}
	 elseif($role=="commandant"){	
     if($query_mode==1):	 
	$result=mysql_query("SELECT count(*) as total from ujumbemessages join ujumbe_users on ujumbe_users.msisdn= ujumbemessages.msisdn join constituency on ujumbe_users.constituency=constituency.const_Id join county on constituency.cont_Id=county.id  where county.county='".$_SESSION['username']."' and ujumbemessages.message<>''and ujumbemessages.repId=10" );
    $data=mysql_fetch_assoc($result);
	
	 return $data['total'];
	  else:
	 $result=mysql_query("SELECT count(*) as total from ujumbemessages join ujumbe_users on ujumbe_users.msisdn= ujumbemessages.msisdn join constituency on ujumbe_users.constituency=constituency.const_Id   where constituency.constituency='".$place."' and ujumbemessages.message<>''" );
    $data=mysql_fetch_assoc($result);
	
	 return $data['total'];
	 endif;
	}
 	
	
}


function count_per_issue($place,$issue_id,$role,$query_mode){
	require_once("config.php");
	 
	if($role=="mp"){		
	$result=mysql_query("SELECT count(*) as total from ujumbemessages join ujumbe_users on ujumbe_users.msisdn= ujumbemessages.msisdn join issue on ujumbemessages.issueId=issue.id join constituency on ujumbe_users.constituency=constituency.const_Id where constituency.constituency='".$place."' and issue.id='".$issue_id."'and ujumbemessages.message<>'' and ujumbemessages.repId=5" );
    $data=mysql_fetch_assoc($result);
	 return $data['total'];
	}
	if($role=="governor"){
     if($query_mode==1):		
	$result=mysql_query("SELECT count(*) as total from ujumbemessages join ujumbe_users on ujumbe_users.msisdn= ujumbemessages.msisdn join issue on ujumbemessages.issueId=issue.id join constituency on ujumbe_users.constituency=constituency.const_Id join county on constituency.cont_Id=county.id  where county.county='".$_SESSION['username']."' and issue.id='".$issue_id."'and ujumbemessages.message<>''and ujumbemessages.repId=3" );
    $data=mysql_fetch_assoc($result);
	 return $data['total'];
	 else:
	 $result=mysql_query("SELECT count(*) as total from ujumbemessages join ujumbe_users on ujumbe_users.msisdn= ujumbemessages.msisdn join issue on ujumbemessages.issueId=issue.id join constituency on ujumbe_users.constituency=constituency.const_Id where constituency.constituency='".$place."' and issue.id='".$issue_id."'and ujumbemessages.message<>''" );
    $data=mysql_fetch_assoc($result);
	 return $data['total'];
	 endif;
	}
		if($role=="senator"){
     if($query_mode==1):			
	$result=mysql_query("SELECT count(*) as total from ujumbemessages join ujumbe_users on ujumbe_users.msisdn= ujumbemessages.msisdn join issue on ujumbemessages.issueId=issue.id join constituency on ujumbe_users.constituency=constituency.const_Id join county on constituency.cont_Id=county.id  where county.county='".$_SESSION['username']."' and issue.id='".$issue_id."'and ujumbemessages.message<>''and ujumbemessages.repId=4" );
    $data=mysql_fetch_assoc($result);
	 return $data['total'];
	 else:
	 $result=mysql_query("SELECT count(*) as total from ujumbemessages join ujumbe_users on ujumbe_users.msisdn= ujumbemessages.msisdn join issue on ujumbemessages.issueId=issue.id join constituency on ujumbe_users.constituency=constituency.const_Id where constituency.constituency='".$place."' and issue.id='".$issue_id."'and ujumbemessages.message<>''" );
    $data=mysql_fetch_assoc($result);
	 return $data['total'];
	 endif;
	}
		if($role=="women rep"){
     if($query_mode==1):			
	$result=mysql_query("SELECT count(*) as total from ujumbemessages join ujumbe_users on ujumbe_users.msisdn= ujumbemessages.msisdn join issue on ujumbemessages.issueId=issue.id join constituency on ujumbe_users.constituency=constituency.const_Id join county on constituency.cont_Id=county.id  where county.county='".$_SESSION['username']."' and issue.id='".$issue_id."'and ujumbemessages.message<>''and ujumbemessages.repId=6" );
    $data=mysql_fetch_assoc($result);
	 return $data['total'];
	 else:
	 $result=mysql_query("SELECT count(*) as total from ujumbemessages join ujumbe_users on ujumbe_users.msisdn= ujumbemessages.msisdn join issue on ujumbemessages.issueId=issue.id join constituency on ujumbe_users.constituency=constituency.const_Id where constituency.constituency='".$place."' and issue.id='".$issue_id."'and ujumbemessages.message<>''" );
    $data=mysql_fetch_assoc($result);
	 return $data['total'];
	 endif;
	}
	
		if($role=="commissioner"){
     if($query_mode==1):			
	$result=mysql_query("SELECT count(*) as total from ujumbemessages join ujumbe_users on ujumbe_users.msisdn= ujumbemessages.msisdn join issue on ujumbemessages.issueId=issue.id join constituency on ujumbe_users.constituency=constituency.const_Id join county on constituency.cont_Id=county.id  where county.county='".$_SESSION['username']."' and issue.id='".$issue_id."'and ujumbemessages.message<>''and ujumbemessages.repId=7" );
    $data=mysql_fetch_assoc($result);
	 return $data['total'];
	 else:
	 $result=mysql_query("SELECT count(*) as total from ujumbemessages join ujumbe_users on ujumbe_users.msisdn= ujumbemessages.msisdn join issue on ujumbemessages.issueId=issue.id join constituency on ujumbe_users.constituency=constituency.const_Id where constituency.constituency='".$place."' and issue.id='".$issue_id."'and ujumbemessages.message<>''" );
    $data=mysql_fetch_assoc($result);
	 return $data['total'];
	 endif;
	}
	
		if($role=="commandant"){
     if($query_mode==1):			
	$result=mysql_query("SELECT count(*) as total from ujumbemessages join ujumbe_users on ujumbe_users.msisdn= ujumbemessages.msisdn join issue on ujumbemessages.issueId=issue.id join constituency on ujumbe_users.constituency=constituency.const_Id join county on constituency.cont_Id=county.id  where county.county='".$_SESSION['username']."' and issue.id='".$issue_id."'and ujumbemessages.message<>''and ujumbemessages.repId=10" );
    $data=mysql_fetch_assoc($result);
	 return $data['total'];
	 else:
	 $result=mysql_query("SELECT count(*) as total from ujumbemessages join ujumbe_users on ujumbe_users.msisdn= ujumbemessages.msisdn join issue on ujumbemessages.issueId=issue.id join constituency on ujumbe_users.constituency=constituency.const_Id where constituency.constituency='".$place."' and issue.id='".$issue_id."'and ujumbemessages.message<>''" );
    $data=mysql_fetch_assoc($result);
	 return $data['total'];
	 endif;
	}
 
   
}
?>