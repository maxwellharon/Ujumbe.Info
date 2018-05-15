<?php
session_start();
require_once('config.php');


if(isset($_SESSION['username'])){
	
	if($_SESSION['role']=="president"):
	header("location:president.php");
	elseif($_SESSION['role']=="deputy president"):
	header("location:deputy_president.php");
	elseif($_SESSION['role']=="cs"):
	header("location:cs.php");	
	elseif($_SESSION['role']=="governor"):
	header("location:governor.php");
	elseif($_SESSION['role']=="senator"):
	header("location:senator.php");
	elseif($_SESSION['role']=="women rep"):
	header("location:women_rep.php");
	elseif($_SESSION['role']=="mp"):
    header("location:specific-constituency.php");
	elseif($_SESSION['role']=="commissioner"):
	header("location:county_commissioner.php");
	elseif($_SESSION['role']=="IG"):
	header("location:inspector_general.php");
	elseif($_SESSION['role']=="commandant"):
	header("location:county_commandant.php");
	elseif($_SESSION['role']=="judiciary"):
	header("location:judiciary.php");
	elseif($_SESSION['role']=="cs internal security"):
	header("location:internal_cs.php");
	elseif($_SESSION['role']=="cs health"):
	header("location:health_cs.php");
	elseif($_SESSION['role']=="cs education"):
	header("location:education_cs.php");
	elseif($_SESSION['role']=="cs devolution"):
	header("location:devolution_cs.php");
	
	
	endif;
	
}
?>
