<?php
	include "../functions.php";
	if(isset($_SESSION['user'])) header("Location: ../dashboard/");	
	if(isset($_POST['email']) && isset($_POST['password']) && isset($_POST['name'])) newUser($db);
	include "cadastro.tpl.php";
?>