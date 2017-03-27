<?php
	include "functions.php";
	logOut();
	insertItem();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<style>
		body {
			background-color: #000;
		}
		form {
			background-color: #fff;
			margin: 50px auto;
			padding: 20px;
			position: relative;
			width: 300px;
		}
		form label {
			font-weight: bold;
		}
		form input {
			float: right;
		}
		p:before, p:after {
			content: "";
			display: table;
			clear: both;
		}

		form h1 {
			text-align: center;
			margin-bottom: 30px;
		}
		form input[type=submit] {
			margin-bottom: 50px;
		}
		#cadastroLink {
			color: #000;
			position: absolute;
			bottom: 10px;
			right: 10px;
		}
	</style>
</head>
<body>
	<form method="POST" action="dashboard.php">
		<h1>Log-In</h1>
		<p>
			<label>Login:</label>
			<input type="text" name="login" required>
		</p>
		<p>
			<label>Password:</label>
			<input type="password" name="password" required>
		</p>		
		<p>
			<input type="submit" value="Log-in">
		</p>

		<a href="index.html" id="cadastroLink">Cadastrar</a>
	</form>
</body>
</html>