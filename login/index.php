<?php
	include ("../functions.php");
	logOut();
	if(isset($_SESSION['user'])) header("Location: ../dashboard/index.php");
	if(isset($_POST['login']) && isset($_POST['password'])) logIn();
	include "login.tpl.php";
?>