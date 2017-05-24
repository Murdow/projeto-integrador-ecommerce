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
	
	//Pesquisas combinadas
		
		//===EXIBE ERROS===//
		if(isset($_GET['searchByCategory'])){
			if(isset($_GET['searchByCategory']) && $_GET['searchByCategory'] != "0") {
			}else{
				$msg= "Selecione uma categoria válida!";
			}
		}
		if(isset($_GET['sort'])){
			if(isset($_GET['sort']) && $_GET['sort'] >= 1 && $_GET['sort'] <= 4){
			}else{
				$msg= "Selecione um organizador válido!";
			}
		}
		//==================//
		
		//barra de pesquisa//
		if(isset($_GET['searchByName'])&& isset($_GET['tipoA'])){
			if($_GET['tipoA']=1){
				$tipo = 1;
				$pesquisa = $_GET['searchByName'];
			}
		}elseif(isset($_GET['searchByName'])){
			$pesquisa = $_GET['searchByName'];
			$tipo = 2;
		}else{
			$pesquisa = null;
		}
		
		function comboA($pesquisa){
			if(isset($pesquisa)){
				echo "<input type='hidden' name='searchByName' value='$pesquisa'>";
			}
		}
		//===========================//
		
		//Menu categorias//
		if(isset($_GET['searchByCategory'])&& isset($_GET['tipoB'])){
			if($_GET['tipoB']=1){
				$tipo = 1;
				$pesquisaB = $_GET['searchByCategory'];
			}
		}elseif(isset($_GET['searchByCategory'])) {
			$pesquisaB = $_GET['searchByCategory'];
			$tipo = 2;
		}else{
			$pesquisaB = null;
		}
		
		function comboB($pesquisaB){
			if(isset($pesquisaB)){
				echo "<input type='hidden' name='searchByCategory' value='$pesquisaB'>";
			}
		}
		//===========================//
	
		//Menu do seletor//
		if(isset($_GET['sort'])&& isset($_GET['tipoC'])){
			if($_GET['tipoC']=1){
				$tipo = 1;
				$pesquisaC = $_GET['sort'];
			}
		}elseif(isset($_GET['sort'])){
			$pesquisaC = $_GET['sort'];
			$tipo = 2;
		}else {
			$pesquisaC = null;
		}
			
		function comboC($pesquisaC){
			if(isset($pesquisaC)){
				echo "<input type='hidden' name='sort' value='$pesquisaC'>";
			}
		}	
		//==========================//
	//Fim das pesquisas combinadas
	
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
	include "products.tpl.php";
?>