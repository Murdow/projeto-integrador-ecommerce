<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <title>Usuários</title>
	<link rel="stylesheet" type="text/css" href="../testeestilo.css">
    <style type="text/css">
    	body {
			background-color: #a5acaf;
		}
		#pageHeader {
			background-color: #002244;
		}
		#pageHeader img {
			width: 150px;
		}
		td {
    		text-align: left!important;
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
    	form {
    		display: inline-block;
    	}
    	#actionMsg {
			color: green;
			font-weight: bold;
			text-align: center;
		}
		#pradNavigation {
			text-align: center;
			width: 100%;
		}
		#btnContainer {
			margin-top: 20px;
			padding-right: 60px;
			text-align: right;
		}
		#addNew {
			background-color: #002244;
			border-radius: 2px;
			color: #69be28;
			padding: 5px 10px;
			text-decoration: none;
		}
		#addNew:hover {
			background-color: #69be28;
			color: #002244;
			font-weight: bold;
		}
		.edita, .deleta {
			padding: 5px 10px;
			text-align: center;
			text-decoration: none;
		}
		.edita {
			background-color: #69be28;
			color: #002244;
		}
		.deleta {
			background-color: #002244;
			color: #69be28;
		}
    </style>
</head>
<body>

	<div id="wrapper">
		<header id="pageHeader">
			<!--<h1><a href="/loja/dashboard">Dashboard</a></h1>-->
			<img src="../imagems/logo.jpg" alt="logo" title="home">
			
		</header>
		
		<nav id="productsControlNavigation">
			<ul>
				<li><a href="../produtos/">PRODUTOS</a></li>
				<li><a href="../categorias/">CATEGORIAS</a></li>
				<li><a href="../usuarios/">USUARIOS</a></li>
				<li><a href="../login/?session=finish">Sair</a></li>
			</ul>	
		</nav>
    </div>
	<div id="btnContainer">
		 <?php
			if(getSessionUserType() === "A")
				echo "<a id='addNew' href='cadastro/'>Adicionar novo usuário</a>";
		?>
	</div>
   
	<p id="actionMsg"><?php echo $msg; ?></p>
	<table cellspacing='0'>
		<tr>
			<th>Nome</th>
			<th>Tipo</th>
			<th>Status</th>
			<th>Ação</th>
		</tr>
		<?php 
			$query = listUser($db);
			
			while($result = odbc_fetch_array($query)):
		?>
				<tr>
					<td class='textocell'><?php echo $result['nomeUsuario']; ?></td>
					<td class='textocell'><?php echo $result['tipoPerfil']; ?></td>
					<td class='textocell'><?php echo $result['usuarioAtivo']; ?></td>
					<td id='acoes'>
						<?php if($result['idUsuario'] > 1 && getSessionUserType() === "A"): ?>
							<a class='edita' href="editar/?id=<?php echo $result['idUsuario']; ?>">Edit</a>
							<a class='deleta' href="?action=delete&id=<?php echo $result['idUsuario']; ?>">Delete</a>
						<?php endif; ?>
					</td>
				</tr>
			<?php endwhile; odbc_close($db);?>
	</table>
	
</body>
</html>