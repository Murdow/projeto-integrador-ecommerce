<!DOCTYPE html>
<html>
<head>
	<title>Cadastro Usuário</title>
<style>
	body {
		background-color: #000;
	}
	form {
		background-color: #fff;
		margin: 50px auto;
		padding: 20px;
		width: 300px;
	}
	form label {
		font-weight: bold;
	}
	form input {
		float: right;
	}
	p {
		margin-bottom: 30px;
		position: relative;
	}
	p:before, p:after {
		content: "";
		display: table;
		clear: both;
	}
	.fieldError {
		color: #ff0000;
		position: absolute;
		bottom: -20px;
		right: 0;
	}
	form h1 {
		text-align: center;
		margin-bottom: 30px;
	}
</style>
</head>
<body>
	<form method="POST">
		<h1>Cadastro</h1>
		<p>
			<label>Login:</label>
			<input type="text" name="login">
			<span class='fieldError'><?php echo $errorMsg; ?></span>
		</p>
		<p>
			<label>Password:</label>
			<input type="password" name="password">
		</p>
		<p>
			<label>E-Mail:</label>
			<input type="text" name="email">
		</p>
		<p>
			<label>Name:</label>
			<input type="text" name="name">
		</p>
		<p>
			<input type="submit" value="Send">
		</p>
	</form>
</body>
</html>