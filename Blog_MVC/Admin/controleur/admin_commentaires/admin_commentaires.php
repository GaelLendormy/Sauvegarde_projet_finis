<?php
//On recupère le billet et on vérifie qu'il existe
$id = htmlspecialchars($_GET['id']);
include_once('modele/admin_commentaires/get_billet.php');

$billet = get_billet($id);

if(empty ($billet))
{
	echo "Le billet n'existe pas!";
}
else
{
foreach($billet as $cle => $Billet)
{
	$billet[$cle]['titre'] = htmlspecialchars($Billet['titre']);
	$billet[$cle]['contenu'] = nl2br(htmlspecialchars($Billet['contenu']));
}


//On demande le nombre de commentaires pour ce billet
include_once('modele/admin_commentaires/get_nb_commentaires.php');
$total_entry = get_nb_commentaires($id);

//On defini le offset en fonction de la page
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
include_once('modele/admin_commentaires/get_commentaires.php');
$commentaires = get_commentaires($offset, $max_entry_page,$id);

//On effectue du traitement sur les données (controleur)
//Ici, on doit surtout sécuriser l'affichage
//Avec foreach ici on crée un clone du tableau qui aura des valeurs sécurisées par htmlspecialchars

foreach($commentaires as $cle => $commentaire)
{
	$commentaires[$cle]['pseudo'] = htmlspecialchars($commentaire['pseudo']);
	$commentaires[$cle]['commentaire'] = nl2br(htmlspecialchars($commentaire['commentaire']));
}

//On affiche la page(vue)
include_once('vue/admin_commentaires/admin_commentaires.php');

include_once('pagination.php');
}