<?php
session_start();
session_destroy();
header("location:county-login.php");
?>