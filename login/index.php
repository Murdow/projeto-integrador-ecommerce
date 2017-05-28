<?php
	include ("../functions.php");
	logOut();
	if(isset($_SESSION['user'])) header("Location: ../dashboard");
	if(isset($_POST['login']) && isset($_POST['password'])) logIn($db);

	function logIn($db) {
		if(!isset($_SESSION['user'])) {
			if(isset($_POST['login'])) $login = fieldValidation($_POST['login']);
			if(isset($_POST['password'])) $password = fieldValidation($_POST['password']);
			
			$query = odbc_exec($db, "SELECT nomeUsuario, idUsuario, tipoPerfil FROM Usuario WHERE loginUsuario = '$login' AND senhaUsuario = HASHBYTES('SHA1','$password')");
			
			$result = odbc_fetch_array($query);

			if(!empty($result['nomeUsuario'])) {
				$_SESSION['user'] = $result['nomeUsuario'];
				$_SESSION['id'] = $result['idUsuario']; 
				$_SESSION['type'] = $result['tipoPerfil'];
				header("Location: ../dashboard/");
			}
			else $GLOBALS['errorMsg'] = "Email ou Senha Inválidos!";			
		}	
		odbc_close($db);
    }

    function logOut() {
		if(isset($_GET['session'])) {
			$escolha = $_GET['session'];
			if($escolha == "finish")
				session_destroy();
		}
	}

	include "login.tpl.php";

?>
