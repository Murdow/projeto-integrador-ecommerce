<?php
	session_start();
	if(isset($_SESSION['user'])) header("Location: dashboard/index.php");
?>
<a href="cadastro/index.php">Cadastro</a>
<a href="login/index.php">Log-in</a>
