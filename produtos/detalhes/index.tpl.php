<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <title>Dashboard</title>
	<link rel="stylesheet" type="text/css" href="../../testeestilo.css">
    
</head>
<body>

	<div id="wrapper">
		<header id="pageHeader">
			<h1><a href="/loja/dashboard">Dashboard</a></h1>
			
		</header>
		
		<nav id="productsControlNavigation">
			<ul>
				<li><a href="../../produtos/?action=list">PRODUTOS</a></li>
				<li><a href="../../categorias/?action=update">CATEGORIAS</a></li>
				<li><a href="../../usuario/?action=delete">USUARIOS</a></li>
				<li><a href="login.php?session=finish">Sair</a></li>
			</ul>	
		</nav>
    </div>
    
    <?php detalhesItem($dsn); ?>
	
</body>
</html>