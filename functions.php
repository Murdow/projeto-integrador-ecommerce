<?php	
	session_start();
	include('db/index.php');
	$errorMsg = '';

	function newUser($db) {			
		$password = checkFormInputs('password');
		$login = checkFormInputs('email');
		$name = checkFormInputs('name');

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
			$query = odbc_exec($db, "SELECT * FROM Produto WHERE nomeProduto = '$searchByName'");
		}
		elseif(isset($_GET['searchByCategory'])) {
			$searchByCategory = $_GET['searchByCategory'];
			$query = odbc_exec($db, "SELECT * FROM Produto WHERE idCategoria = '$searchByCategory'");
		}
		elseif(isset($_GET['sort'])) {
			if($_GET['sort'] == "1")
				$query = odbc_exec($db, "SELECT * FROM Produto ORDER BY precProduto ASC");
			elseif($_GET['sort'] == "2")
				$query = odbc_exec($db, "SELECT * FROM Produto ORDER BY precProduto DESC");
			elseif($_GET['sort'] == "3")
				$query = odbc_exec($db, "SELECT * FROM Produto ORDER BY qtdMinEstoque ASC");
			elseif($_GET['sort'] == "4")
				$query = odbc_exec($db, "SELECT * FROM Produto ORDER BY qtdMinEstoque DESC");
		}
		else
			$query = odbc_exec($db, "SELECT * FROM Produto");
		
		return $query;
	}

	function detalhesItem($db) {        
		$query = odbc_exec($db, "SELECT * FROM Produtos");
        $result = odbc_fetch_array($query);
        
        $idCateg = $result['idCategoria'];
        $subquery = odbc_exec($db, "SELECT * FROM Categoria WHERE idCategoria=$idCateg");
        $subresult = odbc_fetch_array($subquery);
            
        echo "<table cellspacing='0' class=''>
                <tr>
                    <td class='bold'>Item</td>
                    <td class='textocell'>", $result['nomeProduto'], "</td>
                </tr>
                <tr>
                    <td class='bold'>Preço</td>
                    <td class='textocell'>", $result['preco'], "</td>
                </tr>
                <tr>
                    <td class='bold'>Categoria</td>
                    <td class='textocell'>", $subresult['nameCategoria'], "</td>
                </tr>
                <tr>
                    <td class='bold'>Estoque</td>
                    <td class='textocell'>", $result['quantidade'], "</td>
                </tr>
                <tr>
                    <td class='bold'>Descrição</td>
                    <td class='textocell'>", $result['descricao'], "</td>
                </tr>
                <tr>
                    <td class='bold'>Imagem</td>
                    <td class='textocell'>", $result['imagem'], "</td>
                </tr>";
        
    }
    
    
    function searchItem($db) {		
		$query = odbc_exec($db, "SELECT * FROM Produto");
		echo "<table cellspacing='0' class=''>
				<thead>
					<th>Item</th>
					<th>Preço</th>
					<th>Categoria</th>
                    <th>Ações</th>
                </thead><tbody>";
		while($result = odbc_fetch_array($query)) {
			
           // $idCateg = $result['idCategoria'];
            //$subquery = odbc_exec($db, "SELECT * FROM Categoria WHERE idCategoria=$idCateg");
            //$subresult = odbc_fetch_array($subquery);
            
            echo "<tr>
			        <td>", $result['nomeProduto'], "</td>
			        <td>R$ ", $result['preco'], "</td>
			        <td>", $subresult['nameCategoria'], "</td>
                    <td id='acoes'>
                        <a href='detalhes/?idItem=", $result['idProduto'],"'><div class='detalhes'><p>Detalhes</p></div></a>
                        <a href='inserir/?idItem=", $result['idProduto'],"'><div class='edita'><p>Editar</p></div></a>
                        <div class='deleta'><p>Excluir</p></div>
                                        
                    </td>
			    </tr>";
		}
		echo "</tbody> </table>";		
	}
	
	function logIn($db) {
		if(!isset($_SESSION['user'])) {
			if(isset($_POST['login'])) $login = checkFormInputs('login');
			if(isset($_POST['password'])) $password = checkFormInputs('password');
			
			$query = odbc_exec($db, "SELECT nomeUsuario, idUsuario, tipoPerfil FROM Usuario WHERE loginUsuario = '$login' AND senhaUsuario = '$password'");
			
			$result = odbc_fetch_array($query);

			if(!empty($result['nomeUsuario'])) {
				$_SESSION['user'] = $result['nomeUsuario'];
				$_SESSION['id'] = $result['idUsuario']; // dizer quem cadastrou, chave estrangeira
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
	function checkFormInputs($formText) {
		return str_replace('"','', str_replace("'",'', str_replace(';','', str_replace("\\",'', $_POST[$formText]))));
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
