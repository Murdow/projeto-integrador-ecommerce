<!DOCTYPE html>
<html>
<head>
	<title>Cadastro Usuário</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../style.css">
	
	</head>
<body>
	<h1>Cadastro</h1>
    <form method="POST">
		<p><?php echo $erro; ?></p>
		<p>
			<label>Nome: </label>
			<input type="text" name="nome">
		</p>
		<p>
			<label>login: </label>
			<input type="text" name="login">
		</p>
		<p>
			<label>Senha: </label>
			<input type="password" name="senha">
		</p>
		<p>
			<label>Perfil:	</label>
			<select name="perfil">
				<option value="A">Administrador</option>
				<option value="E">Funcionário</option>
			</select>
		</P>
		<p>
			<label>Ativo: </label>
			<input type="checkbox" name="ativo" checked><br><br>
		</p>
		<p>
			<input type="submit" value="Gravar" name="btnNovoUsuario">	
		</p>
	</form>
</body>
</html>
