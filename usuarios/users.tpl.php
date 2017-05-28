<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <title>Usuários</title>
	<link rel="stylesheet" type="text/css" href="../testeestilo.css">
    <script src="https://use.fontawesome.com/11638b2227.js"></script>	
</head>
<body>

	<?php include("../menu.php"); ?>
	<nav id="prodNavigation">
    	<form method="GET" id="searchForm">
    		<!--Search By Name-->
    		<div class="searchByNameContainer">
    			<div class="borderSearch">					
					<input type="text" name="searchByName" placeholder="Digite o nome" value="<?php if(isset($_GET['searchByName']) && $_GET['searchByName'] != '') echo $_GET['searchByName']; ?>">	
					<input type="submit" class="searchForm1" value="Pesquisar">
				</div>				
    		</div>
    		<!--End Search By Name-->
    	</form>
	</nav>
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
					<td class='textocell'><?php echo checkType($result['tipoPerfil']); ?></td>
					<td class='textocell'><?php echo checkStatus($result['usuarioAtivo']); ?></td>
					<td id='acoes'>
						<?php if($result['idUsuario'] > 1 && getSessionUserType() === "A"): ?>
							<a class='edita' href="editar/?id=<?php echo $result['idUsuario']; ?>" title="Editar"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
							<a class='deleta' href="?action=delete&id=<?php echo $result['idUsuario']; ?>" title="Deletar"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
						<?php endif; ?>
					</td>
				</tr>
			<?php endwhile; odbc_close($db);?>
	</table>
	<?php include("../footer.tpl.php") ?>
</body>
</html>