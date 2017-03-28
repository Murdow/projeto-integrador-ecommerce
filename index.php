<?php
	session_start();
	if(isset($_SESSION['user'])) header("Location: dashboard.php");
?>
<a href="cadastro.php">Cadastro</a>
<a href="login.php">Log-in</a>
