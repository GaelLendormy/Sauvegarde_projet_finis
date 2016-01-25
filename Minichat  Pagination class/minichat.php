<?php
//Si le cookie pseudo n'existe pas le créer avec comme pseudo: pseudo
if (!isset ($_COOKIE['pseudo']))
{
	setcookie('pseudo','Pseudo',time()+365*24*3600,null,null,false,true );	
}
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf8" />
		<title>Minichat</title>
	</head>
	<style>
	form
	{
		text-align:center;
	}
	</style>
	<body>
		<!-- On crée un formulaire pour l'entrée des messages avec memoire du dernier pseudo entrée grace au cookie -->
		<form action="minichat_post.php" method="post" />
			<p>
				<label for="pseudo">Pseudo</label> : <input type=text" name="pseudo" id="pseudo" value= <?php echo $_COOKIE['pseudo']; ?>   />
				<label for="message">Message</label> : <input type="text" name="message" id="message"  />
				<input type="submit" value="Envoyer" />
			</p>
		</form>

		
		<?php
		//On se connecte a la bdd et on efface l'affichage d'erreur
		try
		{
			$bdd = new PDO('mysql:host=localhost;dbname=test', 'root', '');
		}
		catch(Exception $e)
		{
			die('Erreur : '.$e->getMessage());
		}
		
		//On appelle la class pagination.class
		include_once('pagination.class.php');
		
		//On crée un nouvelle objet $pagination
		$pagination = new Pagination(5);
		
		//On demande les données calculé par la class
		$actual_page = $pagination->getActual_page();
		$first_entry = $pagination->getFirst_entry();
		$max_entry_page = $pagination->getMax_entry_page();
		$nb_page = $pagination->getNb_page();
		
		//On effectue une demande pour recupérer les 5 messages en rapport avec la page
		$reponse = $bdd->query('SELECT * FROM minichat ORDER BY id DESC LIMIT ' . $first_entry . ',' . $max_entry_page);
		echo '<p><strong>Chat:</strong></p>';
		
		//On affiche les messages grace a une boucle while et sécurise avec htmlspecialchars
		while ($données = $reponse->fetch())
		{
			echo '<p><strong>'.htmlspecialchars($données['pseudo']).' : 
			</strong>'.htmlspecialchars($données['message']) . '<br /></p>';
		}
		//On indique la fin de la requete sql
		$reponse->closeCursor();
		
		
			//On affiche le bouton précedent
		if ($actual_page != 1)
		{
			echo '<a href="minichat.php?page=' . ($actual_page - 1) . '"> Préc </a>';
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
				echo '<a href="minichat.php?page=' . $numero_page . '"> ' . $numero_page . ' </a>';
			}
		}	

		//On affiche le bouton suivant 
		if ($actual_page != $nb_page)
		 {
				echo '<a href="minichat.php?page=' . ($actual_page + 1) . '"> Suiv </a></br>';
		 }
		?>
				
		<!-- On affiche un formulaire pour choisir sa page -->
		<form action="minichat.php" method="get">
			<label for="page">Page</label> : <input type="number" min="1" name="page" id="page">
		</form></br>
		
		<!-- On crée un bouton pour actualiser la page -->
		<p>
			<a href="minichat.php">Actualiser</a>
		</p>
	</body>
</html>
