<?php	
	session_start();

	function insertItem() {
		if($db = odbc_connect("pidsn", "", "")) {
			echo "Conectou!<br>";

			$login = $_POST['login'];
			$password = $_POST['password'];
			$email = $_POST['email'];
			$name = $_POST['name'];
			
			//INSERT
			if(odbc_exec($db, "INSERT INTO usuario
								(login, 
								senha,
								email,
								nome)
							VALUES 
								('$login',
								'$password',
								'$email',
								'$name')")) {
									echo "Usuário cadastrado com sucesso!<br>";
								}
			else echo "Erro ao cadastrar usuário<br>";
			
		}
		else echo "Erro ao conectar ao banco!";
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
			if(isset($_POST['login'])) $login = $_POST['login'];
			if(isset($_POST['password'])) $password = $_POST['password'];
			if($db = odbc_connect("pidsn", "", "")) {
				$query = odbc_exec($db, "SELECT * FROM usuario");
				$isLoggedIn = false;
				while($result = odbc_fetch_array($query)) {
					if(($login == $result['login']) && ($password == $result['senha'])) {
						$isLoggedIn = true;
						$_SESSION['user'] = $result['nome'];
						break;
					}				
				}				
			}
			if(!$isLoggedIn) header("Location: login.php");
		}		
	}

	function logOut() {
		if(isset($_GET['session'])) {
			$escolha = $_GET['session'];
			if($escolha == "finish")
				session_destroy();
		}
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