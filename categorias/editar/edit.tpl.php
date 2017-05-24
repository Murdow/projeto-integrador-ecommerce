<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <title>Editar Usuário</title>
	<link rel="stylesheet" type="text/css" href="../../testeestilo.css">
    <style type="text/css">

		
		form {
			box-sizing: border-box;
			margin: 0 auto;
			padding: 20px;
			max-width: 350px;
		}
		form label {
			color: #fff;
			margin-right: 10px;
			width: 10%;
		}
		form p {
			background-color: #002244;
			border-radius: 10px;
			margin-bottom: 10px;
			padding: 5px 10px 5px 10px;
		}
		textarea {
			height: 200px;
			width: 190px;
			background: #3d5f81;
			border: none;
			border-bottom: solid 1px #fff;
			color: #fff;
		}
		textarea:focus {
			outline: none;
			border-bottom: solid 1px #69be28;
		}
		
		form input[type=text]{
			background: none;
			border: none;
			border-bottom: solid 1px #fff;
			color: #fff;
			width: 75%;
		}
		form input[type=text]:focus {
			outline: none;
			border-bottom: solid 1px #69be28;
		}
		form input[type=submit] {
			background: none;
			border: none;
			border: solid 1px #69be28;
			border-radius: 5px;
			color: #69be28;	
			float: left;
			font-size:100%;
			padding: 5px 10px;
		}
		form p:last-child:before, form p:last-child:after {
			content: "";
			display: table;
			clear: both;
		}
		form input[type=submit]:hover {
			background-color: #69be28;	
			color: #002244;
			cursor: pointer;
		}
		#updateSuccess {
			color: red;
		}
		p {		
			margin-bottom: 10px;
			padding-bottom: 10px;
		}
		.id {
			display: none;
		}
		#message {
			background: none;
			color: red;
			font-weight: bolder;
			text-align: center;
		}
		#btnBack {
			background: none;
			border: none;
			border: solid 1px #69be28;
			border-radius: 5px;
			color: #69be28;
			float: right;
			padding: 5px 10px;
			text-decoration: none;
		}
		#btnBack:hover {
			background-color: #69be28;	
			color: #002244;
		}
		#idContainer {
			background: none;
		}
		h2 {
			color: #002244;
			font-size: 25px;
			font-weight: bold;
			text-align: center;
		}
	</style>
</head>
<body>
	<?php  include("../../menu.in.php")?>
    
    <form method="POST" action="?id=<?php echo $_GET['id']; ?>&update=true">
		<h2>Atualização dos dados</h2>
		<p id="message"> <?php echo $msg; ?></p>
		<p id="idContainer">
			<input class="id" type="hidden" name="id" required value="<?php echo $result['idCategoria']; ?>">
		</p>
		<p>
			<label>Nome:</label>
			<input type="text" id="name" name="name" required value="<?php echo $result['nomeCategoria']; ?>">
		</p>
		<p>	
			<label>Descrição: </label>
			<textarea type="text" id="Description" name="Description"><?php echo $result['descCategoria']; ?></textarea>
		</p>
		
		<p>
			<input type="submit" value="Salvar Alterações">
			<a id="btnBack" href="../">Cancelar</a>
		</p>
		
	</form>
	
</body>
</html>