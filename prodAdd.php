<?php
	include "functions.php";
	if(!isset($_SESSION['user'])) header("Location: login/");
	function checkUserId($db, $userId) {
		$query = odbc_exec($db, "SELECT nomeUsuario FROM Usuario WHERE idUsuario = '$userId'");
		$result = odbc_fetch_array($query);
		return $result['nomeUsuario'];
	}
	function loadCatedories($db) { 
		$query = odbc_exec($db, "SELECT idCategoria, nomeCategoria FROM Categoria");
		
		while($result = odbc_fetch_array($query)) {
			echo "<option value='" . $result['idCategoria'] . "'>" . $result['nomeCategoria'] . "</option>";
		}
	}
	$msg = "";
	//INSERT
	if((isset($_GET['save'])) && ($_GET['save'] == "true")) {			
		$name = $_POST['prodName'];
		$description = $_POST['prodDescription'];
		$price = $_POST['prodPrice'];
		$discount = $_POST['prodDiscount'];
		$idCategory = $_POST['prodCategory'];
		$status = $_POST['prodStatus'];	
		$userId = getSessionUserId();
		$qtd = $_POST['prodQtd'];
		$image = $_POST['prodImg'];	
		
		odbc_exec($db, "INSERT INTO Produto
							(nomeProduto, 
							descProduto,
							precProduto,
							descontoPromocao,
							idCategoria,
							ativoProduto,
							idUsuario,
							qtdMinEstoque,
							imagem)
						VALUES 
							('$name',
							'$description',
							'$price',
							'$discount',
							'$idCategory',
							'$status',
							'$userId',
							'$qtd',
							'$image')");	
		$msg = "Produto salvo com sucesso!";
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="iso-8959-1">
	<title>Insert</title>

	<style type="text/css">
		* {
			margin: 0;
			padding: 0;
		}
		body {
			background-color: #000;
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
	<form method="POST" action="prodAdd.php?save=true">
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
			<input type="submit" value="Salvar Alterações">
		</p>
	</form>
	
</body>
</html>