<?php	
	session_start();
	$errorMsg = '';
    $db_host = "MATHEUS-PC";
    $db_name = "loja"; 
    $dsn = "Driver={SQL Server};Server=$db_host;Port=1433;Database=$db_name;";

	function newUser($dsn) {
		if($db = odbc_connect($dsn, "", "")) {
			
            $login = checkFormInputs('email');
			$password = checkFormInputs('password');
			$passconfirm = checkFormInputs('passconfirm');
            $name = checkFormInputs('name');

            if ($password == $passconfirm){

                $query = odbc_exec($db, "SELECT login FROM usuario WHERE login = '$login'");
                $result = odbc_fetch_array($query);

                if(!empty($result['login'])) {
                    $GLOBALS['errorCadastro'] = "Esse login já está cadastrado!";	
                
                }else{
                    odbc_exec($db, "INSERT INTO usuario
                                        (senha,
                                        login,
                                        nome, 
                                        tipoPerfil)
                                    VALUES 
                                        ('$password',
                                        '$login',
                                        '$name', 
                                        'F')");	
                    header ('location: ../login/?cadastro=sucesso');
                    }
            }else {$GLOBALS['errorCadastro'] = "Erro. As senhas não coincidem!"; }
        }else $GLOBALS['errorCadastro'] = "Erro ao cadastrar usuário!";
	}

    function erroCadastro(){
        if (isset($GLOBALS['errorCadastro'])) echo $GLOBALS['errorCadastro'];
    }

    function searchUser($dsn) {
		if($db = odbc_connect($dsn, "", "")) {
			$query = odbc_exec($db, "SELECT * FROM Usuario");
			echo "<table cellspacing='0' class=''>
					<thead>
						<th>Nome</th>
						<th>Login</th>
						<th>Ações</th>
                    </thead><tbody>";
			while($result = odbc_fetch_array($query)) {
				
               
                              
                echo "<tr>
				        <td>", $result['nome'], "</td>
				        <td>", $result['login'], "</td>
				        <td id='acoes'>
                            <a href='inserir/?idItem=", $result['idProduto'],"'><div class='edita'><p>Editar</p></div></a>
                            <div class='deleta'><p>Excluir</p></div>
                                            
                        </td>
				    </tr>";
			}
			echo "</tbody> </table>";
		}
	}

	function detalhesItem($dsn) {
        if($db = odbc_connect($dsn, "", "")) {
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
    
    
    function searchItem($dsn) {
		if($db = odbc_connect($dsn, "", "")) {
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

	function updateItem($dsn) {
		if($db = odbc_connect($dsn,"","")) {
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

	function deleteItem($dsn) {
		if($db = odbc_connect($dsn,"","")) {				
			if(odbc_exec($db, "DELETE FROM Produtos
							   WHERE
							   loginUsuario = '1234@gmail.com'")) {
				echo "Usuário deletado com sucesso!<br>";
								}
			else echo "Erro ao deletar usuário";			
		}
		else echo "Não Conectou!";
	}
	
	function logIn($dsn) {
		
        if(isset($_POST['login']) && isset($_POST['password'])){
	
	       $login = checkFormInputs('login');	
	       $password = checkFormInputs('password');
            
	       if($db = odbc_connect($dsn, "", "")) {
               $query = odbc_exec($db, "SELECT nome FROM USUARIO WHERE login = '$login' AND senha = '$password'");
            
               $result = odbc_fetch_array($query);

	
               if  (!empty($result['nome'])){
                   $_SESSION['user'] = $result['nome'];
                   header("Location: ../dashboard/index.php");
               }else{
                   $GLOBALS['errorMsg'] = "Email ou Senha Inválidos!";
               } 
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
		return str_replace('"','', str_replace("'",'', str_replace(';','', str_replace("\\",'', str_replace("/",'', $_POST[$formText])))));
	}
	function getSessionUserName() {
		return $_SESSION['user'];
	}
	function checkAction($dsn) {
		
        if(isset($_GET['action'])){
            $action = $_GET['action'];

            switch($action) {
                case "list":
                    searchItem($dsn);
                    break;
                case "update":
                    updateItem($dsn);
                    break;
                case "delete":
                    deleteItem($dsn);
                    break;			
            }
        }
	}

?>