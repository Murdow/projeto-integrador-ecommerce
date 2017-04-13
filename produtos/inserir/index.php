<<<<<<< HEAD
<?php 
	include "../../functions.php"; 
	if(!isset($_SESSION['user'])) header("Location: ../../login/");
	include "index.tpl.php";
=======
<?php 
	include "../../functions.php"; 
	if(!isset($_SESSION['user'])) header("Location: ../../login/index.php");
	include "index.tpl.php";
>>>>>>> origin/dev
?>