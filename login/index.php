<?php
	include ("../functions.php");
	logOut();
	if(isset($_SESSION['user'])) header("Location: ../dashboard");
	if(isset($_POST['login']) && isset($_POST['password'])) $_SESSION['user'] = $_POST['login'] ;
	include "login.tpl.php";

?>