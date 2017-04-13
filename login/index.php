<?php
	include ("../functions.php");
	logOut();
	if(isset($_SESSION['user'])) header("Location: ../dashboard");
	if(isset($_POST['login']) && isset($_POST['password'])) logIn($db);
	include "login.tpl.php";

?>
