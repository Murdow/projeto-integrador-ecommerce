<!DOCTYPE html>
<html>
<head>
	<title>Cadastro Usuário</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../style.css">
	
	</head>
<body>
	<h1>Cadastre-se para acessar o sistema</h1>
    <form method="POST">
		<h2>Cadastro</h2>
		<hr>
        <p>
			<label for="name">Nome do Usuário:</label>
			<input type="text" name="name" id="name">
		</p>
        <p>
			<label for="email">E-Mail:</label>
			<input type="text" name="email" id="email" required>
			<span class='fieldError'><?php echo $errorMsg; ?></span>
		</p>
		<p>
			<label id="password">Senha:</label>
			<input type="password" name="password" id="password">
		</p>
		<p>
			<label for="confPwd">Confirmar Senha:</label>
			<input type="password" name="confPwd" id="confPwd">			
		</p>
		<p>
			<input type="submit" value="Enviar">
		</p>
        <hr>
        <a href="../login" id="cadastroLink">Voltar</a>
	</form>
</body>
</html>
