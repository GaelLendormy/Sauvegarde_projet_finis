<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<link rel="stylesheet" href="style.css" />
		<title>Blog</title>
	</head>

	<body>
		<h1>Mon super blog!!</h1>
		
		<div class="news">
		<?php
		//On se connecte a la bdd et on efface l'affichage d'erreur
		try
		{
			$bdd = new PDO('mysql:host=localhost;dbname=test', 'root', '', array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\'')); 

		}
		catch(Exception $e)
		{
			die('Erreur : '.$e->getMessage());
		}
		
		//On appelle la class pagination.class
		include_once('pagination.class.php');
		
		//On crée un nouvelle objet $pagination
		$pagination = new Pagination(5,'billets');
		
		//On demande les données calculé par la class
		$actual_page = $pagination->getActual_page();
		$first_entry = $pagination->getFirst_entry();
		$max_entry_page = $pagination->getMax_entry_page();
		$nb_page = $pagination->getNb_page();
		
		//On effectue une demande pour recupérer les 5 messages en rapport avec la page
		$req = $bdd->prepare('SELECT id, titre, contenu, DATE_FORMAT(date_creation, \'Le %d/%m/%Y à %Hh%imin%ss\')
		as date_creation_fr FROM billets ORDER BY id DESC LIMIT :first_entry, :max_entry_page');
		$req->bindValue('first_entry',$first_entry,PDO::PARAM_INT);
		$req->bindValue('max_entry_page',$max_entry_page,PDO::PARAM_INT);
		$req->execute();
		
		//On affiche les messages grace a une boucle while et sécurise avec htmlspecialchars
		while ($data = $req->fetch())
		{
			echo '<h3>'. htmlspecialchars($data['titre']).'   
			<em>  '. htmlspecialchars($data['date_creation_fr']) . '</em></h3>
			<p>'. htmlspecialchars($data['contenu']) . '<br />
			<a href="commentaires.php?id= ' . $data['id'] . '">Commentaires</a></p>';
		}
		//On indique la fin de la requete sql
		$req->closeCursor();
		?>
		</div>
		
		<?php
			//On affiche le bouton précedent
		if ($actual_page != 1)
		{
			echo '<a href="index_blog.php?page=' . ($actual_page - 1) . '"> Préc </a>';
		}

		//On affiche les numeros de page
		for($numero_page = 1; $numero_page <= $nb_page; $numero_page ++ )
		{
			if($numero_page == $actual_page)
			{
				echo '[' . $numero_page . ']';
			}
			
			else
			{
				echo '<a href="index_blog.php?page=' . $numero_page . '"> ' . $numero_page . ' </a>';
			}
		}	

		//On affiche le bouton suivant 
		if ($actual_page != $nb_page)
		 {
				echo '<a href="index_blog.php?page=' . ($actual_page + 1) . '"> Suiv </a></br>';
		 }
		?>
				
		<!-- On affiche un formulaire pour choisir sa page -->
		<form action="index_blog.php" method="get">
			<label for="page">Page</label> : <input type="number" min="1" name="page" id="page">
		</form></br>
		
		<!-- On crée un bouton pour actualiser la page -->
		<p>
			<a href="index_blog.php">Actualiser</a>
		</p>
	</body>
</html>
