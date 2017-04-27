<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <title>Dashboard</title>
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
			<input class="id" type="hidden" name="prodID" value="<?php echo $result['idProduto']; ?>">
		</p>
		<p>
			<label>Nome:</label>
			<input type="text" id="prodName" name="prodName" value="<?php echo $result['nomeProduto']; ?>">
		</p>
		<p>	
			<label>Preço:</label>
			<input type="text" id="prodPrice" name="prodPrice" value="<?php echo str_replace(",", ".", number_format($result['precProduto'], 2, ',', ' ')); ?>">
		</p>
		<p>
			<label>Descrição:</label>
			<textarea type="text" id="prodDescription" name="prodDescription"><?php echo $result['descProduto']; ?></textarea>
		</p>
		<p>
			<label>Categoria:</label>
			<select id="prodCategory" name="prodCategory">
				<?php loadFormCategories($db, $result['idCategoria']); ?>
			</select>
		</p>
		<p>
			<label>Imagem:</label>
			<input type="file" id="prodImg" name="prodImg" accept="image/*">
		</p>
		<p>
			<label>Estoque:</label>
			<input type="text" id="prodQtd" name="prodQtd" value="<?php echo $result['qtdMinEstoque']; ?>">
		</p>
		<p>
			<label>Desconto:</label>
			<input type="text" id="prodDiscount" name="prodDiscount" value="<?php echo $result['descontoPromocao']; ?>">
		</p>
		<p>
			<label>Status:</label>
			<select id="prodStatus" name="prodStatus">
				<option value="1">Ativo</option>
				<option value="0">Inativo</option>
			</select>
		</p>
		<p>
			<label>Cadastrado por: <?php echo checkUserId($db, $result['idUsuario']); ?></label>
		</p>
		<p>
			<input type="submit" value="Salvar Alterações">
		</p>
		<a href="produtos/">Back</a>
	</form>
	
</body>
</html>