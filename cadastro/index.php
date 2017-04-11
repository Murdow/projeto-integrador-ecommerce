<?php
	include "../functions.php";
	if(isset($_POST['email']) && isset($_POST['password']) && isset($_POST['passconfirm']) && isset($_POST['name']))
		newUser($dsn);
	include "cadastro.tpl.php";
?>