<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link href="http://fonts.googleapis.com/css?family=Roboto:400,300,100" rel="stylesheet" type="text/css">
    <style>
		* {
			padding: 0;
			margin: 0;
		}
		body {
			background-color: #a5acaf;
		}
		form {
			float: right;
			margin: 0 auto;
			width: 30%;
		}
		#pageHeader {
			background-color: #002244;
			border-bottom: solid 10px #69be28;
			height: 60px;
			width: 100%;
		}
		#pageHeader #logo {
			margin: 8px 0 0 10px;
			width: 100px;
		}
		h1 {
			float: left;
			font-family: 'Roboto', sans-serif;
			color: #002244;
			font-weight: 300;
			font-size: 70px;
			line-height: 48pt;
			width: 600px;
			padding-bottom: 15px;
			text-shadow: 2px 2px #69BE28;
			width: 60%;
		}
		#wrapper {
			margin: 0 auto;
			padding-top: 150px;
			max-width: 1200px;
		}
		#wrapper:before, #wrapper:afeter {
			content: "";
			display: table;
			clear: both;
		}
		h2 {
			background-color: #002244;
			border-bottom: solid 4px #69be28;	
			border-radius: 10px;
			color: #fff;
			padding: 5px 10px 5px 10px;
			font-family: 'Roboto', sans-serif;
			font-weight: 300;
			margin-bottom: 10px;
		}
		form label {
			color: #fff;
			margin-right: 10px;
			width: 10%;
		}
		form p {
			background-color: #002244;
			border-radius: 10px;
			margin-bottom: 10px;
			padding: 5px 10px 5px 10px;
		}
		form input[type=text], form input[type=password] {
			background: none;
			border: none;
			border-bottom: solid 1px #fff;
			color: #fff;
			width: 75%;
		}
		form input[type=text]:focus, form input[type=password]:focus {
			outline: none;
		}
		form input[type=submit] {
			background: none;
			border: none;
			border: solid 1px #69be28;
			border-radius: 5px;
			color: #69be28;	
			padding: 5px 10px;
		}
		form p:last-child {
			text-align: right;
		}
		form input[type=submit]:hover {
			background-color: #69be28;	
			color: #002244;
			cursor: pointer;
		}
		.errorMsg {
			color: #cc1100;
			display: inline-block;
			padding-bottom: 10px;
		}
	</style>
    
</head>
<body>
	<header id="pageHeader">
		<img id="logo" alt="logo" title="DeltaSports" src="../imagems/logo.jpg">
	</header>
	<div id="wrapper">
		<h1>Delta Materiais Esportivos</h1>
		<form method="POST">
			<h2>Login</h2>
			
			<span class="errorMsg"><?php echo $errorMsg; ?></span>
			<p>
				<label for="login">Login:</label>
				<input type="text" name="login" id="login" required>
			</p>
			<p>
				<label for="password">Senha:</label>
				<input type="password" name="password" id="password" required>
			</p>		
			<p>
				<input type="submit" value="Entrar">
			</p>
		</form>
    </div>
</body>
</html>
