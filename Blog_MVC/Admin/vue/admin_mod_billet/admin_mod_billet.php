<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Modifier un billet</title>
		<link href="vue/style.css" rel="stylesheet" />
	</head>
	
	<body>
		<h1>Mon super blog</h1>
		<h2>Modification du billet</h2>
		<?php
		foreach ($billet as $Billet)
		{?>
		<form class="mod_billet" action="admin_mod_billet_post.php?id=<?php echo $_GET['id']; ?>"
		method="post">
		<p>
			<label for="titre">Titre</label> : <input type="text" name="titre" id="titre" 
			value="<?php echo $Billet['titre']; ?>"/>
			<label for="contenu">Contenu</label> : 
			<textarea name="contenu" id="contenu"  /><?php echo $Billet['contenu']; ?></textarea>
			<input type="submit" value="Envoyer" />
		</p>
		</form>
		
		<?php } ?>
		<a href="admin.php">Retour</a>
	</body>

</hmtl>