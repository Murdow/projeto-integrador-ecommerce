<!DOCTYPE html>
<html>
<head>
	<title>Cadastro Usuário</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../../testeestilo.css">
	<link rel="stylesheet" type="text/css" href="../../userCatFormStyle.css">
	</head>
<body>
	<?php  include("../../menu.in.php"); ?>
	
    <form method="POST">
	<h2>Criar Categoria</h2>
		<p id="erroMsg"><?php echo $erro; ?></p>
		<p>
			<label>Nome:</label>
			<input type="text" id="name" name="name" required >
		</p>
		<p id="description">	
			<label>Descrição: </label>
			<textarea type="text" id="Description" name="Description"></textarea>
		</p>
		
		<p>
			<input type="submit" value="Salvar" name="btnNovaCategoria">
			<a id="btnBack" href="../">Cancelar</a>			
		</p>
	</form>
	<?php include("../../footer.tpl.php") ?>
</body>
</html>
