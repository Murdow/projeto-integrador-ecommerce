<?php
	include ("../functions.php");
	logOut();
	if(isset($_SESSION['user'])) header("Location: ../dashboard");
<<<<<<< HEAD
	if(isset($_POST['login']) && isset($_POST['password'])) logIn($db);
=======
	if(isset($_POST['login']) && isset($_POST['password'])) logIn();
>>>>>>> origin/dev
	include "login.tpl.php";

?>
