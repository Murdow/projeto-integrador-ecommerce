<?php	
	session_start();
	$errorMsg = '';

	function newUser() {
		if($db = odbc_connect("pidsn", "", "")) {
			
			$login = checkFormInputs('login');
			$password = checkFormInputs('password');
			$email = checkFormInputs('email');
			$name = checkFormInputs('name');

			$query = odbc_exec($db, "SELECT login FROM usuario WHERE login = '$login'");
			$result = odbc_fetch_array($query);

			if(!empty($result['login'])) {
				$GLOBALS['errorMsg'] = "Esse login já está cadastrado!";	
			}			
			else {
				odbc_exec($db, "INSERT INTO usuario
									(login, 
									senha,
									email,
									nome)
								VALUES 
									('$login',
									'$password',
									'$email',
									'$name')");	
				header("Location: ../login/index.php");
			}
		}
		else echo "Erro ao cadastrar usuário!";
	}

	function searchItem() {
		if($db = odbc_connect("pidsn", "", "")) {
			$query = odbc_exec($db, "SELECT * FROM usuario");
			echo "<table cellspacing='0'>
					<tr>
						<th>Login</th>
						<th>Senha</th>
						<th>E-mail</th>
						<th>Nome</th>
					</tr>";
			while($result = odbc_fetch_array($query)) {
				echo "<tr>";
					echo "<td>".$result['login']."</td>";
					echo "<td>".$result['senha']."</td>";
					echo "<td>".$result['email']."</td>";
					echo "<td>".$result['nome']."</td>";
				echo "</tr>";
			}
			echo "</table>";
		}
	}

	function updateItem() {
		if($db = odbc_connect("pidsn","","")) {
			if(odbc_exec($db, "UPDATE Usuario
						   SET
						   loginUsuario = '1234@gmail.com',
						   tipoPerfil = 'X'
						   WHERE
						   loginUsuario = 'khjkhjk@gmail.com'")) {
			echo "Usuário atualizado com sucesso!<br>";
							}
		else echo "Erro ao atualizar usuário";		
		}
	}

	function deleteItem() {
		if($db = odbc_connect("pidsn","","")) {				
			if(odbc_exec($db, "DELETE FROM Usuario
							   WHERE
							   loginUsuario = '1234@gmail.com'")) {
				echo "Usuário deletado com sucesso!<br>";
								}
			else echo "Erro ao deletar usuário";			
		}
		else echo "Não Conectou!";
	}
	
	function logIn() {
		if(!isset($_SESSION['user'])) {
			if(isset($_POST['login'])) $login = checkFormInputs('login');
			if(isset($_POST['password'])) $password = checkFormInputs('password');
			if($db = odbc_connect("pidsn", "", "")) {
				$query = odbc_exec($db, "SELECT nome FROM usuario WHERE login = '$login' AND senha = '$password'");
				
				$result = odbc_fetch_array($query);

				if(!empty($result['nome'])) {
					$_SESSION['user'] = $result['nome'];
					header("Location: ../dashboard/index.php");
				}
				else $GLOBALS['errorMsg'] = "Email ou Senha Inválidos!";				
			}
		}		
	}

	function logOut() {
		if(isset($_GET['session'])) {
			$escolha = $_GET['session'];
			if($escolha == "finish")
				session_destroy();
		}
	}
	function checkFormInputs($formText) {
		return str_replace('"','', str_replace("'",'', str_replace(';','', str_replace("\\",'', $_POST[$formText]))));
	}
	function getSessionUserName() {
		return $_SESSION['user'];
	}
	function checkAction() {
		$action = $_GET['action'];

		switch($action) {
			case "list":
				searchItem();
				break;
			case "update":
				updateItem();
				break;
			case "delete":
				deleteItem();
				break;			
		}
	}
?>