<!DOCCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Mon blog</title>
		<link href="vue/style.css" rel="stylesheet" />
	</head>
	
	<body>
		<h1>Mon super blog !</h1>
		<a href="admin_news.php"> Ajouter un nouveau billet</a>
		<p>Derniers billets du blog : </p>
		
		<?php
		foreach($billets as $billet)
		{
			?>
			<div class="news">
				<h3>
					<?php echo $billet['titre']; ?>
					<em> le <?php echo $billet['date_creation_fr']; ?></em>
				</h3>
				
				<p>
					<?php echo $billet['contenu']; ?>
					<br />
					<em><a href="admin_commentaires.php?id=<?php echo $billet['id']; ?>">
					Commentaires</a>
					<a href="admin_mod_billet.php?id=<?php echo $billet['id']; ?>">
					Modifier</a>
					<a href="admin_del_billet.php?id=<?php echo $billet['id']; ?>">
					Supprimer</a>
					</em>
					
				</p>
			</div>
		<?php		
		}
		?>
	</body>
</html>