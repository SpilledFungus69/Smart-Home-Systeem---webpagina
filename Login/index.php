<!DOCTYPE HTML>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<title>Document</title>
</head>

<body>
	<div class="container d-flex justify-content-center">
		<form method="post" action="login.php">
			<h2>Inlogpagina</h2>
			<div class="alert alert-danger">
				<?php
				//wanneer je iets fout doet, komt de gegeven error naarvoren, bijv. wachtwoord  verkeerd.
				if (isset($_GET['error'])) {
					echo $_GET['error'];
				}
				?>
			</div>
			<div class="mb-3">
				<label>Gebruikersnaam</label>
				<input type="text" name="gnaam" placeholder="Gebruikersnaam" class="form-control"><br>
			</div>
			<div class="mb-3">
				<label>Wachtwoord</label>
				<input type="password" name="wwoord" placeholder="Wachtwoord" class="form-control"><br>
			</div>
			<button type="submit" class="btn btn-primary">Login</button>
		</form>
	</div>
	</div>

</body>

</html>