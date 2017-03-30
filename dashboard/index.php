<?php 
	include "../functions.php"; 
	if(!isset($_SESSION['user'])) header("Location: ../login/index.php");
	include "dashboard.tpl.php";
?>