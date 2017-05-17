<?php 
	include "../../functions.php"; 
	if(!isset($_SESSION['user'])) header("Location: ../../login/");

	ini_set ('odbc.defaultlrl', 9000000);//muda configuração do PHP para trabalhar com imagens no DB

	if(isset($_GET['id'])) {
		$id = $_GET['id'];
		$query = odbc_exec($db, "SELECT nomeProduto, descProduto, precProduto, descontoPromocao, idCategoria, ativoProduto, idUsuario, qtdMinEstoque, imagem FROM Produto WHERE idProduto = '$id'");
		$result = odbc_fetch_array($query);
		odbc_longreadlen($query, 2000000);
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
		$price = str_replace(",", ".", $price);
		$discount = str_replace(",", ".", $discount);

		if($stmt = odbc_prepare($db, "UPDATE Produto SET
									 nomeProduto=?,
									 descProduto=?,
									 precProduto=?,
									 descontoPromocao=?,
									 idCategoria=?,
									 ativoProduto=?,
									 idUsuario=?,
									 qtdMinEstoque=?
									 WHERE
									 idProduto = '$id'")) {
			odbc_execute($stmt, array($name, $description, $price, $discount, $idCategory, $status, $userId, $qtd));

			if(isset($_FILES['prodImg']) && !empty($_FILES['prodImg']['name'])) {		
				$file = fopen($_FILES['prodImg']['tmp_name'],'rb');
				$fileParaDB = fread($file, filesize($_FILES['prodImg']['tmp_name']));
				fclose($file);
				
				$stmt = odbc_prepare($db,"UPDATE Produto SET
												imagem=?
												WHERE
												idProduto = '$id'");	
				odbc_execute($stmt, array($fileParaDB));
			}
			odbc_close($db);

			header("Location: ../../produtos/?update=success");
		}
		else {
			$msg = "Erro ao alterar produto!";
			odbc_close($db);
		}
	}

	include "edit.tpl.php";
?>