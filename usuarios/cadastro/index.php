<?php
	include "../../functions.php";
	if(!isset($_SESSION['user'])) header("Location: ../../login/");
	if(isset($_SESSION['type']) && $_SESSION['type'] != "A") header("Location: ../../dashboard/");
	if(isset($_POST['login']) && isset($_POST['senha']) && isset($_POST['nome'])) newUser($db);
	$erro = "";
	if(isset($_GET['error']) && $_GET['error'] == "true") $erro = "Usuário já existe!";
	function newUser($db) {				
		$login = str_replace('"','',$_POST['login']);
		$login = str_replace("'",'',$login);
		$login = str_replace(';','',$login);
			
		$query = odbc_exec($db, "SELECT loginUsuario FROM Usuario WHERE loginUsuario = '$login'");
		$result = odbc_fetch_array($query);

		if(!empty($result['loginUsuario'])) {
			header("Location: ?error=true");	
		}
		else {			
			$nome = preg_replace(	"/[^a-zA-Z0-9 ]+/", 
									"", 
									$_POST['nome']);
			
			$password = str_replace('"','',$_POST['senha']);
			$password = str_replace("'",'',$password);
			$password = str_replace(';','',$password);
			
			$perfil = 	$_POST['perfil'] != 'A' 
						&& $_POST['perfil'] != 'E' 
						? 'E' :	$_POST['perfil'];
			
			$_POST['ativo'] = !isset($_POST['ativo']) ? 0 : $_POST['ativo'];
			$ativo = (bool) $_POST['ativo'];
			$ativo = $ativo === true ? 1 : 0;
			
			if(odbc_exec($db, "	INSERT INTO
									Usuario
									(loginUsuario,
									senhaUsuario,
									nomeUsuario,
									tipoPerfil,
									usuarioAtivo)
								VALUES
									('$login',
									HASHBYTES('SHA1','$password'),
									'$nome',
									'$perfil',
									$ativo)")){
				odbc_close($db);
				header("Location: ../../usuarios/?add=success");				
			}else{
				$GLOBALS["erro"] = "Erro ao cadastrar usuário";
			}
		}
		
	}
	include "signup.tpl.php";
?>