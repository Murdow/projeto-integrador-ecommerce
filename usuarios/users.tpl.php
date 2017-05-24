<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <title>Usuários</title>
	<link rel="stylesheet" type="text/css" href="../testeestilo.css">
    
</head>
<body>
	<?php  include("../menu.php")?>

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