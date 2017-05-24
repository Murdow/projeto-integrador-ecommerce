<?php 
	include "../../functions.php"; 
	if(!isset($_SESSION['user'])) header("Location: ../../login/");

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
		if(is_numeric($_POST['prodID'])) $id = $_POST['prodID'];		
		$name = fieldValidation($_POST['prodName']);
		$description = fieldValidation($_POST['prodDescription']);
		$price = fieldValidation($_POST['prodPrice']);
		$discount = fieldValidation($_POST['prodDiscount']);
		$idCategory = $_POST['prodCategory'];
		$status = $_POST['prodStatus'];	
		$userId = getSessionUserId();
		$qtd = fieldValidation($_POST['prodQtd']);
		$image = $_POST['prodImg'];	
		$price = str_replace(",", ".", $price);
		$discount = str_replace(",", ".", $discount);

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
					   idProduto = $id")) 
			header("Location: ../../produtos/?update=success");
		else {
			$msg = "Erro ao alterar produto!";
			odbc_close($db);
		}
	}

	include "edit.tpl.php";
?>