<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Modifier un commentaire</title>
		<link href="vue/style.css" rel="stylesheet" />
	</head>
	
	<body>
		<h1>Mon super blog</h1>
		<h2>Modification du commentaire</h2>
		<?php
		foreach ($commentaire as $Commentaire)
		{?>
		<form class="mod_commentaire" action="admin_mod_commentaires_post.php?id=<?php echo $_GET['id']; ?>"
		method="post">
		<p>
			<label for="pseudo">Pseudo</label> : <input type="text" name="pseudo" id="pseudo" 
			value="<?php echo $Commentaire['pseudo']; ?>"/>
			<label for="commentaire">Commentaire</label> : 
			<textarea name="commentaire" id="commentaire"  /><?php echo $Commentaire['commentaire']; ?></textarea>
			<input type="submit" value="Envoyer" />
		</p>
		</form>
		
		<?php } ?>
		<a href="admin.php">Retour</a>
	</body>

</hmtl>