<!DOCTYPE html>
<html>
<head>
	<title>Cadastro Usuário</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../style.css">
	
	</head>
<body>
	<h2>Cadastre-se para acessar o sistema</h2>
    <form method="POST">
		<h1>Cadastro</h1>
		<hr>
        <p>
			<label>Nome do Usuário:</label>
			<input type="text" name="name">
		</p>
        <p>
			<label>Login:</label>
			<input type="text" name="email" required>
			<span class='fieldError'><?php echo $errorMsg; ?></span>
		</p>
		<p>
			<label>Senha:</label>
			<input type="password" name="password">
		</p>
		<p>
			<label>Confirmar Senha:</label>
			<input type="password" name="password">			
		</p>
		<p>
			<input type="submit" value="Enviar">
		</p>
        <hr>
        <a href="../login" id="cadastroLink">Voltar</a>
	</form>
</body>
</html>