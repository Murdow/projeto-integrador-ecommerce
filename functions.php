<?php	
	session_start();
	include('db/index.php');
	$errorMsg = '';

	function newUser($db) {			
		$password = fieldValidation($_POST['password']);
		$login = fieldValidation($_POST['email']);
		$name = fieldValidation($_POST['name']);

		$query = odbc_exec($db, "SELECT loginUsuario FROM Usuario WHERE loginUsuario = '$login'");
		$result = odbc_fetch_array($query);

		if(!empty($result['loginUsuario'])) {
			$GLOBALS['errorMsg'] = "Esse login já está cadastrado!";	
		}			
		else {
			odbc_exec($db, "INSERT INTO usuario
								(senha,
								email,
								nome)
							VALUES 
								('$password',
								'$email',
								'$name')");	
			header("Location: ../login");
		}
	}
	function listProducts($db) {
		if(isset($_GET['searchByName'])) {
			$searchByName = $_GET['searchByName'];
			$query = odbc_exec($db, "SELECT idProduto, nomeProduto, precProduto, qtdMinEstoque FROM Produto WHERE nomeProduto = '$searchByName'");
		}
		elseif(isset($_GET['searchByCategory'])) {
			if($_GET['searchByCategory'] != "0") {
				$searchByCategory = $_GET['searchByCategory'];
				$query = odbc_exec($db, "SELECT idProduto, nomeProduto, precProduto, qtdMinEstoque FROM Produto WHERE idCategoria = '$searchByCategory'");
			}
			else $query = odbc_exec($db, "SELECT idProduto, nomeProduto, precProduto, qtdMinEstoque FROM Produto");
		}
		elseif(isset($_GET['sort'])) {
			switch ($_GET['sort']) {
				case '1':
					$query = odbc_exec($db, "SELECT idProduto, nomeProduto, precProduto, qtdMinEstoque FROM Produto ORDER BY precProduto ASC");
					break;
				case '2':
					$query = odbc_exec($db, "SELECT idProduto, nomeProduto, precProduto, qtdMinEstoque FROM Produto ORDER BY precProduto DESC");
					break;
				case '3':
					$query = odbc_exec($db, "SELECT idProduto, nomeProduto, precProduto, qtdMinEstoque FROM Produto ORDER BY qtdMinEstoque ASC");
					break;
				case '4':
					$query = odbc_exec($db, "SELECT idProduto, nomeProduto, precProduto, qtdMinEstoque FROM Produto ORDER BY qtdMinEstoque DESC");
					break;				
				default:
					$query = odbc_exec($db, "SELECT idProduto, nomeProduto, precProduto, qtdMinEstoque FROM Produto");
					break;
			}				
		}
		else
			$query = odbc_exec($db, "SELECT idProduto, nomeProduto, precProduto, qtdMinEstoque FROM Produto");
		
		return $query;
	}
	
	function logIn($db) {
		if(!isset($_SESSION['user'])) {
			if(isset($_POST['login'])) $login = fieldValidation($_POST['login']);
			if(isset($_POST['password'])) $password = fieldValidation($_POST['password']);
			
			$query = odbc_exec($db, "SELECT nomeUsuario, idUsuario, tipoPerfil FROM Usuario WHERE loginUsuario = '$login' AND senhaUsuario = '$password'");
			
			$result = odbc_fetch_array($query);

			if(!empty($result['nomeUsuario'])) {
				$_SESSION['user'] = $result['nomeUsuario'];
				$_SESSION['id'] = $result['idUsuario']; 
				$_SESSION['type'] = $result['tipoPerfil'];
				header("Location: ../dashboard/");
			}
			else $GLOBALS['errorMsg'] = "Email ou Senha Inválidos!";			
		}		
    }

	function logOut() {
		if(isset($_GET['session'])) {
			$escolha = $_GET['session'];
			if($escolha == "finish")
				session_destroy();
		}
	}
	function fieldValidation($value) {
		return str_replace('"','',
				str_replace("'",'',
				str_replace(';','',
				str_replace("\\",'',
				$value))));
	}
	function getSessionUserName() {
		return $_SESSION['user'];
	}
	function getSessionUserId() {
		return $_SESSION['id'];
	}
	function getSessionUserType() {
		return $_SESSION['type'];
	}
	function checkAction($db) {
		
        if(isset($_GET['action'])){
            $action = $_GET['action'];

            switch($action) {
                case "list":
                    searchItem($db);
                    break;
                case "update":
                    updateItem();
                    break;
                case "delete":
                    deleteItem();
                    break;			
            }
        }
	}

?>
