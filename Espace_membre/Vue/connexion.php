<!DOCCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Connexion</title>
	</head>
	
	<body>
		<h1>Entrez vos identifiant</h1>

		<form class="form_connexion" action="connexion.php" method="post" />
			<p>
				<label for="pseudo">Pseudo</label> : <input type="text" name="pseudo" id="pseudo"  /></br></br>
				<label for="pass">Mot de passe</label> : <input type="password" name="pass" id="pass"  /></br></br>
				<input type="submit" value="Envoyer" />
			</p>
		</form>
	</body>
</html>