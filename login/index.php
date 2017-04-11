<?php
	include ("../functions.php");
	logOut();
	if(isset($_SESSION['user'])) header("Location: ../dashboard");
	logIn($dsn);
    include "login.tpl.php";

?>