<?php	
	session_start();
	include('db/index.php');
	$errorMsg = '';
	
	function listProducts($db) {
		$query_base = "SELECT idProduto, nomeProduto, precProduto, qtdMinEstoque FROM Produto";
		$order_name = "ORDER BY nomeProduto";
		if(isset($_GET['searchByName'])){
			$searchByName = $_GET['searchByName'];
			$search_name = "nomeProduto LIKE '%".$searchByName."%'";
		}else{
			$msg= "Erro, nome inválido inválido!";
		}
		if(isset($_GET['searchByCategory']) && $_GET['searchByCategory'] != "0") {
			$searchByCategory = $_GET['searchByCategory'];
			$searchCategory = "idCategoria = '$searchByCategory'";
		}else{
			$msg= "Erro, categoria inválido!";
		}
		if(isset($_GET['sort']) && $_GET['sort'] >= 1 && $_GET['sort'] <= 4){
			$sortby = $_GET['sort'];
			$msg= "Erro, organizador inválido!";
		}else{
			$msg= "Erro, organizador inválido!";
		}
		
		//REALIZA AS PESQUISAS COM OS FILTROS COMBINADOS//
		if(isset($sortby)) {
			if(isset($_GET['searchByName'])){
				if(isset($_GET['searchByName']) && isset($searchByCategory)){
					//==========  TODOS OS FILTROS  =============//
					switch ($_GET['sort']) {
						case '1':
							$query = odbc_exec($db, "$query_base WHERE $search_name AND $searchCategory ORDER BY precProduto ASC");
							break;
						case '2':
							$query = odbc_exec($db, "$query_base WHERE $search_name AND $searchCategory ORDER BY precProduto DESC");
							break;
						case '3':
							$query = odbc_exec($db, "$query_base WHERE $search_name AND $searchCategory ORDER BY qtdMinEstoque ASC");
							break;
						case '4':
							$query = odbc_exec($db, "$query_base WHERE $search_name AND $searchCategory ORDER BY qtdMinEstoque DESC");
							break;
					}//===================================//
				}else {
					//============= SELETOR E NOME =============//
					switch ($_GET['sort']) {
						case '1':
							$query = odbc_exec($db, "$query_base WHERE $search_name ORDER BY precProduto ASC");
							break;
						case '2':
							$query = odbc_exec($db, "$query_base WHERE $search_name ORDER BY precProduto DESC");
							break;
						case '3':
							$query = odbc_exec($db, "$query_base WHERE $search_name ORDER BY qtdMinEstoque ASC");
							break;
						case '4':
							$query = odbc_exec($db, "$query_base WHERE $search_name ORDER BY qtdMinEstoque DESC");
							break;
					}//===================================//
				}
			}elseif(isset($searchByCategory)){
				//============= SELETOR E CATEGORIA =============//
				switch ($_GET['sort']) {
					case '1':
						$query = odbc_exec($db, "$query_base WHERE $searchCategory ORDER BY precProduto ASC");
						break;
					case '2':
						$query = odbc_exec($db, "$query_base WHERE $searchCategory ORDER BY precProduto DESC");
						break;
					case '3':
						$query = odbc_exec($db, "$query_base WHERE $searchCategory ORDER BY qtdMinEstoque ASC");
						break;
					case '4':
						$query = odbc_exec($db, "$query_base WHERE $searchCategory ORDER BY qtdMinEstoque DESC");
						break;
				}//===================================//
			}else{
				//============= SOMENTE SELETOR =============//
				switch ($_GET['sort']) {
					case '1':
						$query = odbc_exec($db, "$query_base ORDER BY precProduto ASC");
						break;
					case '2':
						$query = odbc_exec($db, "$query_base ORDER BY precProduto DESC");
						break;
					case '3':
						$query = odbc_exec($db, "$query_base ORDER BY qtdMinEstoque ASC");
						break;
					case '4':
						$query = odbc_exec($db, "$query_base ORDER BY qtdMinEstoque DESC");
						break;				
				}//===================================//
			}			
		}elseif(isset($_GET['searchByName'])){
			if(isset($_GET['searchByName']) && isset($searchByCategory)) {
				//============= NOME E CATEGORIA =============//
				$query = odbc_exec($db, "$query_base WHERE $search_name AND $searchCategory $order_name");
				//===================================//
			}else{			
				//============= SOMENTE NOME =============//
				$query = odbc_exec($db, "$query_base WHERE $search_name $order_name");
				//===================================//
			}
		}
		elseif(isset($searchByCategory)) {
			//============= SOMENTE CATEGORIA =============//
			$query = odbc_exec($db, "$query_base WHERE idCategoria = '$searchByCategory' $order_name");
			//===================================//
		}else{
			//============= NENHUM FILTRO =============//
			$query = odbc_exec($db, "$query_base $order_name");
			//===================================//
		}
		return $query;
		//======================== FIM DOS FILTROS COMBINADOS =======================//
	}	
	
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
