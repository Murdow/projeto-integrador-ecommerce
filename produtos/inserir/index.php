<?php 
	include "../../functions.php"; 
	if(!isset($_SESSION['user'])) header("Location: ../../login/");

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
		
		if(odbc_exec($db, "INSERT INTO Produto
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
							'$image')"))	
			header("Location: ../index.php?add=success");
		else $msg = "Erro ao inserir produto!";
	}

	include "index.tpl.php";
?>