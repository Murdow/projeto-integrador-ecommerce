<?php
include "db/index.php";
	//INSERT
	if((isset($_GET['param2'])) && ($_GET['param2'] == "save")) {			
		$name = $_POST['prodName'];
		$description = $_POST['prodDescription'];
		$price = $_POST['prodPrice'];
		$qtd = $_POST['prodQtd'];
		$idCategory = $_POST['prodCategory'];	
		
		odbc_exec($db, "INSERT INTO Produto
							(nomeProduto, 
							descProduto,
							precProduto,
							idCategoria,
							qtdMinEstoque)
						VALUES 
							('$name',
							'$description',
							'$price',
							'$idCategory',
							'$qtd')");	
		echo "<p style='color:#fff;'>FEITO!!!!!!!!!!!!</p>";
	}
	//UPDATE
	if((isset($_GET['update'])) && ($_GET['update'] == "true")) {			
		$name = $_POST['prodName'];
		$description = $_POST['prodDescription'];
		$price = $_POST['prodPrice'];
		$qtd = $_POST['prodQtd'];
		$idCategory = $_POST['prodCategory'];
		$id = $_POST['prodID'];	
		$image = $_POST['prodImg'];			

		if(odbc_exec($db, "UPDATE produto
					   SET
					   nomeProduto = '$name',
					   descProduto = '$description',
					   precProduto = '$price',
					   idCategoria = '$idCategory',
					   qtdMinEstoque = '$qtd',
					   imagem = '$image'
					   WHERE
					   idProduto = $id")) {
		echo "Produto atualizado com sucesso!<br>";
						}
	}
	//DELETE
	function deleteItem() {				
		if(odbc_exec($db, "DELETE FROM Produto
						   WHERE
						   idProduto = $id")) {
			echo "Usuário deletado com sucesso!<br>";
							}
		else echo "Erro ao deletar usuário";			
	}
	function loadCatedories($db) { 
		$query = odbc_exec($db, "SELECT idCategoria, nomeCategoria FROM Categoria");
		$value = 1;
		while($result = odbc_fetch_array($query)) {
			echo "<option value='" . $result['idCategoria'] . "'>" . $result['nomeCategoria'] . "</option>";
			$value++;
		}
	}
	function loadFormCategories($id) { 
		$query = odbc_exec($db, "SELECT nomeCategoria FROM Categoria");
		$value = 1;
		while($result = odbc_fetch_array($query)) {
			if($value == $id)
				echo "<option value='" . $value . "' selected>" . $result['nomeCategoria'] . "</option>";
			else
				echo "<option value='" . $value . "'>" . $result['nomeCategoria'] . "</option>";

			$value++;
		}
	}
?>
<style>
	* {
		margin: 0;
		padding: 0;
	}
	body {
		background-color: #000;
		color: #fff;
		padding-top: 20px;
		text-align: center;
	}
	#addNew {
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
	#prodPrice {
		width: 55px;
	}
	#prodQtd {
		width: 25px;
	}
	#updateSuccess {
		color: red;
	}
	p {
		border-bottom: solid 1px #fff;
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
</style>
<form class="searchForm" method="GET">
	<label>Categorias: </label>
	<select name="searchByCategory">
		<option></option>
		<?php loadCatedories($db); ?>
	</select>
	<input type="submit" value="Buscar">
</form>
<form class="searchForm" method="GET">	
	<label>Busca por nome: </label>
	<input type="text" name="searchByName">
	
	<label>Organizar por: </label>
	<select>
		<option></option>
		<option value="1">Preço menor para maior</option>
		<option value="2">Preço maior para menor</option>
		<option value="3">Esqoque maior para menor</option>
		<option value="4">Estoque menor para maior</option>
	</select>
	<input type="submit" value="Search">
	<a id="addNew" href="prod.php?param=addnew">Adicionar novo produto</a>
</form>

<?php if((isset($_GET['param'])) && ($_GET['param'] == "addnew")): ?>
	<h2>Add um novo produto</h2>
	<form action="prod.php?param=addnew&param2=save" method="POST">
		<label>Nome:</label>
		<input type="text" id="prodName" name="prodName" placeholder="Digite o nome do produto">
		<label>Preço:</label>
		<input type="text" id="prodPrice" name="prodPrice" placeholder="100,00">
		<label>Descrição:</label>
		<input type="text" id="prodDescription" name="prodDescription" placeholder="Digite a descrição do produto">
		<label>Categoria:</label>
		<select id="prodCategory" name="prodCategory">
			<?php loadCatedories($db); ?>
		</select>
		<label>Imagem:</label>
		<input type="file" id="prodImg" name="prodImg" accept="image/*">
		<label>Estoque:</label>
		<input type="text" id="prodQtd" name="prodQtd" value="30">
		<input type="submit" value="Salvar">
	</form>
<?php endif; ?>

<h2>Produtos Cadastrados</h2>
<?php
if((isset($_GET['update'])) && ($_GET['update'] == "true")) echo "<p id='updateSuccess'>Alteração feita com sucesso!</p>";


	if(isset($_GET['searchByName'])) {
		$searchByName = $_GET['searchByName'];
		$query = odbc_exec($db, "SELECT * FROM Produto WHERE nomeProduto = '$searchByName'");
	}
	elseif(isset($_GET['searchByCategory'])) {
		$searchByCategory = $_GET['searchByCategory'];
		$query = odbc_exec($db, "SELECT * FROM Produto WHERE idCategoria = '$searchByCategory'");
	}
	else
		$query = odbc_exec($db, "SELECT * FROM Produto");

	while($result = odbc_fetch_array($query)): ?>
		
		<form method="POST" action="prod.php?update=true">
			<label class="id">ID</label>
			<input class="id" type="text" name="prodID" value="<?php echo $result['idProduto']; ?>">
			<label>Nome:</label>
			<input type="text" id="prodName" name="prodName" value="<?php echo $result['nomeProduto']; ?>">
			<label>Preço:</label>
			<input type="text" id="prodPrice" name="prodPrice" value="<?php echo number_format($result['precProduto'], 2, ',', ' '); ?>">
			<label>Descrição:</label>
			<input type="text" id="prodDescription" name="prodDescription" value="<?php echo $result['descProduto']; ?>">
			<label>Categoria:</label>
			<select id="prodCategory" name="prodCategory">
				<!--<?php loadFormCategories($db, $result['idCategoria']); ?>-->
			</select>
			<label>Imagem:</label>
			<input type="file" id="prodImg" name="prodImg" accept="image/*">
			<label>Estoque:</label>
			<input type="text" id="prodQtd" name="prodQtd" value="<?php echo $result['qtdMinEstoque']; ?>">
			<input type="submit" value="Salvar Alterações">
			<input type="submit" value="Deletar">
		</form>

<?php endwhile;  ?>


