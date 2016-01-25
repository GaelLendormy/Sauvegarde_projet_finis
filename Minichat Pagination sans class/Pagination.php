<?php
$bdd = new PDO('mysql:host=localhost;dbname=test', 'root', '');
$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//On compte le nombre de message
$retour_nombre_de_message = $bdd->query('SELECT COUNT(*) AS total_message FROM minichat');
$nombre_de_message = $retour_nombre_de_message->fetch();
$total_message = $nombre_de_message['total_message'];
echo 'la bdd a ' . $total_message . ' lignes</br>';

//On definit le nombre de message par page
$message_max_page = 5;
echo 'On affichera ' .$message_max_page . ' messages par page</br>';

//On calcul le nombre de page
$nombre_de_page = ceil($total_message/$message_max_page);
echo 'On aura donc ' . $nombre_de_page . ' pages</br>';

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


echo 'La page actuelle est ' . $page_actuelle . ' ! ';

//On definit la premiere entree de la page
$premiere_entree = ($page_actuelle - 1)*$nombre_de_page;


	$reponse = $bdd->query('SELECT * FROM minichat ORDER BY id DESC LIMIT ' . $premiere_entree . ',' . $message_max_page );
	echo '<p><strong>Chat:</strong></p>';
	while ($données = $reponse->fetch())
	{
		echo '<p><strong>'.htmlspecialchars($données['pseudo']).' : 
		</strong>'.htmlspecialchars($données['message']) . '<br /></p>';
	}
	
	$reponse->closeCursor();
	
//On affiche le bouton précedent
if ($page_actuelle != 1)
{
	echo '<a href="pagination.php?page=' . ($page_actuelle - 1) . '"> Préc </a>';
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
		echo '<a href="pagination.php?page=' . $numero_page . '"> ' . $numero_page . ' </a>';
	}
}	

//On affiche le bouton suivant if ($page_actuelle != $nombre_de_page)
 {
	 	echo '<a href="pagination.php?page=' . ($page_actuelle + 1) . '"> Suiv </a></br>';
 }
//On affiche un formulaire pour choisir sa page 
	?>
<form action="pagination.php" method="get">
	<label for="page">Page</label> : <input type="number" min="1" name="page" id="page">
</form>


