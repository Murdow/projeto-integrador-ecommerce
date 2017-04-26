<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <title>Usuários</title>
	<link rel="stylesheet" type="text/css" href="../testeestilo.css">
    <style type="text/css">
    	td {
    		text-align: left!important;
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
    </style>
</head>
<body>

	<div id="wrapper">
		<header id="pageHeader">
			<h1><a href="/loja/dashboard">Dashboard</a></h1>
			
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
    
	<p id="actionMsg"><?php echo $msg; ?></p>
	<table cellspacing='0'>
		<tr>
			<th>Name</th>
			<th>Type</th>
			<th>Status</th>
			<th>Action</th>
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
						<?php if($result['idUsuario'] > 1): ?>
							<a class='edita' href="#">Edit</a>
							<a class='deleta' href="?action=delete&id=<?php echo $result['idUsuario']; ?>">Delete</a>
						<?php endif; ?>
					</td>
				</tr>
			<?php endwhile; odbc_close($db);?>
	</table>
	
</body>
</html>