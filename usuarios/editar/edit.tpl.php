<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <title>Editar Usuário</title>
	<link rel="stylesheet" type="text/css" href="../../testeestilo.css">
    <style type="text/css">
		form {
			background-color: #fff;
			box-sizing: border-box;
			margin: 0 auto;
			padding: 20px;
			width: 500px;
		}
		label {
			color: #000;
			font-weight: bold;
		}
		input {
			background-color: #ddd;
		}
		input[type=file] {
			color: #000;
		}
		textarea {
			height: 200px;
			width: 230px;
		}
		#prodName {
			width: 70%;
		}
		#prodPrice, #prodDiscount {
			width: 55px;
		}
		#prodQtd {
			width: 25px;
		}
		#updateSuccess {
			color: red;
		}
		p {		
			margin-bottom: 10px;
			padding-bottom: 10px;
		}
		.searchForm {
			background-color: #000;
		}
		.id {
			display: none;
		}
		#message {
			color: red;
			font-weight: bolder;
			text-align: center;
		}
	</style>
</head>
<body>

	<div id="wrapper">
		<header id="pageHeader">
			<h1><a href="/loja/dashboard">Dashboard</a></h1>
			
		</header>
		
		<nav id="productsControlNavigation">
			<ul>
				<li><a href="../../produtos/">PRODUTOS</a></li>
				<li><a href="../../categorias/">CATEGORIAS</a></li>
				<li><a href="../../usuarios/">USUARIOS</a></li>
				<li><a href="../../login/?session=finish">Sair</a></li>
			</ul>	
		</nav>
    </div>
    
    <form method="POST" action="?id=<?php echo $_GET['id']; ?>&update=true">
		<p id="message"> <?php echo $msg; ?></p>
		<p>
			<input class="id" type="hidden" name="id" required value="<?php echo $result['idUsuario']; ?>">
		</p>
		<p>
			<label>Nome:</label>
			<input type="text" id="name" name="name" required value="<?php echo $result['nomeUsuario']; ?>">
		</p>
		<p>	
			<label>login: </label>
			<input type="text" id="login" name="login" required value="<?php echo $result['loginUsuario']; ?>">
		</p>
		<p>
			<label>Senha: </label>
			<input type="password" id="password" name="password" required value="">
		</p>
		<p>
			<label>Perfil:	</label>
			<select name="profile">
				<?php checkProfileType($db); ?>
			</select>
		</P>
		<p>
			<label>Ativo: </label>
			<?php checkProfileStatus($db); ?>
		</p>
		<p>
			<input type="submit" value="Salvar Alterações">
		</p>
		<a href="produtos/">Back</a>
	</form>
	
</body>
</html>