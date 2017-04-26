<?php
	include "../functions.php";
	if(isset($_SESSION['user'])) header("Location: ../dashboard/");	
	if(isset($_POST['login']) && isset($_POST['senha']) && isset($_POST['nome'])) newUser($db);
	$erro = "";
	function newUser($db) {			
		//insere novo usuario
		if(isset($_POST['btnNovoUsuario'])){
			//trata nome
			$nome = preg_replace(	"/[^a-zA-Z0-9 ]+/", 
									"", 
									$_POST['nome']);
			
			$login = str_replace('"','',$_POST['login']);
			$login = str_replace("'",'',$login);
			$login = str_replace(';','',$login);
			
			//trata senha
			$password = str_replace('"','',$_POST['senha']);
			$password = str_replace("'",'',$password);
			$password = str_replace(';','',$password);
			
			//trata perfil
			$perfil = 	$_POST['perfil'] != 'A' 
						&& $_POST['perfil'] != 'C' 
						? 'C' :	$_POST['perfil'];
			
			//trata ativo
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
				header("Location: ../login");				
			}else{
				$GLOBALS["erro"] = "Erro ao cadastrar usuário";
			}
		}
	}
	include "cadastro.tpl.php";
?>