<?php	
	session_start();
	include('../db/index.php');
	$errorMsg = '';

<<<<<<< HEAD
	function newUser($db) {			
		$password = checkFormInputs('password');
		$login = checkFormInputs('email');
		$name = checkFormInputs('name');

		$query = odbc_exec($db, "SELECT loginUsuario FROM Usuario WHERE loginUsuario = '$login'");
		$result = odbc_fetch_array($query);
=======
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
		else echo "Erro ao cadastrar usuário!";
	}

	function detalhesItem() {
        if($db = odbc_connect("pidsn", "", "")) {
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
    }
    
    
    function searchItem() {
		if($db = odbc_connect("pidsn", "", "")) {
			$query = odbc_exec($db, "SELECT * FROM Produtos");
			echo "<table cellspacing='0' class=''>
					<thead>
						<th>Item</th>
						<th>Preço</th>
						<th>Categoria</th>
                        <th>Ações</th>
                    </thead><tbody>";
			while($result = odbc_fetch_array($query)) {
				
                $idCateg = $result['idCategoria'];
                $subquery = odbc_exec($db, "SELECT * FROM Categoria WHERE idCategoria=$idCateg");
                $subresult = odbc_fetch_array($subquery);
                
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
	}
>>>>>>> origin/dev

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
<<<<<<< HEAD
			
			$query = odbc_exec($db, "SELECT nomeUsuario, idUsuario, tipoPerfil FROM Usuario WHERE loginUsuario = '$login' AND senhaUsuario = '$password'");
			
			$result = odbc_fetch_array($query);

			if(!empty($result['nomeUsuario'])) {
				$_SESSION['user'] = $result['nomeUsuario'];
				$_SESSION['id'] = $result['idUsuario']; // dizer quem cadastrou, chave estrangeira
				$_SESSION['type'] = $result['tipoPerfil'];
				header("Location: ../dashboard/");
=======
			if($db = odbc_connect("pidsn", "", "")) {
 -				$query = odbc_exec($db, "SELECT nome FROM usuario WHERE login = '$login' AND senha = '$password'");
 -				
 -				$result = odbc_fetch_array($query);
 -
 -				if(!empty($result['nome'])) {
 -					$_SESSION['user'] = $result['nome'];
 -					header("Location: ../dashboard/index.php");
 -				}
 -				else $GLOBALS['errorMsg'] = "Email ou Senha Inválidos!";
>>>>>>> origin/dev
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
<<<<<<< HEAD
	function getSessionUserId() {
		return $_SESSION['id'];
	}
	function getSessionUserType() {
		return $_SESSION['type'];
	}
	function checkAction($db) {
=======
	function checkAction() {
>>>>>>> origin/dev
		
        if(isset($_GET['action'])){
            $action = $_GET['action'];

            switch($action) {
                case "list":
<<<<<<< HEAD
                    searchItem($db);
=======
                    searchItem();
>>>>>>> origin/dev
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
