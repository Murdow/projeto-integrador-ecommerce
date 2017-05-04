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
		#productsControlNavigation {
			background-color: #69be28;
		}
		#productsControlNavigation ul li a {
			color:  #002244;
		}
		#productsControlNavigation ul li a:hover {
			background-color: #002244;
			color: #69be28;
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
			max-width: 300px;
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
		form input[type=text], form input[type=password] {
			background: none;
			border: none;
			border-bottom: solid 1px #fff;
			color: #fff;
			width: 75%;
		}
		form input[type=text]:focus, form input[type=password]:focus {
			outline: none;
		}
		form input[type=submit] {
			background: none;
			border: none;
			border: solid 1px #69be28;
			border-radius: 5px;
			color: #69be28;	
			float: left;
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
	<div id="wrapper">
		<header id="pageHeader">
			<!--<h1><a href="/loja/dashboard">Dashboard</a></h1>-->
			<img src="../../imagems/logo.jpg" alt="logo" title="home">
			
		</header>
		
		<nav id="productsControlNavigation">
			<ul>
				<li><a href="../../produtos/">PRODUTOS</a></li>
				<li><a href="../../categorias/">CATEGORIAS</a></li>
				<li><a href="../../usuarios/">USUARIOS</a></li>
				<li><a href="../../login/?session=finish">Sair</a></li>
			</ul>	
		</nav>
    </div>
	
    <form method="POST">
	<h2>Cadastro</h2>
		<p id="erroMsg"><?php echo $erro; ?></p>
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
			<a id="btnBack" href="../">Cancelar</a>			
		</p>
	</form>
</body>
</html>
