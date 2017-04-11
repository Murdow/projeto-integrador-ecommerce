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
		<p class="errorMsg"><?php echo $errorMsg; ?></p>
		<p>
			<label for="email">Email:</label>
			<input type="text" name="login" id="email" required>
		</p>
		<p>
			<label for="password">Senha:</label>
			<input type="password" name="password" id="password" required>
		</p>		
		<p>
			<input type="submit" value="Login">
        </p>
        <hr>
        
		<a href="../cadastro" id="cadastroLink">Cadastrar</a>
	</form>
   
</body>
</html>
