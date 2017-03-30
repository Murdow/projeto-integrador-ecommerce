<?php
	include "../functions.php";
	if(isset($_SESSION['user'])) header("Location: ../dashboard/index.php");	
	if(isset($_POST['login']) && isset($_POST['password']) && isset($_POST['email']) && isset($_POST['name']))
		newUser();
	include "cadastro.tpl.php";
?>