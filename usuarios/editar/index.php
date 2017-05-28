<?php 
	include "../../functions.php"; 
	if(!isset($_SESSION['user'])) header("Location: ../../login/");
	if(isset($_SESSION['type']) && $_SESSION['type'] != "A") header("Location: ../../dashboard/");

	if(isset($_GET['id'])) {
		if(is_numeric($_GET['id'])) $id = $_GET['id'];
		$query = odbc_exec($db, "SELECT * FROM Usuario WHERE idUsuario = '$id'");
		$result = odbc_fetch_array($query);
	}
	function checkProfileType($type) {
		if(is_numeric($_GET['id'])) $id = $_GET['id'];

		if($type == "A") {
			echo "<option value='" . $result['tipoPerfil'] . "' selected>Administrador</option>";
			echo "<option value='E'>Funcionário</option>";	
		}
		else {
			echo "<option value='" . $result['tipoPerfil'] . "' selected>Funcionário</option>";	
			echo "<option value='A'>Administrador</option>";
		}
	}
	function checkProfileStatus($status) {
		if(is_numeric($_GET['id'])) $id = $_GET['id'];

		if($status == 1) echo "<input type='checkbox' name='status' checked>";
		else echo "<input type='checkbox' name='status'>"; 
	}
	
	$msg = "";
	//UPDATE
	if((isset($_GET['update'])) && ($_GET['update'] == "true")) {			
		if(is_numeric($_POST['id'])) $id = $_POST['id'];		
		//trata nome
			$name = preg_replace(	"/[^a-zA-Z0-9 ]+/", 
									"", 
									$_POST['name']);
			
			$login = str_replace('"','',$_POST['login']);
			$login = str_replace("'",'',$login);
			$login = str_replace(';','',$login);
			
			//trata senha
			$password = str_replace('"','',$_POST['password']);
			$password = str_replace("'",'',$password);
			$password = str_replace(';','',$password);
			
			//trata perfil
			$profile = 	$_POST['profile'] != 'A' 
						&& $_POST['profile'] != 'E' 
						? 'E' :	$_POST['profile'];
			
			//trata ativo
			$_POST['status'] = !isset($_POST['status']) ? 0 : $_POST['status'];
			$status = (bool) $_POST['status'];
			$status = $status === true ? 1 : 0;

		if(odbc_exec($db, "UPDATE Usuario
					   SET
					   loginUsuario = '$login',
					   senhaUsuario = HASHBYTES('SHA1','$password'),
					   nomeUsuario = '$name',
					   tipoPerfil = '$profile',
					   usuarioAtivo = '$status'
					   WHERE
					   idUsuario = $id")) 
			header("Location: ../../usuarios/?update=success");
		else {
			$msg = "Erro ao alterar produto!";
			odbc_close($db);
		}
	}

	include "edit.tpl.php";
?>