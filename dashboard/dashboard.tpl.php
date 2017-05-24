<!DOCTYPE html>
<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <title>Dashboard</title>
	<link rel="stylesheet" type="text/css" href="../testeestilo.css">
    
</head>
<body>

	<div id="wrapper">
		<header id="pageHeader">
			<a href="../dashboard">
				<img src="../imagems/logo.jpg" alt="logo" title="home">
			</a>
			<h2> Bem Vindo <?php echo getSessionUserName();?>!</h2>
		</header>
		
		<nav id="productsControlNavigation">
			<ul>
				<li><a href="../produtos/">PRODUTOS</a></li>
				<li><a href="../categorias/">CATEGORIAS</a></li>
				<li><a href="../usuarios/">USUARIOS</a></li>
				<li><a href="../login/?session=finish">Sair</a></li>
			</ul>	
		</nav>
    </div>
    
    <?php checkAction($db); ?>
    <article>
        <a href="../produtos/"><div id="esquerda" class="bannerdash"><div class="fundo"><p>Produtos</p></div></div></a>
        <a href="../categorias/"><div id="meio" class="bannerdash"><div class="fundo"><p>Categorias</p></div></div></a>
        <a href="../usuarios"><div id="direita" class="bannerdash"><div class="fundo"><p>Usuarios</p></div></div></a>
    </article>
</body>
</html>