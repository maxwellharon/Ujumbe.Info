<?php
session_start();
if(isset($_SESSION['username'])){
header("location:specific-county.php?county={$_SESSION['username']}");
}


?>

