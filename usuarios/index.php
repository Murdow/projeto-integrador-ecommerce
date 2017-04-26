<?php 
	include "../functions.php"; 
	if(!isset($_SESSION['user'])) header("Location: ../login/");

	$msg = "";
	if(isset($_GET['add']) && $_GET['add'] == "success") $msg = "Usuário cadastrado com sucesso!";
	if(isset($_GET['update']) && $_GET['update'] == "success") $msg = "Usuário alterado com sucesso!";
		
	if((isset($_GET['action'])) && ($_GET['action'] == "delete")) {
		if(is_numeric($_GET['id'])) {
			$id = $_GET['id'];
			deleteItem($db, $id);
		}
	}
	function deleteItem($db, $userId) {
		if($query = odbc_exec($db, "DELETE FROM Usuario WHERE idUsuario = '$userId'")) {
			if(odbc_num_rows($query) > 0)
				$GLOBALS['msg'] = "Usuário deletado com sucesso!";
			else
				$GLOBALS['msg'] = "Usuário não existe!";
		}		
	}
	function listUser($db) {
		$query = odbc_exec($db, "SELECT idUsuario, nomeUsuario, tipoPerfil, usuarioAtivo FROM Usuario");
		return $query;
	} 
	include "index.tpl.php";
?>