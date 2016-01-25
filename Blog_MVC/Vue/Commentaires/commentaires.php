<!DOCCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Commentaires</title>
		<link href="vue/blog/style.css" rel="stylesheet" />
	</head>
	
	<body>
		<h1>Mon super blog !</h1>
		<p>Derniers commentaires du billet : </p>
		
		<?php
		foreach($billet as $Billet)
		{
			?>
			<div class="news">
				<h3>
					<?php echo $Billet['titre']; ?>
					<em> le <?php echo $Billet['date_creation_fr']; ?></em>
				</h3>
				
				<p>
					<?php echo $Billet['contenu']; ?>
				</p>
			</div>
			
		<!-- On crée un formulaire pour l'entrée des messages avec memoire du dernier pseudo entrée grace au cookie -->
		<form class="form_commentaires" action="commentaires_post.php?id_billet=
		<?php echo htmlspecialchars($_GET['id']) ?>" method="post" />
			<p>
				<label for="pseudo">Pseudo</label> : <input type="text" name="pseudo" id="pseudo" value="Pseudo"    />
				<label for="message">Message</label> : <input type="text" name="message" id="message"  />
				<input type="submit" value="Envoyer" />
			</p>
		</form>
		<?php		
		}
		foreach ($commentaires as $commentaire)
		{
			?>
			<div class="commentaires"> 
			<h4><?php echo $commentaire['pseudo'];?>   
			<em><?php echo $commentaire['date_creation_fr'];?></em></h4>
			<p><?php echo $commentaire['commentaire'];?></p>
			</div>
			<?php
		}
		?>
	</body>
</html>