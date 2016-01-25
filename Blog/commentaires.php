<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<link rel="stylesheet" href="style.css" />
		<title>Commentaires</title>
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
		
			//On va verifier que le billet existe et le cas échéant afficher un message d'erreur
		$req = $bdd->prepare('SELECT id FROM billets WHERE id= :id ');
		$req->bindValue('id',$_GET['id'],PDO::PARAM_INT);
		$req->execute();
		
		$data = $req->fetch();
		if (!isset($data['id']))
		{
			echo "Le billet n'existe pas!";
		}
		
		else
		{
		
		//On va chercher le message correspondant à l'id envoyé avec une requete preparée
		$req = $bdd->prepare('SELECT id, titre, contenu, DATE_FORMAT(date_creation, \'Le %d/%m/%Y à %Hh%imin%ss\')
		as date_creation_fr FROM billets WHERE id= :id ');
		$req->bindValue('id',$_GET['id'],PDO::PARAM_INT);
		$req->execute();
		
		//On affiche le message	et sécurise avec htmlspecialchars
		$data = $req->fetch();
			echo '<h3>'. htmlspecialchars($data['titre']).'   
			<em>  '. htmlspecialchars($data['date_creation_fr']) . '</em></h3>
			<p>'. htmlspecialchars($data['contenu']) . '</p>';
			
		//On indique la fin de la requete sql
		$req->closeCursor();
		?>
		</div>
		<div class="commentaires">
		<h2>Commentaires :</h2>
		<?php
				
		//On appelle la class pagination.class
		include_once('pagination.class.php');
		
		//On crée un nouvelle objet $pagination
		$pagination = new Pagination(5,'commentaires');
		
		$return_nb_entry = $bdd->prepare('SELECT COUNT(*) AS total_entree FROM commentaires WHERE id_billet = :id');
		$return_nb_entry->bindValue('id',$_GET['id'],PDO::PARAM_INT);
		$return_nb_entry->execute();
		
		$nb_entry = $return_nb_entry->fetch();
		$total_entry = $nb_entry['total_entree'];
		
		$pagination-> setTotal_entry($total_entry,5);
		
		//On demande les données calculé par la class
		$actual_page = $pagination->getActual_page();
		$first_entry = $pagination->getFirst_entry();
		$max_entry_page = $pagination->getMax_entry_page();
		$nb_page = $pagination->getNb_page();
		
		
		//On effectue une demande pour recupérer les 5 messages en rapport fiavec la page
		$req = $bdd->prepare('SELECT id, id_billet, pseudo, commentaire, DATE_FORMAT(date_creation, \'Le %d/%m/%Y à %Hh%imin%ss :\')
		as date_creation_fr FROM commentaires WHERE id_billet = :id ORDER BY id DESC LIMIT :rst_entry , :max_entry_page');
		$req->bindValue('first_entry',$first_entry,PDO::PARAM_INT);
		$req->bindValue('max_entry_page',$max_entry_page,PDO::PARAM_INT);
		$req->bindValue('id',$_GET['id'],PDO::PARAM_INT);
		$req->execute();
		
		//On affiche les messages grace a une boucle while et sécurise avec htmlspecialchars
		while ($data = $req->fetch())
		{
			echo '<h4>'. htmlspecialchars($data['pseudo']).'    
			<em>  ' . htmlspecialchars($data['date_creation_fr']) . '</em></h4>
			<p>'. htmlspecialchars($data['commentaire']) . '</p>';
		}
		//On indique la fin de la requete sql
		$req->closeCursor();
		?>
		</div>
		
		<!-- On crée un formulaire pour l'entrée des messages avec memoire du dernier pseudo entrée grace au cookie -->
		<form action="commentaires_post.php?id_billet=<?php echo htmlspecialchars($_GET['id']) ?>" method="post" />
			<p>
				<label for="pseudo">Pseudo</label> : <input type=text" name="pseudo" id="pseudo" value="Pseudo"    />
				<label for="message">Message</label> : <input type="text" name="message" id="message"  />
				<input type="submit" value="Envoyer" />
			</p>
		</form>
		<?php
			//On affiche le bouton précedent
		if ($actual_page != 1)
		{
			echo '<a href="commentaires.php?id= ' . htmlspecialchars($_GET['id']) . '&page= ' . ($actual_page - 1) . '"> Préc </a>';
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
				echo '<a href="commentaires.php?id= ' . htmlspecialchars($_GET['id']) . '&page=' . $numero_page . '"> ' . $numero_page . ' </a>';
			}
		}	

		//On affiche le bouton suivant 
		if ($actual_page != $nb_page)
		 {
				echo '<a href="commentaires.php?id= ' . htmlspecialchars($_GET['id']) . '&page=' . ($actual_page + 1) . '"> Suiv </a></br>';
		 }
		?>
				
		<!-- On affiche un formulaire pour choisir sa page -->
		<form action="index_blog.php" method="get">
			<label for="page">Page</label> : <input type="number" min="1" name="page" id="page">
		</form></br>
		
		<!-- On crée un bouton pour actualiser la page -->
		<p>
			<a href="commentaires.php?id=<?php echo htmlspecialchars($_GET['id']) ?>">Actualiser</a>
		</p>
		<?php
		}
		?>
	</body>
</html>
