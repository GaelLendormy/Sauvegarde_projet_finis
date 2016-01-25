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
		
		//On compte le nombre de message
		$retour_nombre_de_message = $bdd->query('SELECT COUNT(*) AS total_message FROM minichat');
		$nombre_de_message = $retour_nombre_de_message->fetch();
		$total_message = $nombre_de_message['total_message'];

		//On definit le nombre de message par page
		$message_max_page = 5;

		//On calcul le nombre de page
		$nombre_de_page = ceil($total_message/$message_max_page);

		//On definit numéros de la page
		if (isset ($_GET['page']))
		{
				$page_actuelle = (int)$_GET['page'];
				
				if ($page_actuelle >= $nombre_de_page)
				{
						$page_actuelle = $nombre_de_page;

				}
								if ($page_actuelle <= 0)
						{
							$page_actuelle = 1;
						}
		}
		else
		{
			$page_actuelle = 1;	
		}

		//On definit la premiere entree de la page
		$premiere_entree = ($page_actuelle - 1)*$nombre_de_page;
			
		//On effectue une demande pour recupérer les 5 messages en rapport avec la page
		$reponse = $bdd->query('SELECT * FROM minichat ORDER BY id DESC LIMIT ' . $premiere_entree . ',' . $message_max_page);
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
		if ($page_actuelle != 1)
		{
			echo '<a href="minichat.php?page=' . ($page_actuelle - 1) . '"> Préc </a>';
		}

		//On affiche les numeros de page
		for($numero_page = 1; $numero_page <= $nombre_de_page; $numero_page ++ )
		{
			if($numero_page == $page_actuelle)
			{
				echo '[' . $numero_page . ']';
			}
			
			else
			{
				echo '<a href="minichat.php?page=' . $numero_page . '"> ' . $numero_page . ' </a>';
			}
		}	

		//On affiche le bouton suivant if ($page_actuelle != $nombre_de_page)
		 {
				echo '<a href="minichat.php?page=' . ($page_actuelle + 1) . '"> Suiv </a></br>';
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
