<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Nouveau billet</title>
		<link href="vue/style.css" rel="stylesheet" />
	</head>
	
	<body>
		<h1>Mon super blog</h1>
		<h2>Ajout d'un nouveau billet</h2>
		
		<form class="new_billet" action="admin_news_post.php" method="post">
		<p>
			<label for="titre">Titre</label> : <input type="text" name="titre" id="titre" />
			<label for="contenu">Contenu</label> : 
			<textarea name="contenu" id="contenu" /></textarea>
			<input type="submit" value="Envoyer" />
		</p>
		</form>
		<a href="admin.php">Retour</a>
	</body>

</hmtl>