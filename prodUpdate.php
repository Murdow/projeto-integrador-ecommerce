<?php
	include "functions.php";
	if(!isset($_SESSION['user'])) header("Location: login/");
	if(isset($_GET['id'])) {
		$id = $_GET['id'];
		$query = odbc_exec($db, "SELECT * FROM Produto WHERE idProduto = '$id'");
		$result = odbc_fetch_array($query);
	}
	function loadFormCategories($db, $id) { 
		$query = odbc_exec($db, "SELECT idCategoria, nomeCategoria FROM Categoria");
		
		while($result = odbc_fetch_array($query)) {
			if($id == $result['idCategoria'])
				echo "<option value='" . $result['idCategoria'] . "' selected>" . $result['nomeCategoria'] . "</option>";
			else
				echo "<option value='" . $result['idCategoria'] . "'>" . $result['nomeCategoria'] . "</option>";
		}
	}
	function checkUserId($db, $userId) {
		$query = odbc_exec($db, "SELECT nomeUsuario FROM Usuario WHERE idUsuario = '$userId'");
		$result = odbc_fetch_array($query);
		return $result['nomeUsuario'];
	}
	$msg = "";
	//UPDATE
	if((isset($_GET['update'])) && ($_GET['update'] == "true")) {			
		$id = $_POST['prodID'];
		$name = $_POST['prodName'];
		$description = $_POST['prodDescription'];
		$price = $_POST['prodPrice'];
		$discount = $_POST['prodDiscount'];
		$idCategory = $_POST['prodCategory'];
		$status = $_POST['prodStatus'];	
		$userId = getSessionUserId();
		$qtd = $_POST['prodQtd'];
		$image = $_POST['prodImg'];	

		if(odbc_exec($db, "UPDATE Produto
					   SET
					   nomeProduto = '$name',
					   descProduto = '$description',
					   precProduto = '$price',
					   descontoPromocao = '$discount',
					   idCategoria = '$idCategory',
					   ativoProduto = '$status',
					   idUsuario = '$userId',
					   qtdMinEstoque = '$qtd',
					   imagem = '$image'
					   WHERE
					   idProduto = $id")) {
		$msg = "Produto atualizado com sucesso!";
						}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="iso-8959-1">
	<title>Update</title>

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
	<form method="POST" action="prodUpdate.php?id=<?php echo $_GET['id']; ?>&update=true">
		<p id="message"> <?php echo $msg; ?></p>
		<p>
			<label class="id">ID</label>
			<input class="id" type="text" name="prodID" value="<?php echo $result['idProduto']; ?>">
		</p>
		<p>
			<label>Nome:</label>
			<input type="text" id="prodName" name="prodName" value="<?php echo $result['nomeProduto']; ?>">
		</p>
		<p>	
			<label>Preço:</label>
			<input type="text" id="prodPrice" name="prodPrice" value="<?php echo number_format($result['precProduto'], 2, ',', ' '); ?>">
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
		<a href="prodList.php">Back</a>
	</form>
	
</body>
</html>