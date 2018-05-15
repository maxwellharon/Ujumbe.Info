<?php
session_start();
// for a single variable
unset($_SESSION['role']); 
unset($_SESSION['username']);
session_destroy();

header("location:login.html");
?>