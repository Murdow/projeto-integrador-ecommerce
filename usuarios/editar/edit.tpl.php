<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <title>Editar Usuário</title>
	<link rel="stylesheet" type="text/css" href="../../testeestilo.css">
    <link rel="stylesheet" type="text/css" href="../../userCatFormStyle.css">
</head>
<body>

	<?php include("../../menu.in.php"); ?>
    
    <form method="POST" action="?id=<?php echo $_GET['id']; ?>&update=true">
		<h2>Atualização dos dados</h2>
		<p id="message" class="noBg"> <?php echo $msg; ?></p>
		<p id="idContainer" class="noBg">
			<input class="id" type="hidden" name="id" required value="<?php echo $result['idUsuario']; ?>">
		</p>
		<p>
			<label>Nome:</label>
			<input type="text" id="name" name="name" required value="<?php echo $result['nomeUsuario']; ?>">
		</p>
		<p>	
			<label>login: </label>
			<input type="text" id="login" name="login" required value="<?php echo $result['loginUsuario']; ?>">
		</p>
		<p>
			<label>Senha: </label>
			<input type="password" id="password" name="password" required value="">
		</p>
		<p>
			<label>Perfil:	</label>
			<select name="profile">
				<?php checkProfileType($result['tipoPerfil']); ?>
			</select>
		</P>
		<p>
			<label>Ativo: </label>
			<?php checkProfileStatus($result['usuarioAtivo']); ?>
		</p>
		<p>
			<input type="submit" value="Salvar Alterações">
			<a id="btnBack" href="../">Cancelar</a>
		</p>
		
	</form>
	<?php include("../../footer.tpl.php") ?>
</body>
</html>