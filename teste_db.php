<?php

$db_host = "MATHEUS-PC";
$db_name = "loja";
$user = "TSI";
$password = "SistemasInternet123";
$dsn = "Driver={SQL Server};Server=$db_host;Port=1433;Database=$db_name;";

if ($db = odbc_connect( $dsn, "", "")){
	echo 'Funcionou direitinho<br><br>';
	if(odbc_exec($db, "INSERT INTO USUARIO 
							(email, 
							senha, 
							nome, 
							tipoPerfil)
					VALUES 
							('matheus.kho@gmail.com', 
							'teste123', 
							'galgoabutico', 
							'A')")){
		echo 'Cadastrado com sucesso<br>';
        
        $query = odbc_exec($db, "SELECT * FROM USUARIO ");
        while($result = odbc_fetch_array($query)){
            echo $result['email'], "  ", $result['nome'], "<br>" ;
        }
	}else {
		echo 'usario não cadastrado';
	}
}else{
	echo'deu ruim <br>';
	
}

var_dump($db);
?>