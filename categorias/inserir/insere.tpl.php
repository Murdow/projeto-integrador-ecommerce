<!DOCTYPE html>
<html>
<head>
	<title>Cadastro Usuário</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../../testeestilo.css">
	
	<style>
		* {
			padding: 0;
			margin: 0;
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
		body {
			background-color: #a5acaf;
		}
		#pageHeader {
			background-color: #002244;
		}
		#pageHeader img {
			width: 150px;
		}
		form {
			margin: 0 auto;
			width: 30%;
		}
		
		h2 {
			background-color: #002244;
			border-bottom: solid 4px #69be28;	
			border-radius: 10px;
			color: #fff;
			padding: 5px 10px 5px 10px;
			font-family: 'Roboto', sans-serif;
			font-weight: 300;
			margin-bottom: 10px;
		}
		form {
			margin-top: 50px;
			max-width: 310px;
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
		#erroMsg {
			background: none;
			color: #cc1100;
			display: inline-block;
			padding-bottom: 10px;
		}
		form input[type=text]{
			background: none;
			border: none;
			border-bottom: solid 1px #fff;
			color: #fff;
			width: 75%;
		}
		form input[type=text]:focus{
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
			padding: 5px 10px;
			font-size:100%;
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
	</style>
	</head>
<body>
	<?php  include("../../menu.in.php")?>
	
    <form method="POST">
	<h2>Criar Categoria</h2>
		<p id="erroMsg"><?php echo $erro; ?></p>
		<p>
			<label>Nome:</label>
			<input type="text" id="name" name="name" required >
		</p>
		<p>	
			<label>Descrição: </label>
			<textarea type="text" id="Description" name="Description"></textarea>
		</p>
		
		<p>
			<input type="submit" value="Salvar" name="btnNovaCategoria">
			<a id="btnBack" href="../">Cancelar</a>			
		</p>
	</form>
</body>
</html>
