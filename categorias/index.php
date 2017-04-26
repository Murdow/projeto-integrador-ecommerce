<?php 
	include "../functions.php"; 
	if(!isset($_SESSION['user'])) header("Location: ../login/");

	$msg = "";
	if(isset($_GET['add']) && $_GET['add'] == "success") $msg = "categoria cadastrado com sucesso!";
	if(isset($_GET['update']) && $_GET['update'] == "success") $msg = "Categoria alterado com sucesso!";
		
	if((isset($_GET['action'])) && ($_GET['action'] == "delete")) {
		if(is_numeric($_GET['id'])) {
			$id = $_GET['id'];
			deleteItem($db, $id);
		}
	}
	function deleteItem($db, $catId) {
		if($query = odbc_exec($db, "DELETE FROM Categoria WHERE idCategoria = '$catId'")) {
			if(odbc_num_rows($query) > 0)
				$GLOBALS['msg'] = "Categoria deletado com sucesso!";
			else
				$GLOBALS['msg'] = "Categoria não existe!";
		}		
	}
	function listCategories($db) {
		$query = odbc_exec($db, "SELECT idCategoria, nomeCategoria, descCategoria FROM Categoria");
		return $query;
	} 
	include "index.tpl.php";
?>