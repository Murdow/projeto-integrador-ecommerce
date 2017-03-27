<?php
	include "functions.php";
?>
<!DOCTYPE html>
<html>
<head>
	<title>Dashboard</title>
	<link rel="stylesheet" type="text/css" href="stylesheet.css">
</head>
<body>

	<div id="wrapper">
		<header id="pageHeader">
			<h1><a href="dashboard.php">Dashboard</a></h1>
			<h2> Bem Vindo <?php echo getSessionUserName(); ?>!</h2>
		</header>
		
		<nav id="productsControlNavigation">
			<ul>
				<li><a href="edit.php?action=list">PRODUTOS</a></li>
				<li><a href="edit.php?action=update">UPDATE</a></li>
				<li><a href="edit.php?action=delete">DELETE</a></li>
				<li><a href="login.php?session=finish">Sair</a></li>
			</ul>	
		</nav>

		<?php checkAction(); ?>
		
	</div>
	
</body>
</html>