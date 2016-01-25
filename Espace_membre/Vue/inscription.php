<!DOCCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Inscription</title>
	</head>
	
	<body>
		<h1>Inscrivez vous !</h1>

		<form class="form_inscription" action="inscription.php" method="post" />
			<p>
				<label for="pseudo">Pseudo</label> : <input type="text" name="pseudo" id="pseudo"  /></br></br>
				<label for="pass">Mot de passe</label> : <input type="password" name="pass" id="pass"  /></br></br>
				<label for="pass2">Retapez votre mot de passe</label> : <input type="password" name="pass2" id="pass2"  /></br></br>
				<label for="mail">Adresse email</label> : <input type="text" name="mail" id="mail"  /></br></br>
				<input type="submit" value="Envoyer" />
			</p>
		</form>
	</body>
</html>