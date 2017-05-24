<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html" charset="ISO-8859-1" />
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
    	
		#pradNavigation {
			text-align: center;
			width: 100%;
		}
    </style>
</head>
<body>

	<?php  include("../menu.php")?>
    
    <nav id="pradNavigation">
		<div class="searchForme" >
			<form method="GET" action="/pi/produtos/?Name=3" >	
				<div class="borderSearch">	
					
					<input type="text" name="searchByName" placeholder="Pesquisar produto">
					<input type='hidden' name='tipoA' value='1'>
					<?php echo ComboB($pesquisaB);?>
					<?php echo comboC($pesquisaC);?>
					<input type="submit" class="searchForm1"  value="Pesquisar">
				</div>
				<a id="addNew" href="inserir/">Adicionar novo produto</a>
			</form>
		</div>
		
		<div class="subSearch">	
			<form class="searchForm" method="GET" >
				<label>Categorias: </label>
				<select name="searchByCategory">
					<option value="0">Todos</option>
					<?php loadSearchCatedories($db); ?>
				</select>
				<?php echo ComboA($pesquisa);?>
				<?php echo comboC($pesquisaC);?>
				<input type='hidden' name='tipoB' value='1'>
				<input type="submit" value="Buscar">
			</form>
			
			<form class="searchForm" method="GET">
				<label>Organizar por: </label>
				<select name="sort">
					<option>Selecione uma opção</option>
					<option value="1">Preço menor para maior</option>
					<option value="2">Preço maior para menor</option>
					<option value="3">Estoque menor para maior</option>
					<option value="4">Estoque maior para menor</option>
				</select>
				<input type='hidden' name='tipoC' value='1'>
				<?php echo ComboA($pesquisa);?>
				<?php echo ComboB($pesquisaB);?>
				<input type="submit" value="OK">
			</form>
		</div><br>
	</nav>
	<p id="actionMsg"><?php echo $msg; ?></p>
	
	<table  cellspacing='0'>
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
						
							<a class='edita' href="editar/?id=<?php echo $result['idProduto']; ?>">Edit</a>
							<a class='deleta' href="?action=delete&id=<?php echo $result['idProduto']; ?>">Delete</a>
						
					</td>
				</tr>
			<?php endwhile; odbc_close($db);?>
	</table>
	
</body>
</html>