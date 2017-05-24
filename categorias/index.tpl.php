<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <title>Categorias</title>
	<link rel="stylesheet" type="text/css" href="../testeestilo.css">

</head>
<body>
	<?php  include("../menu.php")?>
    
	<div id="btnContainer">
		<a id='addNew' href='inserir/'>Adicionar nova Categoria</a>
	</div>
	
	<p id="actionMsg"><?php echo $msg; ?></p>
	<table cellspacing='0'>
		<tr>
			<th>Name</th>
			<th>Description</th>
			<th>Action</th>
		</tr>
		<?php 
			$query = listCategories($db);
			
			while($result = odbc_fetch_array($query)):
		?>
				<tr>
					<td class='textocell'><?php echo $result['nomeCategoria']; ?></td>
					<td class='textocell'><?php echo $result['descCategoria']; ?></td>
					<td id='acoes'>
						<?php  ?>
							<a class='edita' href="editar/?id=<?php echo $result['idCategoria']; ?>">Edit</a>
							<a class='deleta' href="?action=delete&id=<?php echo $result['idCategoria']; ?>">Delete</a>
						<?php ?>
					</td>
				</tr>
			<?php endwhile; odbc_close($db);?>
	</table>
	
</body>
</html>