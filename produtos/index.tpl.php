<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <title>List</title>
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
				<li><a href="../categorias/?action=update">CATEGORIAS</a></li>
				<li><a href="../usuario/?action=delete">USUARIOS</a></li>
				<li><a href="../login/?session=finish">Sair</a></li>
			</ul>	
		</nav>
    </div>
    
    <nav id="pradNavigation">
	    <form class="searchForm" method="GET">
			<label>Categorias: </label>
			<select name="searchByCategory">
				<option value="0">Todos</option>
				<?php loadSearchCatedories($db); ?>
			</select>
			<input type="submit" value="Buscar">
		</form>
		<form class="searchForm" method="GET">	
			<label>Busca por nome: </label>
			<input type="text" name="searchByName" placeholder="Digite o nome de um produto">
			<input type="submit" value="Search">
			<a id="addNew" href="inserir/">Adicionar novo produto</a>
		</form>
		<form class="searchForm" method="GET">
			<label>Organizar por: </label>
			<select name="sort">
				<option>Selecione uma opção</option>
				<option value="1">Preço menor para maior</option>
				<option value="2">Preço maior para menor</option>
				<option value="3">Esqoque menor para maior</option>
				<option value="4">Estoque maior para menor</option>
			</select>
			<input type="submit" value="OK">
		</form>
	</nav>
	<p id="actionMsg"><?php echo $msg; ?></p>
	<table cellspacing='0'>
		<tr>
			<th>Name</th>
			<th>Price</th>
			<th>Qtd</th>
			<th>Action</th>
		</tr>
		<?php 
			$query = listProducts($db);
			
			while($result = odbc_fetch_array($query)):
		?>
				<tr>
					<td class='textocell'><?php echo $result['nomeProduto']; ?></td>
					<td class='textocell'>R$ <?php echo number_format($result['precProduto'], 2, ',', ' '); ?></td>
					<td class='textocell'><?php echo $result['qtdMinEstoque']; ?></td>
					<td id='acoes'>
						<?php if($result['idProduto'] > 10): ?>
							<a class='edita' href="../prodUpdate.php?id=<?php echo $result['idProduto']; ?>">Edit</a>
							<a class='deleta' href="?action=delete&id=<?php echo $result['idProduto']; ?>">Delete</a>
						<?php endif; ?>
					</td>
				</tr>
			<?php endwhile; odbc_close($db);?>
	</table>
	
</body>
</html>