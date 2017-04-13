<?php 
	include "../functions.php"; 
<<<<<<< HEAD
	if(!isset($_SESSION['user'])) header("Location: ../login/");
=======
	if(!isset($_SESSION['user'])) header("Location: ../login/index.php");
>>>>>>> origin/dev
	include "index.tpl.php";
?>