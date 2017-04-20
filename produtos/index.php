<?php 
	include "../functions.php"; 
	if(!isset($_SESSION['user'])) header("Location: ../login/");

	$msg = "";
	if(isset($_GET['add']) && $_GET['add'] == "success") $msg = "Produto cadastrado com sucesso!";
	if(isset($_GET['update']) && $_GET['update'] == "success") $msg = "Produto alterado com sucesso!";
	function loadSearchCatedories($db) { 
		$query = odbc_exec($db, "SELECT idCategoria, nomeCategoria FROM Categoria");
		
		while($result = odbc_fetch_array($query)) {
			echo "<option value='" . $result['idCategoria'] . "'>" . $result['nomeCategoria'] . "</option>";
		}
	}
	
	if((isset($_GET['action'])) && ($_GET['action'] == "delete")) {
		if(is_numeric($_GET['id'])) {
			$id = $_GET['id'];
			deleteItem($db, $id);
		}
	}
	function deleteItem($db, $prodId) {
		if($query = odbc_exec($db, "DELETE FROM Produto WHERE idProduto = '$prodId'")) {
			if(odbc_num_rows($query) > 0)
				$GLOBALS['msg'] = "Produto deletado com sucesso!";
			else
				$GLOBALS['msg'] = "Produto não existe!";
		}
		
	}

	include "index.tpl.php";
?>