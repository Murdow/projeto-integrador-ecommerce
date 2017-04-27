<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <title>Insert</title>
	<link rel="stylesheet" type="text/css" href="../../testeestilo.css">
    
    <style type="text/css">
		* {
			margin: 0;
			padding: 0;
		}
		body {
			background-color: #fff;
			padding-top: 20px;
			text-align: left;
		}
		#addNew, #delete {
			color: #000;
			background-color: #ddd;
			border: solid 1px #aaa;
			padding: .3px 0;
			text-decoration: none;
		}
		form {
			background-color: #fff;
			border: solid 5px #000;
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
			height: 400px;
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
    
    <form method="POST" action="?save=true">
		<p id="message"> <?php echo $msg; ?></p>
		<p>
			<label>Nome:</label>
			<input type="text" id="prodName" name="prodName" placeholder="Digite o nome do produto">
		</p>
		<p>	
			<label>Preço:</label>
			<input type="text" id="prodPrice" name="prodPrice" placeholder="00.00">
		</p>
		<p>
			<label>Descrição:</label>
			<textarea type="text" id="prodDescription" name="prodDescription" placeholder="Descrição do produto"></textarea>
		</p>
		<p>
			<label>Categoria:</label>
			<select id="prodCategory" name="prodCategory">
				<option>Selecione uma categoria</option>
				<?php loadCatedories($db); ?>
			</select>
		</p>
		<p>
			<label>Imagem:</label>
			<input type="file" id="prodImg" name="prodImg" accept="image/*">
		</p>
		<p>
			<label>Estoque:</label>
			<input type="text" id="prodQtd" name="prodQtd" value="0">
		</p>
		<p>
			<label>Desconto:</label>
			<input type="text" id="prodDiscount" name="prodDiscount" value="00.00">
		</p>
		<p>
			<label>Status:</label>
			<select id="prodStatus" name="prodStatus">
				<option value="1">Ativo</option>
				<option value="0">Inativo</option>
			</select>
		</p>
		<p>
			<label>Cadastrado por: <?php echo checkUserId($db, getSessionUserId()); ?></label>
		</p>
		<p>
			<input type="submit" value="Salvar Produto">
		</p>
	</form>
	
</body>
</html>