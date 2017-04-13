<?php
	$db_host = "delta-pi.database.windows.net";
    $db_name = "delta"; 
    $db_login = "TSI";
    $db_pwd = "SistemasInternet123";
    $dsn = "Driver={SQL Server};Server=$db_host;Port=1433;Database=$db_name;";

    if(!$db = odbc_connect($dsn, $db_login, $db_pwd)){
		echo "Não foi possível acessar o banco de dados";
		exit;
	}
?>