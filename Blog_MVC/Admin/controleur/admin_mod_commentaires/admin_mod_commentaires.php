<?php
$id = htmlspecialchars($_GET['id']);
include_once('modele/admin_mod_commentaires/get_commentaire.php');

$commentaire = get_commentaire($id);

if(empty ($commentaire))
{
	echo "Le commentaire n'existe pas!";
}
else
{
foreach($commentaire as $cle => $Commentaire)
{
	$commentaire[$cle]['pseudo'] = htmlspecialchars($Commentaire['pseudo']);
	$commentaire[$cle]['commentaire'] = htmlspecialchars($Commentaire['commentaire']);
}

include_once('vue/admin_mod_commentaires/admin_mod_commentaires.php');
}