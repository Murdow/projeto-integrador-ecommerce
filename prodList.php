<?php
	include "functions.php";
	if(!isset($_SESSION['user'])) header("Location: login/");
	function loadSearchCatedories($db) { 
		$query = odbc_exec($db, "SELECT idCategoria, nomeCategoria FROM Categoria");
		
		while($result = odbc_fetch_array($query)) {
			echo "<option value='" . $result['idCategoria'] . "'>" . $result['nomeCategoria'] . "</option>";
		}
	}
	function getCategoryName($db, $id) {
		$query = odbc_exec($db, "SELECT nomeCategoria FROM Categoria WHERE idCategoria = '$id'");
		
		$result = odbc_fetch_array($query);
		return $result['nomeCategoria'];
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="iso-8959-1">
	<title>List</title>
	<style type="text/css">
		* {
			margin: 0;
			padding: 0;
		}
		body {
			background-color: #000;
			color: #fff;
			padding-top: 20px;
			text-align: left;
		}
		#addNew, #delete, table tr td a {
			color: #000;
			background-color: #ddd;
			border: solid 1px #aaa;
			padding: .3px 0;
			text-decoration: none;
		}
		form {
			display: block;
			padding: 10px 0;
		}
		label {
			font-weight: bold;
		}
		input {
			background-color: #ddd;
		}
		input[type=file] {
			color: #000;
		}
		#prodPrice, #prodDiscount {
			width: 55px;
		}
		#prodQtd {
			width: 25px;
		}
		#updateSuccess {
			color: red;
		}
		p {		
			margin-bottom: 10px;
			padding-bottom: 10px;
		}
		form:nth-child(odd) {
			background-color: red;
		}
		.searchForm {
			background-color: #000;
		}
		.id {
			display: none;
		}
		table tr:nth-child(odd) {
			background-color: red;
		}
		table tr td {
			padding: 0 10px;
		}
	</style>
</head>
<body>
	<form class="searchForm" method="GET">
		<label>Categorias: </label>
		<select name="searchByCategory">
			<option>Selecione uma categoria</option>
			<?php loadSearchCatedories($db); ?>
		</select>
		<input type="submit" value="Buscar">
		</form>
		<form class="searchForm" method="GET">	
			<label>Busca por nome: </label>
			<input type="text" name="searchByName" placeholder="Digite o nome de um produto">
			<input type="submit" value="Search">
			<a id="addNew" href="prod.php?param=addnew">Adicionar novo produto</a>
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

		<table>
			<tr>
				<th>Name</th>
				<th>Price</th>
				<th>Category</th>
				<th>Edit</th>
			</tr>
			<?php 
				$query = listProducts($db);

				while($result = odbc_fetch_array($query)):
			?>
					<tr>
						<td><?php echo $result['nomeProduto']; ?></td>
						<td><?php echo number_format($result['precProduto'], 2, ',', ' '); ?></td>
						<td><?php echo $result['qtdMinEstoque']; ?></td>
						<td><a href="prodUpdate.php?id=<?php echo $result['idProduto']; ?>">Edit</a></td>
					</tr>
				<?php endwhile; ?>
		</table>
</body>
</html>