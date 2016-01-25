<?php

//On demande le nombre de billets
include_once('modele/blog/get_nb_billets.php');
$total_entry = get_nb_billets();

//on defini le offset en fonction de la page
//On calcul le nombre de page
		$max_entry_page = 5;
		
		$nb_page = ceil($total_entry/$max_entry_page);

		//On definit numéros de la page
		if (isset ($_GET['page']))
		{
				$actual_page = (int)$_GET['page'];
				
				if ($actual_page >= $nb_page)
				{
						$actual_page = $nb_page;

				}
								if ($actual_page <= 0)
						{
							$actual_page = 1;
						}
		}
		else
		{
			$actual_page = 1;	
		}

		//On definit la premiere entree de la page
		$offset = ($actual_page - 1)*$max_entry_page;



//On demande les 5 derniers billets (modèle)
include_once('modele/blog/get_billets.php');
$billets = get_billets($offset, $max_entry_page);

//On effectue du traitement sur les données (controleur)
//Ici, on doit surtout sécuriser l'affichage
//Avec foreach ici on crée un clone du tableau qui aura des valeurs sécurisées par htmlspecialchars

foreach($billets as $cle => $billet)
{
	$billets[$cle]['titre'] = htmlspecialchars($billet['titre']);
	$billets[$cle]['contenu'] = nl2br(htmlspecialchars($billet['contenu']));
}

//On affiche la page(vue)
include_once('vue/blog/index.php');

include_once('pagination.php');