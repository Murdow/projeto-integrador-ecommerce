<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <title>Dashboard</title>
	<link rel="stylesheet" type="text/css" href="../../testeestilo.css">
    <style type="text/css">
		* {
			margin: 0;
			padding: 0;
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
			background-color: #002244;
			box-sizing: border-box;
			font-family: 'Roboto';
			margin: 50px auto;
			padding: 20px 50px;
			max-width: 1000px;
			width: 100%;
		}
		.clearFix:before, .clearFix:after {
			content: "";
			display: table;
			clear: both;
		}
		label {
			color: #69be28;
			font-weight: bold;
		}
		input, textarea, select {
			background-color: #a5acaf;
			border: solid 1px #69be28;
			box-sizing: border-box;
			padding: 5px;
		}
		input:focus, textarea:focus {
			background-color: #69be28;
			outline: none;
		}
		input[type=file] {			
			padding: 0;
		}
		textarea {
			height: 200px;
			resize: none;
			width: 230px;
		}
		#updateSuccess {
			color: red;
		}
		p {		
			margin-bottom: 10px;
		}
		#description * {
			vertical-align: top;
		}
		#description {
			margin-right: 10px;
		}
		#message {
			color: red;
			font-weight: bolder;
			text-align: center;
		}
		#textDataContainer {
			float: right;
			position: relative;
			width: 60%;
		}
		#imageUpdateContainer {
			float: left;
			width: 30%;
		}
		#valuesContainer, #description {
			float: left;
		}
		#buttons {
			position: absolute;
			bottom: 0;
			left: 242px;
		}
		#buttons input[type=submit] {
			background-color: #002244;
			border: solid 1px #69be28;
			color: #69be28;
		}
		#buttons a {
			padding: 3px;
			text-decoration: none;
		}
		#buttons a, #clearFile {
			background-color: #002244;
			border: solid 1px #a5acaf;
			color: #a5acaf;
		}
		#valuesContainer p:nth-child(1), #valuesContainer p:nth-child(2), #valuesContainer p:nth-child(3) {
			float: left;
			margin-right: 30px;
		}
		#valuesContainer input[type=text] {
			text-align: center;
		}
		#valuesContainer p:nth-child(3) {
			margin-right: 0;
		}
		#prodPrice, #prodDiscount, #prodQtd {
			max-width: 70px;
		}
		#prodName {
			width: 100%;
		}
		#imgContainer {
			background: url('../../imagems/noImage.png') center no-repeat; 
			background-size: cover;
			max-width: 270px;
			width: 100%;
		}
		input[type=file] {
			width: 91%;
		}
		#clearFile {
			height: 23px;
			margin-left: -3px;
			padding: 0;
			width: 23px;
		}
		#userName {
			margin-top: -8px;
		}
		#imgContainer #currentImage {
			width: 100%;
		}
	</style>
	
</head>
<body>

	<div id="wrapper">
		<header id="pageHeader">
			<img src="../../imagems/logo.jpg" alt="logo" title="home">			
		</header>
		
		<nav id="productsControlNavigation">
			<ul>
				<li><a href="../">PRODUTOS</a></li>
				<li><a href="../../categorias/">CATEGORIAS</a></li>
				<li><a href="../../usuarios/">USUARIOS</a></li>
				<li><a href="../../login/?session=finish">Sair</a></li>
			</ul>	
		</nav>
    </div>
    
    <form enctype="multipart/form-data" method="POST" action="?id=<?php echo $_GET['id']; ?>&update=true" class="clearFix">
		<p id="message"> <?php echo $msg; ?></p>
		<p>
			<input class="id" type="hidden" name="prodID" value="<?php echo $result['idProduto']; ?>">
		</p>
		<div id="textDataContainer">
			<p>
				<label for="prodName">Nome</label><br>
				<input type="text" id="prodName" name="prodName" required value="<?php echo $result['nomeProduto']; ?>">
			</p>
			<p id="description">
				<label for="prodDescription">Descrição</label><br>
				<textarea type="text" id="prodDescription" name="prodDescription"><?php echo $result['descProduto']; ?></textarea>
			</p>
			<div id="valuesContainer">
				<p>	
					<label for="prodPrice">Preço</label><br>
					<input type="text" id="prodPrice" name="prodPrice" required value="<?php echo str_replace(",", ".", number_format($result['precProduto'], 2, ',', ' ')); ?>">
				</p>
				<p>
					<label for="prodDiscount">Desconto</label><br>
					<input type="text" id="prodDiscount" name="prodDiscount" value="<?php echo $result['descontoPromocao']; ?>">
				</p>
				<p>
					<label for="prodQtd">Estoque</label><br>
					<input type="text" id="prodQtd" name="prodQtd" value="<?php echo $result['qtdMinEstoque']; ?>">
				</p>
				<p>
					<label for="prodCategory">Categoria</label><br>
					<select id="prodCategory" name="prodCategory" required>
						<?php loadFormCategories($db, $result['idCategoria']); ?>
					</select>
				</p>					
				<p>
					<label for="prodStatus">Status</label><br>
					<select id="prodStatus" name="prodStatus">
						<option value="1">Ativo</option>
						<option value="0">Inativo</option>
					</select>
				</p>
				<p id="userName">
					<label>Cadastrado por: <?php echo checkUserId($db, $result['idUsuario']); ?></label>
				</p>
			</div>			
			<p id="buttons">
				<input type="submit" value="SALVAR">
				<a href="../">CANCELAR</a>
			</p>
		</div>
		<div id="imageUpdateContainer">
			<p>
				<label for="prodImg">Imagem</label>
				<div id="imgContainer">
					<img id="currentImage" src="data:image/jpeg;base64,<?php $conteudo_base64 = base64_encode($result['imagem']); echo $conteudo_base64 ?>">
				</div>
			</p>
			<p>				
				<input type="file" id="prodImg" name="prodImg" accept="image/*" onchange="readImagesAndSetAsBackground(this.files)">
				<input type="button" id="clearFile" value=" X " title="Excluir imagem selecionada">
			</p>		
		</div>
	</form>
	
	<script src="js/imageDisplayEdit.js"></script>
</body>
</html>