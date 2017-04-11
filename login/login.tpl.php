<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../style.css">
    
</head>
<body>
    <h2>Faça login para acessar o sistema</h2>
    <form method="POST">
		<h1>Login</h1>
        <hr>
		<p class="errorMsg"><?php echo $GLOBALS['errorMsg']; ?></p>
		<p>
			<label>Login:</label>
			<input type="text" name="login" required>
		</p>
		<p>
			<label>Senha:</label>
			<input type="password" name="password" required>
		</p>		
		<p>
			<input type="submit" value="Login">
        </p>
        <hr>
        
		<a href="../cadastro" id="cadastroLink">Cadastrar</a>
	</form>
  
</body>
</html>